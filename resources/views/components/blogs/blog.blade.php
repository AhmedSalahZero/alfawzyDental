
<div class="blog text-center md:text-left px-5 py-10 rounded-[32px] shadow-sm ">
    <a href="{{route('web_blog.index',$id)}}" class="blog__img inline-block relative  max-w-[368px] mb-4">
        <img src="{{ $img }}" class="max-w-full  rounded-2xl">
        <div class="blog__date absolute top-[10px] left-[10px] text-lg font-medium flex-center w-16 h-16 rounded-2xl bg-white text-black px-4 py-2">
            <span>{{ $date }}</span>
        </div>
    </a>
    <div class="blog__title text-main text-xs font-bold mb-3">
        {{ $title }}
    </div>
    <a href="{{route('web_blog.index',$id)}}" class="blog__subtitle inline-block text-black font-semibold text-lg mb-3">
        {{ $subtitle }}
    </a>
    <div class="blog__description text-[#918F8F] text-sm tracking-tight">
        {{ $description }}
    </div>
</div>
