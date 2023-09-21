<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('members.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">



        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="{{get_file($row->image)}}" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{$row->name}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="job_title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">job Title <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" placeholder="" name="job_title" value="{{$row->job_title}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="category_member_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> category member <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <select id="category_member_id" name="category_member_id" class="form-control">
                <option>Select Category </option>
                @foreach($categories as $category)
                    <option @if($row->category_member_id==$category->id) selected   @endif value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>



        <div class="col-sm-6 pb-3 p-2">
            <label for="desc" class="form-label"> Desc <span class="red-star">*</span> </label>
            <textarea name="desc" id="desc" class="form-control" rows="5"
                      placeholder="">{{$row->desc}}</textarea>
        </div>



    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
