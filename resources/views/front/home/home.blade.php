@extends('front.layout.index')

@section('title')

    Home
@endsection

@push('content')

    @include('front.home.parts.slider')


    @include('front.home.parts.services')

    @include('front.home.parts.about')

    @include('front.home.parts.doctor')


    @include('front.home.parts.dental')

    @include('front.home.parts.review')

    @include('front.home.parts.patient')

    @include('front.home.parts.contact')


    @include('front.home.parts.counter')



@endpush
@push('js')
    <style>
        .testimonial-swiper {
            max-width: 100%;
        }
    </style>
    <script>
        window.addEventListener("load", function () {
            new Swiper(".testimonial-swiper", {
                loop: true,
                slidesPerView: "2",

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
                    1000: {
                        slidesPerView: 3
                        , spaceBetween: '30'
                    }
                },
                spaceBetween: 30,
                speed: 6000,

                autoplay: {
                    delay: 0,
                    disableOnInteraction: false
                },

                // Navigation arrows

            });
            new Swiper(".testimonial-swiper2", {
                loop: true,
                slidesPerView: "3",

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
                    1000: {
                        slidesPerView: 3
                        , spaceBetween: '30'
                    }
                },
                spaceBetween: 30,
                speed: 6000,

                autoplay: {
                    delay: 0,
                    disableOnInteraction: false
                },

                // Navigation arrows

            });
        });


    </script>

    @include('front.contact.contactJs')
@endpush
