<section class="section space-between-sections-t section-bg -mt-52">
    <div class="res-container">
        <div
            class="dential-tourism w-11/12 mx-auto pt-20 bg-main-sharper pb-56  lg:pb-96 relative text-center rounded-[32px] px-3 md:px-5">
            <h1 class="main__title__bold mb-4">Dental Tourism</h1>
            <p class="font-medium text-black tracking-tight text-lg mb-5 max-w-[510px] mx-auto"> {{$dental->desc}} </p>
            <a class="btn bg-white  " href="{{route('dental.tourism.index')}}">
                {{ __('Dential Packages') }}
            </a>
            <img src="{{ get_file($dental->image) }} " alt=""
                 class="absolute rounded-[32px] max-w-[100%] sm:max-w-[90%] md:max-w-[65%] max-h-[500px] left-1/2 -translate-x-1/2 object-cover bottom-0 translate-y-1/2">
        </div>
    </div>
</section>
