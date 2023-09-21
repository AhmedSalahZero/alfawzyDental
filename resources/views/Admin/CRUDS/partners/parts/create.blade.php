<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('partners.store')}}">
    @csrf
    <div class="row g-4">

        <div class="form-group">
            <label for="image" class="form-control-label">{{trans('admin.image')}} </label>
            <input type="file" class="dropify" name="image" data-default-file="" accept="image/*"/>
            <span
                class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>>




    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
