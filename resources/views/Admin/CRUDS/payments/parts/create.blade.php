<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('payments.store')}}">
    @csrf
    <div class="row g-4">




        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" placeholder="" name="name"
                   value=""/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <label for="service_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Service  <span class="red-star">*</span></span>
            </label>
            <select id="service_id" name="service_id" class="form-control">
                <option selected disabled>Select Service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->title}}</option>
                @endforeach
            </select>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="price" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Price <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="price" required type="number" class="form-control form-control-solid" placeholder="" name="price"
                   value=""/>
        </div>






    </div>
</form>


