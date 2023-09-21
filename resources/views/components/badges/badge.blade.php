@props([
	'title'=>$title,
	'lg'=>$lg ??false 
])
@php
	$classes = 'badge inline-block px-3 py-2 font-semibold  bg-[#F6EEE0] rounded-[40px] text-black uppercase ';
	$classes = $lg ? $classes . ' ' . '!block sm:!inline-block md:px-8' : $classes ;
@endphp
<span {{ $attributes->merge(['class'=>$classes]) }}>
	{{ $title }}	
</span>
