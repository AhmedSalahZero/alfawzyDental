<div>
    <h4 class="card-title">Logo</h4>
    <form id="Form_logo" method="post" action="{{route('settings.update',$settings->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_type" value="logo">
        <div class="form-group row mb-4">
            <label for="logo_header" class="col-md-2 col-form-label"> Logo Header
                </label>
            <div class="col-md-10">
                <input type="file"
                       data-default-file="{{get_file($settings->logo_header)}}"
                       class="form-control dropify" id="logo_header" name="logo_header"
                       placeholder=" ">
            </div>
        </div>

        <div class="form-group row mb-4">
            <label for="logo_footer" class="col-md-2 col-form-label">Logo Footer
                </label>
            <div class="col-md-10">
                <input type="file"
                       data-default-file="{{get_file($settings->logo_footer)}}"
                       class="form-control dropify" id="logo_footer" name="logo_footer"
                       placeholder=" ">

            </div>
        </div>

        <div class="form-group row mb-4">
            <label for="fave_icon" class="col-md-2 col-form-label">  Fave Icon
               </label>
            <div class="col-md-10">
                <input type="file" data-default-file="{{get_file($settings->fave_icon)}}"
                       class="form-control dropify" id="fave_icon" name="fave_icon"
                       placeholder=" ">

            </div>
        </div>



        <div class="form-group row mb-4">
            <label for="main_home_image" class="col-md-2 col-form-label">    Contact Us Image
            </label>
            <div class="col-md-10">
                <input type="file"
                       data-default-file="{{get_file($settings->contact_us_image)}}"
                       class="form-control dropify" id="contact_us_image" name="contact_us_image"
                       placeholder="">
            </div>
        </div>

        <div class="form-group row mb-4">
            <label for="video_footer" class="col-md-2 col-form-label">    Video In Footer
            </label>
            <div class="col-md-10">
                <input type="file"
                       data-default-file=""
                       class="form-control dropify" id="video_footer" name="video_footer"
                       placeholder=" )">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6">

            </div> <!-- end col -->

                <div class="col-sm-6">
                    <div class="text-end">
                        <button id='btnLogo' form="Form_logo" type="submit" class="btn btn-success ">
                            <i class="mdi mdi-content-save me-1"></i> Save
                        </button>
                    </div>
                </div> <!-- end col -->
        </div> <!-- end row -->
    </form>
</div>
