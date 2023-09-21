<div>

    <h4 class="card-title">اعدادات صفحة التعليقات</h4>

    <form id="Form_counter" method="post" action="{{route('settings.update',$settings->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_type" value="counter">



        <div class="row mb-3">




            <div class="col-6">
                <label for="counter1_title" class="form-label">  Counter 1 Title</label>
                <input type="text" id="counter1_title" name="counter1_title" class="form-control" placeholder="" value="{{$settings->counter1_title}}">
            </div>

            <div class="col-6">
                <label for="counter1" class="form-label">   Counter 1</label>
                <input dir="ltr" type="number" id="counter1" name="counter1" class="form-control" placeholder="" value="{{$settings->counter1}}">
            </div>


            <div class="col-6">
                <label for="counter2_title" class="form-label">  Counter 2 Title</label>
                <input type="text" id="counter2_title" name="counter2_title" class="form-control" placeholder="" value="{{$settings->counter2_title}}">
            </div>

            <div class="col-6">
                <label for="counter2" class="form-label">   Counter 2</label>
                <input dir="ltr" type="number" id="counter2" name="counter2" class="form-control" placeholder="" value="{{$settings->counter2}}">
            </div>






            <div class="col-6">
                <label for="counter3_title" class="form-label">  Counter 3 Title</label>
                <input type="text" id="counter3_title" name="counter3_title" class="form-control" placeholder="" value="{{$settings->counter3_title}}">
            </div>

            <div class="col-6">
                <label for="counter3" class="form-label">   Counter 3</label>
                <input dir="ltr" type="number" id="counter3" name="counter3" class="form-control" placeholder="" value="{{$settings->counter3}}">
            </div>







            <div class="col-6">
                <label for="counter4_title" class="form-label">  Counter 4 Title</label>
                <input type="text" id="counter4_title" name="counter4_title" class="form-control" placeholder="" value="{{$settings->counter4_title}}">
            </div>

            <div class="col-6">
                <label for="counter4" class="form-label">   Counter 4</label>
                <input dir="ltr" type="number" id="counter4" name="counter4" class="form-control" placeholder="" value="{{$settings->counter4}}">
            </div>





        </div>


        <div class="row mt-4">


            <div class="col-sm-6 mt-3">
                <div class="text-end">
                    <button id='btnCounter' form="Form_counter" type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save me-1"></i> حفظ
                    </button>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </form>
</div>
