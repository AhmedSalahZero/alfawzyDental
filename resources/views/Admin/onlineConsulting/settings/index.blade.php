@extends('Admin.layouts.inc.app')
@section('title')
    Online Consulting Setting
@endsection
@section('css')


@endsection

{{--@section('page-title')--}}
{{--    General Settings--}}
{{--@endsection--}}



@section('content')

    <div class="card">
        <div class="card-header ">
            <h5 class="card-title mb-0 flex-grow-1">Online Consulting Setting </h5>


            <form id="form" enctype="multipart/form-data" method="POST" action="{{route('consulting_setting.store')}}">
                @csrf
                <div class="row my-4 g-4">




                    <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                        <label for="front_teeth_image" class="form-control-label fs-6 fw-bold "> Front Teeth Image </label>
                        <input id="front_teeth_image" type="file" class="dropify" name="front_teeth_image"
                               data-default-file="{{get_file($row->front_teeth_image)}}"
                               accept="image/*"/>
                        <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                    </div>

                    <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                        <label for="side_teeth_image" class="form-control-label fs-6 fw-bold "> Side Teeth Image   </label>
                        <input type="file" id="side_teeth_image" class="dropify" name="side_teeth_image"
                               data-default-file="{{get_file($row->side_teeth_image)}}"
                               accept="image/*"/>
                        <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                    </div>


                    <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                        <label for="upper_teeth_image" class="form-control-label fs-6 fw-bold "> Upper Teeth Image   </label>
                        <input type="file" id="upper_teeth_image" class="dropify" name="upper_teeth_image"
                               data-default-file="{{get_file($row->upper_teeth_image)}}"
                               accept="image/*"/>
                        <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                    </div>



                    <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                        <label for="lower_teeth_image" class="form-control-label fs-6 fw-bold "> Lower teeth picture    </label>
                        <input type="file" id="lower_teeth_image" class="dropify" name="lower_teeth_image"
                               data-default-file="{{get_file($row->lower_teeth_image)}}"
                               accept="image/*"/>
                        <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                    </div>


                    <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                        <label for="x_ray" class="form-control-label fs-6 fw-bold "> X-Ray (Required)	       </label>
                        <input type="file" id="x_ray" class="dropify" name="x_ray"
                               data-default-file="{{get_file($row->x_ray)}}"
                               accept="image/*"/>
                        <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                    </div>




                    <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                        <label for="passport_or_id" class="form-control-label fs-6 fw-bold "> Passport or ID       </label>
                        <input type="file" id="passport_or_id" class="dropify" name="passport_or_id"
                               data-default-file="{{get_file($row->passport_or_id)}}"
                               accept="image/*"/>
                        <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                    </div>




                    <div class="my-4">
                        <button type="submit" class="btn btn-success"> Edit</button>
                    </div>


                </div>
            </form>

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
