<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('blogs.update',$row->id)}}">
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
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title"
                   value="{{$row->title}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <label for="author_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Author  <span class="red-star">*</span></span>
            </label>
            <select id="author_id" name="author_id" class="form-control">
                <option selected disabled>Select Author</option>
                @foreach($authors as $author)
                    <option @if($row->author_id==$author->id)  selected  @endif value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
            </select>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <label for="blog_category_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Category  <span class="red-star">*</span></span>
            </label>
            <select id="blog_category_id" name="blog_category_id" class="form-control">
                <option selected disabled>Select Category</option>
                @foreach($categories as $category)
                    <option @if($row->blog_category_id==$category->id)  selected  @endif value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
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
