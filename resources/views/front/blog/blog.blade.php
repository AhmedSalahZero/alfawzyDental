@extends('front.layout.index')
@section('title')

    Blog
@endsection
@push('content')
<x-banners.single-banner :title="$blog->title"></x-banners.single-banner>
<section class="section space-between-sections-y">
    <div class="res-container">
        <div class="blog__header mb-10">
            <div class="max-w-[950px] space-y-4 mx-auto">
                <h1 class="text-main font-bold text-xs capitalize">{{ $blog->category->title??''}}</h1>
                <p class="max-w-[682px] text-5xl font-semibold capitalize leading-[60px]">{{ $blog->title }}</p>
                <div class="bloger__images flex gap-3 items-center mb-5">
                    <div class="bloger__img">
                        <img src="{{ get_file($blog->author->image??'') }}" class="w-12 h-12 rounded-full " alt="">
                    </div>
                    <div class="bloger__infos">
                        <p class="bloger__name font-bold ">{{ $blog->author->name??'' }}</p>
                        <p class="blogger__date text-gray-500 text-xs ">{{date('d M', strtotime($blog->created_at))}}</p>
                    </div>
                </div>
                <div class="text-gray-500 leading-8 font-medium ">
                    <p>{{ $blog->brief }}</p>
                </div>
            </div>
        </div>

        <div class="blog__lg-img mb-10">
            <img src="{{ get_file($blog->image)}}" class="max-w-full mx-auto rounded-[32px]" alt="">
        </div>

        <div class="max-w-[950px] leading-8 mx-auto text-gray-500 ">
            {{$blog->desc}}
  </div>

        <div class="stay-updated mt-20">
            <h3 class="capitalize font-bold text-3xl mb-8 text-center ">{{ __('stay updated with our latests news') }}</h3>
            <div class="blogs grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-y-20 gap-x-10 justify-center items-center">
                @foreach($blogs as $index=>$blog)

                    <x-blogs.blog :img="get_file($blog->image)" :date="date('d M', strtotime($blog->created_at))" :title="substr($blog->title, 0, 30)" :subtitle="substr($blog->brief, 0, 30)" :description="substr($blog->desc, 0, 30)"></x-blogs.blog>

                @endforeach
            </div>
        </div>

    </div>


</section>




@endpush
