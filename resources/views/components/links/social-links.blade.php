@props([
	'iconName'=>$iconName,
	'iconClass'=>$iconClass,
	'iconLink'=>$iconLink,
	'iconSize'=>$iconSize ?? 'icon-size'
])
<li class="" title="{{ $iconName }}">
    <a class="bg-white hover:bg-[#B6B3B1] group/a p-2 rounded-full shadow-sm w-10 h-10 flex-center transition-all duration-300" href="{{ $iconLink }}">
        <i title="{{ $iconName }}" class="{{ $iconClass }} {{ $iconSize }} group-hover/a:text-white   transition-all duration-500 text-[#B6B3B1]">
        </i>
    </a>
</li>
