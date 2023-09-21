@props([
'reviews'=>$reviews??[]
])
@foreach($reviews as $review)
    <div class="testimonial py-10 px-5 shadow-lg rounded-2xl space-y-5 swiper-slide w-full md:w-[440px] mb-5 !h-max" >
        <div class="testimonial__upper flex items-center ">
            <div class="testimonal__image  mr-3 inline-block rounded-full">
                <img src="{{ get_file($review->image) }}" alt="" class="rounded-full border-[3px] border-[#EDE7E7] shadow-sm w-14 h-14 object-cover">
            </div>
            <div class="testimonial__info">
                <h3 class="normal__title capitalize text-sm">{{ $review->name }} </h3>
                <div class="starts">
                    @for($star = 0 ; $star<$review->rate ; $star++)
                        <i class="fa-solid fa-star text-main text-sm "></i>
                    @endfor
                </div>
            </div>
            <div class="ml-auto float-right self-start">
                <i class="fa-solid fa-quote-right text-aquamarine text-2xl "></i>
            </div>
        </div>
        <p class="text-[#6B7385]">
            {{$review->text}}
        </p>
    </div>
@endforeach
@once
    @push('js')


    @endpush
@endonce
