@extends('front.layout.index')
@section('title')

Galleries
@endsection
@push('content')
<x-banners.single-banner :title="__('Gallery')"></x-banners.single-banner>

<section class="section space-between-sections-t">
    <div class="res-container">
        <div class="gallery-images  mb-24  ">
            <section class="section">
                <h1 class="text-center max-w-[490px] mx-auto sub__title !font-bold leading-[52px] mb-10">{{$settings->gallery_image_title}}    </h1>
                <div class="grid-gallery  !grid-col-1 mg:!grid-col-2  lg:!grid-cols-3">
                    @foreach($images as $image)

                    <div class="gallery-item item--medium" style="background-image:url('{{ get_file($image->file) }}')">
                    </div>
                    @endforeach

                </div>
            </section>
        </div>




        <div x-data="{openGalleryItem:false}" class="gallery-images  mb-24  ">
            <section class="section">
                <h1 class="text-center max-w-[490px] mx-auto sub__title !font-bold leading-[52px] mb-10">{{$settings->gallery_video_title}}</h1>
                <div class="grid-gallery video-gallery !grid-col-1 mg:!grid-col-2  lg:!grid-cols-3">

                    {{-- <ul class="youtube-video-gallery ">
      <li><a href="http://www.youtube.com/watch?v=UCOC1YwNwZw">Call me gordie</a></li>
      <li><a href="http://www.youtube.com/watch?v=CjgT8Af1kGc">Bad scooting</a></li>
      <li><a href="http://www.youtube.com/watch?v=0Yww2VhbFL8">Tango!</a></li>
  </ul> --}}

                    @foreach($videos as $videoIndex=>$video)

                    <div data-video-trigger="{{ $videoIndex }}" class="gallery-item item--medium" style="background-image:url('{{ get_file($image->file) }}')">
                        <div class="absolute-center">
                            <i class="fa-solid fa-circle-play text-8xl"></i>
                        </div>

                    </div>

                    <div data-video-index="{{ $videoIndex }}" class="relative z-10 js-open hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                        <div class="fixed js-overlay inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                        <div class="video-parent fixed  top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2  z-[99999999]  overflow-y-auto">
                            <div class="flex  items-end justify-center p-4 text-center sm:items-center sm:p-0">

                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl">
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">

                                            <div class="mt-3 w-full  text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <video class="w-full gallery-video" muted="true" loop="" autoplay="" playsinline="" controls {{-- controls --}} preload="auto" controlslist="nodownload" disablepictureinpicture="">
                                                    <source src="https://media.geeksforgeeks.org/wp-content/uploads/20210314115545/sample-video.mp4" type="video/mp4">
                                                    {{-- <source src="{{get_file($settings->video_footer)}}" type="video/mp4"> --}}
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="button" class="mt-3 inline-flex close-btn w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">{{ __('Close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>











                    @endforeach

                    {{-- </div> --}}
            </section>
        </div>


    </div>

</section>
@include('front.home.parts.contact')

@endpush

@push('js')

@include('front.contact.contactJs')
<script>
    $('[data-video-trigger]').on('click', function() {
        const index = $(this).attr('data-video-trigger');

        $('.gallery-video').prop('muted', true);
        $('[data-video-index]').addClass('hidden');

        $('[data-video-index="' + index + '"]').removeClass('hidden');
        $('[data-video-index="' + index + '"]').find('video').prop('muted', false)
    })
    $(document).on('click', function(e) {
        const element = e.target

        if (!$(element).closest('.video-gallery').length || $(element).hasClass('js-overlay') || $(element).hasClass('close-btn')) {
            $('.gallery-video').prop('muted', true);
            $('[data-video-index]').addClass('hidden');
        }
    })

</script>
@endpush
