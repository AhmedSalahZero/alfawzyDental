<div>

    <h4 class="card-title">  Social Media</h4>

    <form id="Form_social" method="post" action="{{route('settings.update',$settings->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_type" value="social">
        <div class="form-group row mb-4">
            <label for="facebook" class="col-md-2 col-form-label">Face Book</label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="text"
                       value="{{$settings->facebook}}" class="form-control"
                       id="facebook"
                       name="facebook" placeholder="Facebook Link">

            </div>
        </div>

        <div class="form-group row mb-4">
            <label for="snapchat" class="col-md-2 col-form-label">SnapChat </label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="text"
                       value="{{$settings->snapchat}}" class="form-control"
                       id="snapchat"
                       name="snapchat" placeholder="Facebook Link">

            </div>
        </div>



        <div class="form-group row mb-4">
            <label for="instagram" class="col-md-2 col-form-label">
                Instagram</label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="text" class="form-control"
                       value="{{$settings->instagram}}" id="instagram" name="instagram"
                       placeholder=" Instagram Link">

            </div>
        </div>




        <div class="form-group row mb-4">
            <label for="phone" class="col-md-2 col-form-label"> Phone</label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="text" class="form-control"
                       value="{{$settings->phone}}" id="phone" name="phone"
                       placeholder="  Phone">

            </div>
        </div>

        <div class="form-group row mb-4">
            <label for="whatsapp" class="col-md-2 col-form-label"> Whatsapp</label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="text" class="form-control"
                       value="{{$settings->whatsapp}}" id="whatsapp" name="whatsapp"
                       placeholder="  Whatsapp">

            </div>
        </div>



        <div class="form-group row mb-4">
            <label for="email" class="col-md-2 col-form-label">Email</label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="email" class="form-control"
                       value="{{$settings->email}}" id="email" name="email"
                       placeholder=" Email">

            </div>
        </div>


        <div class="form-group row mb-4">
            <label for="gmail" class="col-md-2 col-form-label">Google Map</label>
            <div class="col-md-10">

                <input dir="ltr" data-validation="required" type="text" class="form-control"
                       value="{{$settings->gmail}}" id="gmail" name="gmail"
                       placeholder=" Gmail">

            </div>
        </div>


        <div class="form-group row mb-4">
            <label for="tiktok" class="col-md-2 col-form-label">Tiktok</label>
            <div class="col-md-10">

                <input dir="ltr"  type="text" class="form-control"
                       value="{{$settings->tiktok}}" id="tiktok" name="tiktok"
                       placeholder=" Tiktok">

            </div>
        </div>


        <div class="row mt-4">
            <div class="col-sm-6">

            </div> <!-- end col -->

            <div class="col-sm-6">
                <div class="text-end">
                    <button id='btnSocial' form="Form_social" type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save me-1"></i> Save
                    </button>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </form>
</div>
