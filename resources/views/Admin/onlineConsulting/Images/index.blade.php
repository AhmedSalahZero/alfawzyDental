@extends('Admin.layouts.inc.app')
@section('title')
    Online Consulting Images
@endsection
@section('css')


@endsection

{{--@section('page-title')--}}
{{--    General Settings--}}
{{--@endsection--}}



@section('content')

    <div class="card">
        <div class="card-header ">
            <h5 class="card-title mb-0 flex-grow-1">Online Consulting Images </h5>


            <div class="row my-2 g-4">

                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="front_teeth_image" class="form-control-label fs-6 fw-bold "> Front Teeth Image </label>
                    <a data-fancybox="" href="{{get_file($row->front_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->front_teeth_image)}}">
                    </a>
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="side_teeth_image" class="form-control-label fs-6 fw-bold "> Side Teeth Image </label>
                    <a data-fancybox="" href="{{get_file($row->side_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->side_teeth_image)}}">
                    </a>

                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="upper_teeth_image" class="form-control-label fs-6 fw-bold "> Upper Teeth Image </label>
                    <a data-fancybox="" href="{{get_file($row->upper_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->upper_teeth_image)}}">
                    </a>
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="lower_teeth_image" class="form-control-label fs-6 fw-bold "> Lower Teeth Image </label>
                    <a data-fancybox="" href="{{get_file($row->lower_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->lower_teeth_image)}}">
                    </a>
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="x_ray" class="form-control-label fs-6 fw-bold "> X-Ray </label>
                    <a data-fancybox="" href="{{get_file($row->x_ray)}}">
                        <img alt="Muhammed Elsdodey" height="200px"  src="{{get_file($row->x_ray)}}">
                    </a>
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="passport_or_id" class="form-control-label fs-6 fw-bold "> Passport Or Id </label>
                    <a data-fancybox="" href="{{get_file($row->passport_or_id)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->passport_or_id)}}">
                    </a>
                </div>


            </div>


        </div>
    </div>

@endsection

@section('js')

    <script>
        $('.dropify').dropify();

    </script>


    <script>
        // CKEDITOR.replace('privacy');


    </script>
    <script>
        $(document).on('submit', "form#form", function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var url = $('#form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,

                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {

// $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                        } else {
                            toastr.error(data.message)
                        }
                    }, 1000);


                },
                error: function (data) {
                    if (data.status === 500) {
                        toastr.error('there is an error')
                    }

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

@endsection