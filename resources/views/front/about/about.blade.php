@extends('front.layout.index')
@section('title')

    About
@endsection
@push('content')
<x-banners.single-banner :title="__('About Us')"></x-banners.single-banner>
<section class="about-us section  space-y-md">
    <div class="res-container">
        <div class="about-us-content flex flex-col md:flex-row gap-8 lg:gap-20">
            <div class="about-us__images h-[440px] lg:h-auto  lg:basis-1/2 space-right relative">
				
				<img class="shared-abs max-w-[210px] lg:max-w-[274px] absolute top-[17px] ml-[-60px] lg:ml-[-25px] " src="{{ asset('front/image/about/1.png') }}">
				<img class="shared-abs  absolute ml-[27%] md:ml-[33%] lg:ml-[33%] top-[-36%]   max-w-[168px]" src="{{ asset('front/image/about/3.png') }}">
				<img class="shared-abs max-w-[274px] ml-[5%] lg:ml-[20%] absolute  top-[-40%] " src="{{ asset('front/image/about/2.png') }}">
                {{-- <img src="{{get_file($row->image1)}}" class="w-[90%]"> --}}
            </div>
            <div class="about__descriptions basis-1/2 space-left">
                <h2 class="max-w-none md:max-w-[438px]  mb-5 main__title__bold ">{{$row->title}}</h2>
                <p class="description__paragraph mb-3">{!! $row->desc !!}</p>


            </div>
        </div>

    </div>
</section>

<section class="our-missions section space-y-md">
    <div class="res-container">
        <div class="our-missions__content">
            <div class="flex flex-col md:flex-row  ">
                <div class="basis-1/2 space-right mb-5 md:mb-0">
                    <div class="our-missions flex flex-col gap-6 ">

                        <div class="our-mission-element space-y-3">
                            <x-badges.badge :title="$row->our_vision_title"></x-badges.badge>
                            <p class="description__paragraph "> {{$row->our_vision_desc}}</p>
                        </div>

                        <div class="our-mission-element space-y-3">
                            <x-badges.badge :title="$row->our_goal_title"></x-badges.badge>
                            <p class="description__paragraph "> {{$row->our_goal_desc}}</p>
                        </div>


                        <div class="our-mission-element space-y-3">
                            <x-badges.badge :title="$row->our_mission_title"></x-badges.badge>
                            <p class="description__paragraph "> {{$row->our_mission_desc}}</p>
                        </div>


                        <a target="_blank" href="{{getWhatsappApi($settings->whatsapp)}}" class="whatsapp__container inline-flex items-center justify-center social-whatsapp mr-auto">
                            <x-social.whatsapp></x-social.whatsapp>
                        </a>

                    </div>
                </div>
                <div class="basis-1/2 space-left shrink">
                    <div class="our-mission__image">
                        <img src="{{ get_file($row->image2)}}" class="max-w-full mx-auto rounded-2xl object-cover" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section dential-team space-y-md">
    <div class="res-container">
        <div class="dential-team-parent">
            <div class="dential-team__header space-y-3 max-w-[906px] mx-auto text-center mb-6">
                <h3 class="header__text font-bold ">{{ $row->team_title }}</h3>
                <div class="description__"> {!! $row->team_desc !!}</div>
            </div>
            <div class="dential-team__images">
                <img src="{{get_file($row->team_image)}}" class="w-full rounded-2xl" alt="">
            </div>
        </div>
    </div>
</section>
<section class="meet-founders section space-y-md">

    <div class="res-container">

        <div class="founder__title text-center ">
            <x-badges.badge : :title="__('Meet The Founders')" :lg="true"></x-badges.badge>
        </div>
        <div class="founders flex flex-col mt-3 gap-8 items-start ">
            @foreach($specialCategory->members??[] as $member)
            <div class="founder shadow-md rounded-2xl element-internal-padding space-y-5 flex justify-center items-cener flex-col md:flex-row  gap-4 lg:gap-12 w-full">
                <div class="founder-info text-center w-[332px] mx-auto">
                    <img src="{{ get_file($member->image) }}" alt="" class="rounded-2xl mb-6  max-w-full h-[325px] object-cover ">
                    <p class="name__title">{{ $member->name }}</p>
                    <p class="subname__title ">{{ $member->job_title }}</p>
                </div>
                <div class="founder-description flex-1">
                    <div class="description__paragraph max-w-[723px] !leading-9">{{ $member->desc }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- {{ dd(getTopManngements()) }} --}}
<section class="top-managements  shadow-sm section-py">
    <div class="res-container ">
        @foreach( $categories as $key =>$category)
        <div class="top-managemet-element mb-24">
            <div class="top-managements__title text-center">
                <x-badges.badge :title="$category->header_show" :lg="true"></x-badges.badge>
            </div>
            <div class="doctors-cards element-internal-padding grid gap-x-4  grid-cols-1 sm:grid-cols-2  lg:grid-cols-4 justify-items-center items-center">
                @foreach($category->members as $member)
                <x-cards.flip-card :enabled="false">
                    <x-slot name="front__face">
                        <div class="doctor__image mb-6 mx-auto">
                            <img class="rounded-[22px] max-w-full h-[485px] w-full object-cover" src="{{ get_file($member->image)}}" alt="{{ $row->name}}">
                        </div>
                        <p class="name__title">{{ $member->name }}</p>
                        <p class="subname__title">{{ $member->job_title }}</p>
                    </x-slot>
                    <x-slot name="back__face">
                        <p>{{$member->desc}}</p>
                    </x-slot>

                </x-cards.flip-card>

                @endforeach
    </div>
    </div>
        @endforeach
    </div>
</section>

<section class="success-parteners shadow-sm py-20">
    <div class="res-container">
        <div class="our-parteners  space-y-10 text-center max-w-[1030px] mx-auto">
            <h2 class="header__text font-bold ">{{ $settings->partner_title }}</h2>
            <p class="description__paragraph !text-center">{{ $settings->partner_desc  }}</p>
            <div class="grid  grid-cols-1 gap-y-10 gap-x-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-items-center items-center">
                @foreach($partners as $index=>$partner)
                    <div class="partener-img">
                        <img src="{{ get_file($partner->image) }}" alt="">
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
