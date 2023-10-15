<!--begin::Form-->
<link href="{{asset('assets/dashboard/backEndFiles/uploadMultiImages/image-uploader.min.css')}}" rel="stylesheet" type="text/css">

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('dental_tourism.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">



        <div class="row">

            <div id="input-images-1" class="col-lg-12 col-md-12  mb-3 input-images-1"
                 style="height:200px; padding-top: .5rem;"></div>

        </div>


        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="{{get_file($row->image)}}" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title1" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title1 <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title1" required type="text" class="form-control form-control-solid" placeholder="" name="title1"
                   value="{{$row->title1}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title2" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title2 <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title2" required type="text" class="form-control form-control-solid" placeholder="" name="title2"
                   value="{{$row->title2}}"/>
        </div>

        <div class="col-sm-6 pb-3 p-2">
            <label for="desc1" class="form-label"> Desc1 </label>
            <textarea name="desc1" id="desc1" class="form-control" rows="5"
                      placeholder="">{{$row->desc1}}</textarea>
        </div>

        <div class="col-sm-6 pb-3 p-2">
            <label for="desc2" class="form-label"> Desc2 <span class="red-star">*</span> </label>
            <textarea name="desc2" id="desc2" class="form-control" rows="5"
                      placeholder="">{{$row->desc2}}</textarea>
        </div>




        <div class="col-sm-12 pb-3 p-2">
            <label for="desc" class="form-label"> Desc <span class="red-star">*</span> </label>
            <textarea name="desc" id="desc" class="form-control" rows="5"
                      placeholder="">{{$row->desc}}</textarea>
        </div>




    </div>
</form>
<script src="{{asset('assets/dashboard/backEndFiles/uploadMultiImages/image-uploader.min.js')}}"></script>


<script>

    $("#dropify").dropify()


    var images = @json($images);
    $('#input-images-1').imageUploader({
        'imagesInputName':"images",
        preloaded: images,
        preloadedInputName: 'old'
    });




</script>

<script>
    $('.dropify').dropify();

</script>
