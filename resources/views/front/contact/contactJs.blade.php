

<script>
    $(document).on('submit', 'form#Form', function (e) {
        e.preventDefault();
        var myForm = $("#Form")[0]
        var formData = new FormData(myForm)
        var url = $('#Form').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('#submit_button').attr('disabled', true)
                $('#submit_button').html(`<i class='fa fa-spinner fa-spin '></i>`)
            },
            complete: function () {

            },
            success: function (data) {
                // var name = `${$("#contact_name").val()}`;

                // toastr.success("Your Reservation Is Send")
                alertify.success('Your Reservation Is Send');


                $('#submit_button').attr('disabled', false)
                $('#submit_button').html(`{{ __('Submit') }} `)

                $('#Form')[0].reset();
            },
            error: function (data) {
                $('#submit_button').attr('disabled', false)

                $('#submit_button').html(`{{ __('Submit') }}`)

                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);

                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value)
                            });

                        } else {

                        }
                    });
                }
                if (data.status == 421) {
                    toastr.error(data.message)
                }

            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });

</script>
