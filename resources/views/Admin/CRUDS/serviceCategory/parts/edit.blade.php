<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('serviceCategories.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">


        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="{{get_file($row->image)}}" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title" value="{{$row->title}}"/>
        </div>



        <div class="col-sm-12 pb-3 p-2">
            <label for="brief" class="form-label"> Brief <span class="red-star">*</span> </label>
            <textarea name="brief" id="brief" class="form-control" rows="5"
                      placeholder="">{{$row->brief}}</textarea>
        </div>


        <div class="col-sm-12 pb-3 p-2">
            <label for="desc" class="form-label"> Desc <span class="red-star">*</span> </label>
            <textarea name="desc" id="desc" class="form-control" rows="5"
                      placeholder="">{{$row->desc}}</textarea>
        </div>




    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
