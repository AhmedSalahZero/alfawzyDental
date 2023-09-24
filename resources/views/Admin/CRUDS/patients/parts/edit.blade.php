<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('patients.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">



        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="{{get_file($row->image)}}" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>


        <div class="form-group">
            <label for="video" class="form-control-label">Video </label>
            <input type="file" class="dropify" name="video" data-default-file="{{get_file($row->video)}}" accept="video/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: mp4.')}}</span>
        </div>




    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
