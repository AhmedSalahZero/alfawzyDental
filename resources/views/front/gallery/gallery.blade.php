@extends('front.layout.index')

@push('content')
    <x-banners.single-banner :title="__('Gallery')"></x-banners.single-banner>

    <section class="section space-between-sections-t">
        <div class="res-container">
            <div class="gallery-images  mb-24  ">
                <section class="section">
                    <h1 class="text-center max-w-[490px] mx-auto sub__title !font-bold leading-[52px] mb-10">Before And After Transformations Pictures</h1>
                    <div class="grid-gallery !grid-cols-3">
                        @foreach($images as $image)

                        <div class="gallery-item item--medium" style="background-image:url('{{ get_file($image->file) }}')">
                            </div>
                        @endforeach

                    </div>
                </section>
            </div>




{{--            <div class="gallery-images  mb-24  ">--}}
{{--                <section class="section">--}}
{{--                    <h1 class="text-center max-w-[490px] mx-auto sub__title !font-bold leading-[52px] mb-10">Video</h1>--}}
{{--                    <div class="grid-gallery !grid-cols-3">--}}
{{--                        @foreach($videos as $video)--}}

{{--                            <div class="gallery-item item--medium" style="background-image:url('{{ get_file($video->file) }}')">--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                    </div>--}}
{{--                </section>--}}
{{--            </div>--}}


        </div>

    </section>
    @include('front.home.parts.contact')

@endpush

@push('js')

    @include('front.contact.contactJs')

@endpush
