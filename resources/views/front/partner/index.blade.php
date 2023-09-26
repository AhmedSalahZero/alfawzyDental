@extends('front.layout.index')
@section('title')

    Partners
@endsection
@push('content')
    <x-banners.single-banner :title="__('Our Partners')"></x-banners.single-banner>

    {{-- {{ dd(getTopManngements()) }} --}}


    <section class="success-parteners section-bg py-20">
        <div class="res-container">
            <div class="our-parteners space-y-10 text-center max-w-[1030px] mx-auto">
                <h2 class="header__text font-bold ">{{ $settings->partner_title }}</h2>
                <p class="description__paragraph ">{{ $settings->partner_desc  }}</p>
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
