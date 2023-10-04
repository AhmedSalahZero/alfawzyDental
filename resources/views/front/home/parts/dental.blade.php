<section class="section space-between-sections-t -mt-52">
    <div class="res-container">
        <div class="dential-tourism w-11/12 mx-auto pt-20 bg-main-sharper pb-28  lg:pb-96 relative text-center rounded-[32px] px-3 md:px-5">
            <h1 class="main__title__bold mb-4">{{__('Dental Tourism')}}</h1>
            <p class="font-medium text-black tracking-tight text-lg mb-5 max-w-[700px] mx-auto opacity-60"> {{$dental->desc}} </p>
            <a class="btn bg-white  " href="{{route('dental.tourism.index')}}">
                {{ __('Dental Packages') }}
            </a>


            <div class="img-scrolled absolute bottom-0 translate-y-1/2 left-1/2 -translate-x-1/2 w-[90%] md:w-[50%] lg:w-[800px] ">
                <div class="scroll-from-bottom-to-up ">
                    <img src="{{ get_file($dental->image) }} " alt="" class="  rounded-[32px]   object-cover ">
                </div>
            </div>


        </div>
    </div>
</section>
