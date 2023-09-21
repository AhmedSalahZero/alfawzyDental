@extends('front.layout.index')

@push('content')
<x-banners.single-banner :title="__('Frequently Asked Questions and Answers')"></x-banners.single-banner>
<section class="section space-between-sections faq-section">
    <div class="res-container">
        <div class="faq-elements">
            <div class="faqs">

                <div class="max-w-screen-xl mx-auto px-5 bg-white min-h-sceen">

                    <div class="grid divide-y divide-neutral-200 max-w-2xl mx-auto mt-8">
						@foreach($faqs as $index=>$faq)
                        <div class="py-5">
                            <details class="group faq-group">
                                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                                    <span class="faq-title"> {{$faq->title }}</span>
                                    <span class="transition group-open:rotate-180">
                                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                                </summary>
                                <p class="text-neutral-600 text-sm mt-3 group-open:animate-fadeIn">
                                   {{ $faq->desc }}
                                </p>
                            </details>
                        </div>
						@endforeach

                    </div>
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
