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
            <h5 class="card-title mb-0 flex-grow-1">Online Consulting Images For:

                {{$row->name}}
            </h5>

            <a  class="btn btn-info my-4" href="{{route('online_consulting.index')}}"> Back To Online Consulting

            </a>


            <div class="row my-2 g-4">

                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="front_teeth_image" class="form-control-label fs-6 fw-bold "> Front Teeth Image </label>
                    @php
                        $lastDotPosition = strrpos(get_file($row->front_teeth_image), '.');

                            $substringAfterLastDot = substr(get_file($row->front_teeth_image), $lastDotPosition + 1);

                    @endphp
                    @if($substringAfterLastDot=='pdf')
                        <a target="_blank" href="{{get_file($row->front_teeth_image)}}" class="btn btn-success mt-4">Show Pdf</a>
                    @else

                    <a data-fancybox="" href="{{get_file($row->front_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->front_teeth_image)}}">
                    </a>
                    @endif
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="side_teeth_image" class="form-control-label fs-6 fw-bold "> Side Teeth Image </label>

                    @php
                        $lastDotPosition = strrpos(get_file($row->side_teeth_image), '.');

                            $substringAfterLastDot = substr(get_file($row->side_teeth_image), $lastDotPosition + 1);

                    @endphp
                    @if($substringAfterLastDot=='pdf')
                        <a target="_blank" href="{{get_file($row->side_teeth_image)}}" class="btn btn-success mt-4">Show Pdf</a>
                    @else

                    <a data-fancybox="" href="{{get_file($row->side_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->side_teeth_image)}}">
                    </a>
                    @endif

                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="upper_teeth_image" class="form-control-label fs-6 fw-bold "> Upper Teeth Image </label>
                    @php
                        $lastDotPosition = strrpos(get_file($row->upper_teeth_image), '.');

                            $substringAfterLastDot = substr(get_file($row->upper_teeth_image), $lastDotPosition + 1);

                    @endphp
                    @if($substringAfterLastDot=='pdf')
                        <a target="_blank" href="{{get_file($row->upper_teeth_image)}}" class="btn btn-success mt-4">Show Pdf</a>
                    @else


                    <a data-fancybox="" href="{{get_file($row->upper_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->upper_teeth_image)}}">
                    </a>
                    @endif
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="lower_teeth_image" class="form-control-label fs-6 fw-bold "> Lower Teeth Image </label>
                    @php
                        $lastDotPosition = strrpos(get_file($row->lower_teeth_image), '.');

                            $substringAfterLastDot = substr(get_file($row->lower_teeth_image), $lastDotPosition + 1);

                    @endphp
                    @if($substringAfterLastDot=='pdf')
                        <a target="_blank" href="{{get_file($row->lower_teeth_image)}}" class="btn btn-success mt-4">Show Pdf</a>
                    @else

                    <a data-fancybox="" href="{{get_file($row->lower_teeth_image)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->lower_teeth_image)}}">
                    </a>
                    @endif
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="x_ray" class="form-control-label fs-6 fw-bold "> X-Ray </label>
                    @php
                        $lastDotPosition = strrpos(get_file($row->x_ray), '.');

                            $substringAfterLastDot = substr(get_file($row->x_ray), $lastDotPosition + 1);

                    @endphp
                    @if($substringAfterLastDot=='pdf')
                        <a target="_blank" href="{{get_file($row->x_ray)}}" class="btn btn-success mt-4">Show Pdf</a>
                    @else

                    <a data-fancybox="" href="{{get_file($row->x_ray)}}">
                        <img alt="Muhammed Elsdodey" height="200px"  src="{{get_file($row->x_ray)}}">
                    </a>
                    @endif
                </div>


                <div class="d-flex flex-column m-4 fv-row col-sm-4">
                    <label for="passport_or_id" class="form-control-label fs-6 fw-bold "> Passport Or Id </label>
                    @php
                        $lastDotPosition = strrpos(get_file($row->passport_or_id), '.');

                            $substringAfterLastDot = substr(get_file($row->passport_or_id), $lastDotPosition + 1);

                    @endphp
                    @if($substringAfterLastDot=='pdf')
                        <a target="_blank" href="{{get_file($row->passport_or_id)}}" class="btn btn-success mt-4">Show Pdf</a>
                    @else

                    <a data-fancybox="" href="{{get_file($row->passport_or_id)}}">
                        <img alt="Muhammed Elsdodey" height="200px"
                             src="{{get_file($row->passport_or_id)}}">
                    </a>
                    @endif
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
