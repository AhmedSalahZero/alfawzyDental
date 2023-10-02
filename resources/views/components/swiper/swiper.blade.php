	@props([
	'services'=>$services ?? [],
	'swiperClass'=>$swiperClass??'swiper-img'
	])
	<div class="swiper {{ $swiperClass }}  ">
	    <div class="swiper-wrapper">
	        <!-- Slides -->
	        @foreach($services as $service)
	        <div class="swiper-slide mb-20 ">
	            {{-- <img class="" src="{{ $sliderImage }}"> --}}
	            <x-cards.flip-card>
	                <x-slot name="front__face">
					<a href="#" onclick="return false">
	                    <img class="h-[280px] object-cover w-[310px] md:w-[342px] rounded-[32px] mx-auto" src="{{ get_file($service->image) }}">

						<p class="text-xl font-semibold tracking-tight text-black mt-5 ">{{ $service->title }}</p>
	                </a>
					</x-slot>
					 <x-slot name="back__face">
                         <p>{{$service->desc}}</p>
					</x-slot>

	            </x-cards.flip-card>

	        </div>
	        @endforeach
	    </div>
	    <!-- If we need pagination -->
	    <div class="swiper-pagination"></div>

	    <!-- If we need navigation buttons -->
	    <div class="z-50  relative left-1/2 -translate-x-1/2 top-[-70px] md:top-[-1px] inline-block mt-16 md:mt-0 swiper-buttons-container scroll-from-bottom-to-up">
	        <div class=" swiper-button-prev swiper-button-prev-img !h-6 !w-6 lg:!h-12 lg:!w-12 z-10 absolute !left-[-40px]  sm:!left-[-100px] md:!left-[-180px] !mt-0 !top-1/2 !-translate-y-1/2"></div>
	        <div class=" swiper-button-next swiper-button-next-img !h-6 !w-6 lg:!h-12 lg:!w-12 z-10 absolute !right-[-40px] sm:!right-[-100px] md:!right-[-180px] !mt-0 !top-1/2 !-translate-y-1/2 "></div>
	        <a href="{{route('web_services.index')}}" class="all-services px-3 py-2  lg:py-3 lg:px-5 z-10 text-base lg:text-xl block text-white bg-main rounded-2xl capitalize"> view all services</a>
	    </div>

	    <!-- If we need scrollbar -->
	    {{-- <div class="swiper-scrollbar"></div> --}}
	</div>
	@push('js')
	<script>
	    window.addEventListener("load", function() {
	        new Swiper(".{{ $swiperClass }}", {
	            spaceBetween: 60,

	            // Optional parameters

	            loop: false
	            , direction: "horizontal"
	            , grabCursor: false
	            , autoHeight: false
	            , centeredSlides: false
	            , centeredSlidesBounds: false,

	            // If we need pagination
	            breakpoints: {
	                // when window width is >= 320px
	                320: {
	                    slidesPerView: 1
	                    , spaceBetween: 20
	                }
	                , 640: {
	                    slidesPerView: 2
	                    , spaceBetween: 20
	                },
	                // when window width is >= 480px

	                // when window width is >= 640px
	                1280: {
	                    slidesPerView: 4
	                    , spaceBetween: '40'
	                }
	            , },

	            // Navigation arrows
	            navigation: {
	                nextEl: ".swiper-button-next-img"
	                , prevEl: ".swiper-button-prev-img"
	            , }
	        , });
	    });

	</script>
	@endpush
