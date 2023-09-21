<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('galleries.store')}}">
    @csrf
    <div class="row g-4">

        <div class="form-group">
            <label for="file" class="form-control-label">Image Or Video </label>
            <input type="file" class="dropify" name="file" data-default-file="" />
        </div>




    </div>
</form>

<script>
    $('.dropify').dropify();

</script>
