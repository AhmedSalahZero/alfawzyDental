@extends('front.layout.index')
@section('title')

    Contact Us
@endsection
@push('content')
<x-banners.single-banner :lg="true" :title="__('Contact Us')"></x-banners.single-banner>
<section class="contact-us-info-section section -translate-y-1/2 md:-translate-y-[60%] pb-16 lg:pb-0 mb-[-930px] md:mb-[-500px]">
    <div class="res-container">
        <div class="main-branches-elements">
            <div class="main-branches grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-20 ">
                <div class="main-branch-info bg-white shadow-lg rounded-2xl max-w-[380px] py-5 px-6 space-y-2">
                    <div class="branch-icon bg-main w-8 h-8 md:w-11 md:h-11 rounded-2xl  flex-center">
                        <i class="text-white icon-size fa-solid fa-house"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-black ">{{$settings->footer_title1}}</h3>
                    <div class="!text-sm md:!text-lg description__paragraph !text-[#8A8A8A]">{!! $settings->footer_desc1 !!}</div>

                </div>

                <div class="main-branch-info bg-white shadow-lg rounded-2xl max-w-[380px] py-5 px-6 space-y-2">
                    <div class="branch-icon bg-main w-8 h-8 md:w-11 md:h-11 rounded-2xl  flex-center">
                        <i class="text-white icon-size fa-solid fa-house"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-black ">{{$settings->footer_title2}}</h3>
                    <div class="!text-sm md:!text-lg description__paragraph !text-[#8A8A8A]">{!! $settings->footer_desc2 !!}</div>

                </div>


                <div class="main-branch-info bg-white shadow-lg rounded-2xl max-w-[380px] py-5 px-6 space-y-2">
                    <div class="branch-icon bg-main w-8 h-8 md:w-11 md:h-11 rounded-2xl  flex-center">
                        <i class="text-white icon-size fa-solid fa-envelope"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-black ">Our Email Address</h3>
                    <div class="!text-sm md:!text-lg description__paragraph !text-[#8A8A8A]">{{$settings->email}}</div>

                </div>
            </div>
        </div>
        <div class="main-branches-google py-10 px-2 md:px-10 flex flex-col md:flex-row items-start  bg-white shadow-sm md:rounded-[48px] mt-20">
            <div class="basis-1/3">
                <img src="{{get_file($settings->contact_us_image) }}" class="max-w-full" alt="">
            </div>
            <div class="basis-2/3  max-w-[666px]">
                <p class="text-lg leading-8">
                   {{$settings->contact_us_desc}}
                </p>
				<div class="map__link mt-5 ">
					<a target="_blank" href="{{$settings->contact_us_link}}" class=" inline-flex items-center justify-center min-h-[64px] w-[244px] gap-2 capitalize bg-main text-white rounded-2xl shadow-sm">
						<i class="icon-size fa-brands fa-google  "></i>
						<span class="text-lg font-semibold ">{{ __('Map Link') }}</span>
					</a>
				</div>
            </div>
        </div>
    </div>
</section>

@include('front.home.parts.contact')

@endpush

@push('js')

    @include('front.contact.contactJs')

@endpush
