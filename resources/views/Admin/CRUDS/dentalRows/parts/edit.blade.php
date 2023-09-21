<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('dental_tourism_rows.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title" value="{{$row->title}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="type" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Type <span class="red-star">*</span></span>
            </label>

            <select id="type" name="type" class="form-control">
                <option @if($row->type=='title1') selected @endif  value="title1">Title1</option>
                <option @if($row->type=='title2') selected @endif value="title2">Title2</option>

            </select>

        </div>







    </div>
</form>
