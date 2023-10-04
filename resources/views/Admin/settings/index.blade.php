@extends('Admin.layouts.inc.app')
@section('title')
    Settings
@endsection
@section('css')
    <!-- include summernote css/js -->
    <link href="summernote-bs5.css" rel="stylesheet">
    {{--    <link href="{{asset('dashboard/summernote/summernote-bs4.css')}}">--}}
    <style>
        .dropify-font-upload:before,
        .dropify-wrapper .dropify-message span.file-icon:before {
            content: "\f382";
            font-weight: 100;
            color: #000;
            font-size: 26px;
        }

        .dropify-wrapper .dropify-message p {
            text-align: center;
            font-size: 15px;
        }

    </style>

@endsection
@section('content')

    <div class="checkout-tabs">
        <div class="row">
            <div class="col-xl-2 col-sm-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    {{----------------------------------}}


                    {{----------------------------------}}
                    <a class="nav-link active" id="v-pills-logo-t" data-bs-toggle="pill" href="#v-pills-logo" role="tab"
                       aria-controls="v-pills-logo" aria-selected="true">
                        <i class="bx bx-image-alt d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">Logo</p>
                    </a>

                    {{----------------------------------}}

                    {{----------------------------------}}
                    <a class="nav-link" id="v-pills-social-tab" data-bs-toggle="pill" href="#v-pills-social" role="tab"
                       aria-controls="v-pills-social" aria-selected="false">
                        <i class="bx bx-like d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">  Social Media</p>
                    </a>

                    <a class="nav-link" id="v-pills-counter-tab" data-bs-toggle="pill" href="#v-pills-counter" role="tab"
                       aria-controls="v-pills-counter" aria-selected="false">
                        <i class="bx bxs-comment d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">   Counter Setting  </p>
                    </a>


                    <a class="nav-link" id="v-pills-other-tab" data-bs-toggle="pill" href="#v-pills-other" role="tab"
                       aria-controls="v-pills-other" aria-selected="false">
                        <i class="bx bxs-landscape d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">   Other Setting</p>
                    </a>
                    {{----------------------------------}}

                    {{----------------------------------}}
                </div>
            </div>
            <div class="col-xl-10 col-sm-9">
                {{----------------------------------}}
                <div class="card">
                    <div class="card-body">


                        <div class="tab-content" id="v-pills-tabContent">



                            {{----------------------------------}}

                            <div class="tab-pane fade show active" id="v-pills-logo" role="tabpanel"
                                 aria-labelledby="v-pills-logo-t">
                                @include("Admin.settings.parts.logo")
                            </div>


                            {{----------------------------------}}


                            {{----------------------------------}}

                            <div class="tab-pane fade " id="v-pills-social" role="tabpanel"
                                 aria-labelledby="v-pills-social-tab">
                                @include("Admin.settings.parts.social")
                            </div>

                            {{----------------------------------}}


                            <div class="tab-pane fade " id="v-pills-counter" role="tabpanel"
                                 aria-labelledby="v-pills-counter-tab">
                                @include("Admin.settings.parts.counter")
                            </div>


                            {{----------------------------------}}


                            <div class="tab-pane fade " id="v-pills-other" role="tabpanel"
                                 aria-labelledby="v-pills-other-tab">
                                @include("Admin.settings.parts.other")
                            </div>

                            {{----------------------------------}}
                        </div>


                    </div>
                </div>
                {{----------------------------------}}

            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/tinymce.min.js"
            integrity="sha512-XQOOk3AOZDpVgRcau6q9Nx/1eL0ATVVQ+3FQMn3uhMqfIwphM9rY6twWuCo7M69rZPdowOwuYXXT+uOU91ktLw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.dropify').dropify();


        tinymce.init({
            selector: '.textEditor',
            toolbar: 'language',
            directionality: 'rtl',
        });
    </script>

    <script>






        $(document).on('submit', 'form#Form_logo', function (e) {
            e.preventDefault();
            var myForm = $("#Form_logo")[0]
            var formData = new FormData(myForm)
            var url = $('#Form_logo').attr('action');
            sendAjax(url, formData,'btnLogo');
        });


        $(document).on('submit', 'form#Form_social', function (e) {
            e.preventDefault();
            var myForm = $("#Form_social")[0]
            var formData = new FormData(myForm)
            var url = $('#Form_social').attr('action');
            sendAjax(url, formData,'btnSocial');
        });

        $(document).on('submit', 'form#Form_other', function (e) {
            e.preventDefault();
            var myForm = $("#Form_other")[0]
            var formData = new FormData(myForm)
            var url = $('#Form_other').attr('action');
            sendAjax(url, formData,'btnOther');
        });



        $(document).on('submit', 'form#Form_counter', function (e) {
            e.preventDefault();
            var myForm = $("#Form_counter")[0]
            var formData = new FormData(myForm)
            var url = $('#Form_counter').attr('action');
            sendAjax(url, formData,'btnCounter');
        });



        function sendAjax(url, formData,btnId) {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.loader-ajax').show()
                    $(`#${btnId}`).html('<span style="margin-right: 4px;">انتظر ..</span><i class="bx bx-loader bx-spin"></i>').attr('disabled', true);
                },

                complete: function () {


                },
                success: function (data) {
                    $('.loader-ajax').hide()
                    $(".logo_basic").attr("src", data.logo);
                    cuteToast({
                        type: "success", // or 'info', 'error', 'warning'
                        message: "تم تعديل الإعدادات العامة",
                        timer: 3000
                    });
                                             $(`#${btnId}`).html(`<i class="mdi mdi-content-save me-1"></i> حفظ`).attr('disabled', false);

                },
                error: function (data) {
                    $('.loader-ajax').hide()
                    if (data.status === 500) {
                        cuteToast({
                            type: "error", // or 'info', 'error', 'warning'
                            message: "يوجد خطأ ",
                            timer: 3000
                        });

                          $(`#${btnId}`).html(`<i class="mdi mdi-content-save me-1"></i> حفظ`).attr('disabled', false);


                    }
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    cuteToast({
                                        type: "error", // or 'info', 'error', 'warning'
                                        message: value,
                                        timer: 3000
                                    });
                                      $(`#${btnId}`).html(`<i class="mdi mdi-content-save me-1"></i> حفظ`).attr('disabled', false);

                                });

                            } else {
                                  $(`#${btnId}`).html(`<i class="mdi mdi-content-save me-1"></i> حفظ`).attr('disabled', false);

                            }
                        });
                    }
                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        }


    </script>

@endsection
