<section class="space-between-sections-t mt-20 md:mt-64">
    <div class="res-container overflow-x-hidden">
        <div class="testimonal-parent flex flex-col md:flex-row items-center relative justify-between gap-10">
            <div class=" description relative basis-1/3 max-w-[300px] z-[2]  md:mt-[-100px]">
                <div class="max-w-[274px] ">
                    <h1 class="main__title__bold mb-10">{{ __('What Our Patients Say') }}</h1>
                    <a href="{{$settings->review_link}}"  target="_blank" class=" absolute bottom-[-638%] sm:bottom-[-544%] md:static  btn bg-main !inline-flex items-center justify-between text-white ">
                        <i class="fa-brands fa-google bg-main mr-2 rounded-2xl "></i>
                        <span class="normal-text whitespace-nowrap ">{{__('Read our Reviews')}}</span>
                    </a>
                </div>
            </div>
            <div class="testimonals-elements grow relative z-1 ">
{{-- {{ dd($oddReview,$evenReviews) }} --}}
                <div class="swiper testimonial-swiper   w-screen ">
                    <div class="swiper-wrapper">
{{-- {{ dd($evenReviews , $oddReview) }} --}}
                        {{-- <div class="grid testimonals grid-cols-1 md:grid-cols-2 gap-10"> --}}
                        <x-testimonial.testimonial :reviews="$oddReview">
                        </x-testimonial.testimonial>

                        {{-- </div> --}}

                    </div>
                </div>
				
				
				 <div class="swiper testimonial-swiper2   w-screen mt-[-9rem] ">
                    <div class="swiper-wrapper">

                        {{-- <div class="grid testimonals grid-cols-1 md:grid-cols-2 gap-10"> --}}
                        <x-testimonial.testimonial :reviews="$evenReviews">
                        </x-testimonial.testimonial>

                        {{-- </div> --}}

                    </div>
                </div>

               
            </div>
        </div>
    </div>
</section>
