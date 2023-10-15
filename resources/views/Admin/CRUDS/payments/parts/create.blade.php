<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('payments.store')}}">
    @csrf
    <div class="row g-4">




        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" placeholder="" name="name"
                   value=""/>
        </div>





        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="price" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Price <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input id="price" required type="number" class="form-control form-control-solid" placeholder="" name="price"
                   value=""/>
        </div>




        <div class="d-flex justify-content-center mt-3">

            <div class="col-md-4 p-1">
                    <span class="form-check form-switch  " @if( app()->getLocale()=='en') style="border:1px solid #F3F3F9;padding: 10px; padding-left: 40px;border-radius: 4px;" @else  style="border:1px solid #F3F3F9;padding: 10px; padding-right: 40px;border-radius: 4px;" @endif>
                      <input class="form-check-input  " type="checkbox"  value=""
                             id="check_all">
                      <label class="form-check-label mx-1" for="check_all">
                       اختيار جميع  الخدمات
                      </label>
                    </span>
            </div>

        </div>




        <div class=" row my-4">
            @foreach($services as $service)
                <div class="col-md-4 p-1">
                    <span class="form-check form-switch  " @if( app()->getLocale()=='en') style="border:1px solid #F3F3F9;padding: 10px; padding-left: 40px;border-radius: 4px;" @else  style="border:1px solid #F3F3F9;padding: 10px; padding-right: 40px;border-radius: 4px;" @endif>
                      <input class="form-check-input  checkbox" type="checkbox" name="services[]" value="{{$service->id}}"
                             id="flexCheckDefault{{$service->id}}">
                      <label class="form-check-label mx-1" for="flexCheckDefault{{$service->id}}">
                       {{$service->title}}
                      </label>
                    </span>
                </div>
            @endforeach
        </div>






    </div>
</form>


