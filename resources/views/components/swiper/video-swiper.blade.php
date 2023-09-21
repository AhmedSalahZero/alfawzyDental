	@props([
	'images'=>$images ?? [],
	'swiperClass'=>$swiperClass??'swiper-video'
	])
	
	<div class="swiper {{ $swiperClass }}  ">
	    <div class="swiper-wrapper relative">
	        <!-- Slides -->
	        @foreach($images as $sliderImage)
	        <div class="swiper-slide ">
	            {{-- <img class="" src="{{ $sliderImage }}"> --}}

	            <a href="#">
	                <img src="{{ $sliderImage }}">
	            </a>
	        </div>
	        @endforeach
	    </div>
	    <!-- If we need pagination -->
	    <div class="swiper-pagination"></div>

	    <!-- If we need navigation buttons -->
	    <div class="z-50 w-[200px] h-[100px] relative left-1/2 -translate-x-1/2 top-[25%] -translate-y-1/2 ">
	        <div class=" swiper-button-prev after:!text-sm swiper-button-prev-video !h-6 !w-6  z-10 absolute !left-[-40px]  !mt-0 !top-1/2 !-translate-y-1/2"></div>
	        <div class=" swiper-button-next after:!text-sm swiper-button-next-video !h-6 !w-6  z-10 absolute !right-[-40px] !mt-0 !top-1/2 !-translate-y-1/2 "></div>
	    </div>

	    <!-- If we need scrollbar -->
	    {{-- <div class="swiper-scrollbar"></div> --}}
	</div>
	@push('js')
	<script>
	    window.addEventListener("load", function() {


	        new Swiper(".{{ $swiperClass }}", {
				navigation: {
	                nextEl: ".swiper-button-next-video"
	                , prevEl: ".swiper-button-prev-video"
	             },
	            effect: "coverflow"
	            , grabCursor: true
	            , centeredSlides: true,
			
	                centeredSlidesBounds: true,
					centerInsufficientSlides:true,
					

	            slidesPerView: 'auto'
	            , coverflowEffect: {
	                rotate: -50
	                , stretch: 0
	                , depth: 100
	                , modifier: 1
	                , slideShadows: false
	            , }
	           });


	    });

	</script>
	@endpush
