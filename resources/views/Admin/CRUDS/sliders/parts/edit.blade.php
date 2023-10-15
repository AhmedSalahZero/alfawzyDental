<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('sliders.update',$row->id)}}">
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
                <span class="required mr-1">Title </span>
            </label>
            <!--end::Label-->
            <input id="title"  type="text" class="form-control form-control-solid" placeholder="" name="title"
                   value="{{$row->title}}"/>
        </div>




    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
