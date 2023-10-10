@props([
	'link'=>$link ,
	'title'=>$title
])
<li class="py-2  group/li2 block ">
									<a href="{{ $link }}" class="group-hover/li2:text-main whitespace-nowrap text-black capitalize transition-colors duration-300">{{ $title }}</a>
								</li>
