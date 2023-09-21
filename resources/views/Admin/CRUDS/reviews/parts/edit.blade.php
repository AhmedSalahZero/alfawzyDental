<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('reviews.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">



        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="{{get_file($row->image)}}" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{$row->name}}"/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="rate" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Rate <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="rate" min="1" max="5" required type="number" class="form-control form-control-solid" placeholder="" name="rate" value="{{$row->rate}}"/>
        </div>



        <div class="col-sm-12 pb-3 p-2">
            <label for="text" class="form-label"> Comment <span class="red-star">*</span> </label>
            <textarea name="text" id="text" class="form-control" rows="5"
                      placeholder="">{{$row->text}}</textarea>
        </div>



    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
