@extends('Admin.layouts.inc.app')
@section('title')
    About Us In Home
@endsection
@section('css')

@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">About US In Home Page</h5>



        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12">
                    <form id="form" action="{{route('about_us_home.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">About US</h4>

                                <div class="mb-3">
                                    <div class="row">


                                        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
                                            <label for="image2" class="form-control-label">Image  </label>
                                            <input type="file" class="dropify" name="image2" data-default-file="{{get_file($row->image2)}}" accept="image/*"/>
                                            <span
                                                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
                                        </div>


                                        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                                            <!--begin::Label-->
                                            <label for="title_home" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span class="required mr-1">Title <span class="red-star">*</span></span>
                                            </label>
                                            <!--end::Label-->
                                            <input id="title_home" required type="text" class="form-control form-control-solid" placeholder="" name="title_home"
                                                   value="{{$row->title_home}}"/>
                                        </div>

                                        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                                            <!--begin::Label-->
                                            <label for="our_mission_title_home" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span class="required mr-1">Our Mission Title <span class="red-star">*</span></span>
                                            </label>
                                            <!--end::Label-->
                                            <input id="our_mission_title_home" required type="text" class="form-control form-control-solid" placeholder="" name="our_mission_title_home"
                                                   value="{{$row->our_mission_title_home}}"/>
                                        </div>


                                        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
                                            <!--begin::Label-->
                                            <label for="our_goal_title_home" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span class="required mr-1">Our Vision  Title   <span class="red-star">*</span></span>
                                            </label>
                                            <!--end::Label-->
                                            <input id="our_goal_title_home" required type="text" class="form-control form-control-solid" placeholder="" name="our_goal_title_home"
                                                   value="{{$row->our_goal_title_home}}"/>
                                        </div>



                                        <div class="col-sm-6 pb-3 p-2">
                                            <label for="desc_home" class="form-label"> Desc <span class="red-star">*</span> </label>
                                            <textarea name="desc_home" id="desc_home" class="form-control" rows="5"
                                                      placeholder="">{{$row->desc_home}}</textarea>
                                        </div>






                                        <div class="col-sm-6 pb-3 p-2">
                                            <label for="our_goal_desc_home" class="form-label"> Our Vision  Desc <span class="red-star">*</span> </label>
                                            <textarea name="our_goal_desc_home" id="our_goal_desc_home" class="form-control" rows="5"
                                                      placeholder="">{{$row->our_goal_desc_home}}</textarea>
                                        </div>


                                        <div class="col-sm-6 pb-3 p-2">
                                            <label for="our_mission_desc_home" class="form-label"> Our Mission Desc <span class="red-star">*</span> </label>
                                            <textarea name="our_mission_desc_home" id="our_mission_desc_home" class="form-control" rows="5"
                                                      placeholder="">{{$row->our_mission_desc_home}}</textarea>
                                        </div>



                                    </div>

                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button id="submitBtn" type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')

    <script>
        $('.dropify').dropify("Upload Here");
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
                beforeSend: function () {
                    $(`#submitBtn`).html('<span style="margin-right: 4px;">Wait ..</span><i class="bx bx-loader bx-spin"></i>').attr('disabled', true);
                },


                complete: function () {
                },
                success: function (data) {



                    window.setTimeout(function () {

// $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                        } else {
                            toastr.success(data.message)
                        }
                    }, 1000);

                    $(`#submitBtn`).html(`Update`).attr('disabled', false);


                },
                error: function (data) {

                    if (data.status === 500) {
                        toastr.error('There is a error 😞');
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

                    $(`#submitBtn`).html(`Update`).attr('disabled', false);

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

@endsection
