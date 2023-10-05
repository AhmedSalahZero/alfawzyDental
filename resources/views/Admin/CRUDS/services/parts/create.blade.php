<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('services.store')}}">
    @csrf
    <div class="row g-4">

        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title"
                   value=""/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <label for="category_service_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Category  <span class="red-star">*</span></span>
            </label>
            <select id="category_service_id" name="category_service_id" class="form-control">
                <option selected disabled>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>



        <div class="col-sm-12 pb-3 p-2">
            <label for="desc" class="form-label"> Desc <span class="red-star">*</span> </label>
            <textarea name="desc" id="desc" class="form-control" rows="5"
                      placeholder=""></textarea>
        </div>


        <div class="col-sm-12 pb-3 p-2">
            <label for="details" class="form-label"> Details </label>
            <textarea name="details" id="details" class="form-control" rows="5"
                      placeholder=""></textarea>
        </div>



    </div>
</form>


<script>
    CKEDITOR.replace('desc', {
        height: 300
        , filebrowserUploadUrl: "{{Route('upload.image',['_token'=>csrf_token()])}}"
        , });

    CKEDITOR.replace('details', {
        height: 300
        , filebrowserUploadUrl: "{{Route('upload.image',['_token'=>csrf_token()])}}"
        , });


</script>



<script>
    $('.dropify').dropify();

</script>
