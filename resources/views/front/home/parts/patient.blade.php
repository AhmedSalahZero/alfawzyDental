<section class="our-happy-clients section ">
    <div class="res-container">

        <h1 class="max-w-[240px] main__title__bold mb-10 mx-auto whitespace-nowrap"> {{ __('Our Happy Patients') }} </h1>
        <x-carousel.3d-carousel :patients="$patients"></x-carousel.3d-carousel:patients>
        {{-- <x-swiper.video-swiper :images="[
                asset('front/image/happy.png'),
                asset('front/image/happy.png'),
                asset('front/image/happy.png')
                ]"></x-swiper.video-swiper> --}}
    </div>
</section>
