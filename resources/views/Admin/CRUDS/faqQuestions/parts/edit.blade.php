<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('faq_questions.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Question <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title" value="{{$row->title}}"/>
        </div>

        <div class="col-sm-12 pb-3 p-2">
            <label for="desc" class="form-label"> Answer <span class="red-star">*</span> </label>
            <textarea name="desc" id="desc" class="form-control" rows="5"
                      placeholder="">{{$row->desc}}</textarea>
        </div>




    </div>
</form>
