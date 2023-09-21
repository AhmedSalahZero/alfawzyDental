@extends('front.layout.index')

@push('content')
<x-banners.single-banner :title="__('dental tourism')"></x-banners.single-banner>
<section class="pyramids space-between-sections-t">
    <div class="res-container">
        <div class="dental-tourism space-y-4 ">
            <img src="{{get_file($dental->image)}}" class="max-w-full mx-auto" alt="">
            <div class="dential-tourism-infos px-2 md:px-10">
                <p class="description__paragraph mb-4">
                    {{$dental->desc}}
                </p>

                <div class="listed-element mb-8 last:mb-0">
                    <h3 class="py-2 px-2 md:px-5  mb-4 text-center text-xl font-semibold text-black inline-flex items-center justify-center shadow-md rounded-xl bg-white">
                        {{ $dental->title1 }}
                    </h3>
                    <p class="description__paragraph mb-4">
                        {{ $dental->desc1 }}
                    </p>
                    @foreach($dental->rows->where('type','title1') as $row)
                    <div class="checked-item flex gap-2 items-center mb-4">
                        <i class="icon-size text-black  fa-regular fa-circle-check"></i>
                        <p>{{ $row->title }}</p>
                    </div>
                    @endforeach
                </div>


                <div class="listed-element mb-8 last:mb-0">
                    <h3 class="py-2 px-2 md:px-5  mb-4 text-center text-xl font-semibold text-black inline-flex items-center justify-center shadow-md rounded-xl bg-white">
                        {{ $dental->title2 }}
                    </h3>
                    <p class="description__paragraph mb-4">
                        {{ $dental->desc2 }}
                    </p>
                    @foreach($dental->rows->where('type','title2') as $row)
                        <div class="checked-item flex gap-2 items-center mb-4">
                            <i class="icon-size text-black  fa-regular fa-circle-check"></i>
                            <p>{{ $row->title }}</p>
                        </div>
                    @endforeach
                </div>

                           </div>
        </div>

		<div class="dental-grid">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-20 justify-items-center items-center">
				@foreach($dental->images as $image)
				<div class="dental-grid-img">
					<img src="{{ get_file($image->image) }}" class="max-w-full ">
				</div>
				@endforeach
			</div>
		</div>


    </div>
</section>
@include('front.home.parts.contact')

@endpush


@push('js')
    @include('front.contact.contactJs')

@endpush



