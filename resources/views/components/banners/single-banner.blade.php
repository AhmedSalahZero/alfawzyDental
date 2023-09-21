@props([
	'title'=>$title,
	'lg'=>$lg ?? false 
])
<section class="banner single-banner">
	{{-- <div class="res-container"> --}}
		<div class="banner__content
		@if($lg)
	 	min-h-[1060px] md:min-h-[709px]
		flex items-start pt-20 justify-center
		@else
		min-h-[227px]
		flex-center
		@endif 
		   bg-[#CDCDCD]">
			<div class="banner__title ">
				<h3 class="!uppercase main__title__bold ">{{ $title }}</h3>
			</div>
		</div>
	{{-- </div> --}}
</section>
