<div>

    <h4 class="card-title"> Other Setting</h4>

    <form id="Form_other" method="post" action="{{route('settings.update',$settings->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_type" value="other">

        <div class="row mb-3">


            <div class="col-6">
                <label for="app_name" class="form-label"> App Name</label>
                <input type="text" id="app_name" name="app_name" class="form-control" placeholder="" value="{{$settings->app_name}}">
            </div>

            <div class="col-6">
                <label for="review_link" class="form-label">Review Link  </label>
                <input dir="ltr" type="text" id="review_link" name="review_link" class="form-control" placeholder="" value="{{$settings->review_link}}">
            </div>


            <div class="col-6">
                <label for="footer_title1" class="form-label"> Title 1 In Footer</label>
                <input type="text" id="footer_title1" name="footer_title1" class="form-control" placeholder="" value="{{$settings->footer_title1}}">
            </div>

            <div class="col-6">
                <label for="footer_title2" class="form-label"> Title 2 In Footer</label>
                <input type="text" id="footer_title2" name="footer_title2" class="form-control" placeholder="" value="{{$settings->footer_title2}}">
            </div>


            <div class="col-6">
                <label for="partner_title" class="form-label"> Partner Title</label>
                <input type="text" id="partner_title" name="partner_title" class="form-control" placeholder="" value="{{$settings->partner_title}}">
            </div>

            <div class="col-6">
                <label for="contact_us_link" class="form-label"> Contact Us Link </label>
                <input type="text" id="contact_us_link" name="contact_us_link" class="form-control" placeholder="" value="{{$settings->contact_us_link}}">
            </div>

            <div class="col-6">
                <label for="latitude" class="form-label"> latitude </label>
                <input type="text" id="latitude" name="latitude" class="form-control" placeholder="" value="{{$settings->latitude}}">
            </div>

            <div class="col-6">
                <label for="longitude" class="form-label"> longitude </label>
                <input type="text" id="longitude" name="longitude" class="form-control" placeholder="" value="{{$settings->longitude}}">
            </div>


            <div class="col-6">
                <label for="gallery_image_title" class="form-label"> Gallery Image Title </label>
                <input type="text" id="gallery_image_title" name="gallery_image_title" class="form-control" placeholder="" value="{{$settings->gallery_image_title}}">
            </div>

            <div class="col-6">
                <label for="gallery_video_title" class="form-label"> Gallery Video Title </label>
                <input type="text" id="gallery_video_title" name="gallery_video_title" class="form-control" placeholder="" value="{{$settings->gallery_video_title}}">
            </div>




            <div class="col-6">
                <label for="footer_desc1" class="form-label"> Description 1 In Footer  </label>
                <textarea name="footer_desc1" id="footer_desc1" class="form-control" rows="5"
                          placeholder="">{{$settings->footer_desc1}}</textarea>
            </div>

            <div class="col-6">
                <label for="footer_desc2" class="form-label">  Description 2 In Footer </label>
                <textarea dir="ltr" name="footer_desc2" id="footer_desc2" class="form-control" rows="5"
                          placeholder="">{{$settings->footer_desc2}}</textarea>
            </div>

            <div class="col-12">
                <label for="partner_desc" class="form-label"> Partner Desc  </label>
                <textarea name="partner_desc" id="partner_desc" class="form-control" rows="5"
                          placeholder="">{{$settings->partner_desc}}</textarea>
            </div>

            <div class="col-12">
                <label for="contact_us_desc" class="form-label"> Contact Us Desc   </label>
                <textarea name="contact_us_desc" id="contact_us_desc" class="form-control" rows="5"
                          placeholder="">{{$settings->contact_us_desc}}</textarea>
            </div>


        </div>


        <div class="row mt-4">


            <div class="col-sm-6 mt-3">
                <div class="text-end">
                    <button id='btnOther' form="Form_other" type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save me-1"></i> Save
                    </button>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </form>
</div>
