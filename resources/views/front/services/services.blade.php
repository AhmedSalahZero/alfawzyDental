@extends('front.layout.index')
@section('title')

    Service
@endsection
@push('content')
<x-banners.single-banner :title="__('Our Services')"></x-banners.single-banner>
{{-- {{ dd(getTopManngements()) }} --}}
<section class="top-managements  section-py">
    <div class="res-container">
        @foreach($categories as $index=>$category)
        <div class="top-managemet-element mb-24">
            <div class="top-managements__title text-center">
                <x-badges.badge :title="$category->title" :lg="true"></x-badges.badge>
            </div>
            <div class="doctors-cards element-internal-padding grid  sm:gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3  justify-items-center items-center">
                @foreach($category->services as $service)
                <x-cards.flip-card>
                    <x-slot name="front__face">
                        <a href="#" onclick="return false">
                            <img class="h-[280px] object-cover w-[310px] md:w-[342px] rounded-[32px] mx-auto" src="{{ get_file($service->image)}}">
                            <p class="mt-3 text-2xl font-semibold">{{ $service->title }}</p>
                        </a>
                    </x-slot>
                    <x-slot name="back__face">
                        <p>{!! $service->desc !!}</p>
                    </x-slot>

                </x-cards.flip-card>
                @endforeach
            </div>
        </div>
        @endforeach

{{-- {{ dd($special_services) }} --}}
            @foreach($special_services as $service)
                <div class="top-managemet-element mb-24 py-5 px-2 md:px-20 shadow-sm rounded-[32px] ">
                    <div class="top-managements__title text-center mb-16 ">
                        <x-badges.badge :title="$service->title" :lg="true"></x-badges.badge>
                    </div>
                    <div class="service-description__item flex flex-col md:flex-row flex-wrap ">
                        <div class="service__description-img basis-1/4 mb-4 md:mb-0">
                            <img src="{{get_file($service->image)}}" alt="" class="max-w-full rounded-[32px]">
                        </div>
                        <div class="service__description-infos  text-lg basis-3/4 leading-9 t  md:pl-10 max-w-[732px] text-justify">
						<div>
						Preventive dentistry is dental care that helps maintain good oral health. It deals with all prophylactic measurements and services which can be delivered for susceptible patients to avoid the problem before occurrence as well as dealing with oral conditions to be discovered in its primary stages.
						It’s a combination of regular dental check-ups along with developing good habits like brushing and flossing. Taking care of your teeth starts early in childhood and extends throughout the course of your life.
						</div>
						<ul class="list-disc list-inside mt-3">
						@foreach(['Regular oral exam, usually every 6 months.','Nutrition counseling sessions.','Prophylactic teeth cleaning.','Routine X-rays.'] as $serviceListItem)
							<li>
							<span class="ml-[-15px] md:ml-0">
								{{ $serviceListItem }}
							</span>
							</li>

							@endforeach 
							
						</ul>
						{{-- {!! $service->desc !!} --}}
                        </div>
                        <div class="basis-full max-w-[1146px] leading-9 text-justify mt-9">
							<h2 class="font-semibold text-xl  ">What’s your role in preventive dental care? </h2>
							<p class="text-lg leading-9 mb-5">Much of your preventive dental care starts with you. Developing healthy dental habits early in life can help reduce cavities, gum disease, and gingivitis.1 Here are the basics of good oral health: </p>
							<ul class="list-disc list-inside ">
							@foreach ([
								'Brush your teeth at least 2 times a day—usually morning and night--using a soft bristled brush and a fluoride toothpaste. Your dentist can recommend the best toothbrush and toothpaste for you. They can also instruct you on how to properly brush.',
								'Floss daily to get food that’s stuck between teeth before it turns to plaque.',
								'Use a mouthwash to rinse out food particles after flossing.',
								'Avoid acidic foods that can harm tooth enamel.',
								'Be cautious with hard foods, like some candies, foods with bones, seeds, or pits that could damage or chip teeth.',
								'Don’t smoke or use tobacco products--these can lead to cancer and other dental problems.',
								'Use a mouth guard when participating in certain sports.',
								'If you grind your teeth at night, ask your dentist for a nighttime mouth guard to help reduce gum recession.'
							] as $liDescriptionElement)
								<li class="text-lg mb-2 ">
									<span class="ml-[-15px] md:ml-0">{{ $liDescriptionElement }}</span>
								</li>	
							@endforeach
							</ul>
                            {{-- {!! $service->details !!} --}}

                        </div>
                    </div>
                </div>
            @endforeach

    </div>

</section>

@include('front.home.parts.contact')

@endpush

@push('js')
    @include('front.contact.contactJs')


@endpush
