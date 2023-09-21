@extends('front.layout.index')

@push('content')
<x-banners.single-banner :title="__('Our Services')"></x-banners.single-banner>

{{-- {{ dd(getTopManngements()) }} --}}
<section class="top-managements section-bg section-py">
    <div class="res-container">
        @foreach($categories as $index=>$category)
        <div class="top-managemet-element mb-24">
            <div class="top-managements__title text-center">
                <x-badges.badge :title="$category->title" :lg="true"></x-badges.badge>
            </div>
            <div class="doctors-cards element-internal-padding grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3  justify-items-center items-center">
                @foreach($category->services as $service)
                <x-cards.flip-card>
                    <x-slot name="front__face">
                        <a href="#">
                            <img class="h-[280px] object-cover w-[310px] md:w-[342px] rounded-[32px] mx-auto" src="{{ get_file($service->image)}}">
                            <p class="mt-3 text-2xl font-semibold">{{ $service->title }}</p>
                        </a>
                    </x-slot>
                    <x-slot name="back__face">
                        <p>{{$service->desc}}</p>
                    </x-slot>

                </x-cards.flip-card>
                @endforeach
            </div>
        </div>
        @endforeach


</section>

@include('front.home.parts.contact')

@endpush

@push('js')
    @include('front.contact.contactJs')


@endpush
