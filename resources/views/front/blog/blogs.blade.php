@extends('front.layout.index')
@section('title')

    Blog
@endsection
@push('content')
    <x-banners.single-banner :title="__('blog')"></x-banners.single-banner>
    <section class="blogs-section space-between-sections-y ">
        <div class="res-container">
            <div class="blog__content ">
                <h3 class="text-center text-4xl font-bold capitalize mb-16">{{ __('stay updated with our latests news') }}</h3>
                <div class="blogs grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-y-20 gap-x-10 justify-center items-center">
                    @foreach($blogs as $blog)
                        <x-blogs.blog
                            :img="get_file($blog->image)"
                            :date="date('d M', strtotime($blog->created_at))"
                            :title="substr($blog->title, 0, 30)"
                            :subtitle="substr($blog->brief, 0, 30)"
                            :id="$blog->id"
                            :description="substr($blog->desc, 0, 30)"  ></x-blogs.blog>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


@endpush
