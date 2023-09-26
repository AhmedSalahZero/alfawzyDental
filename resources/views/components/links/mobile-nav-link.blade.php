@props([
'title'=>$title ,
'link'=>$link,
'subMenu'=>$subMenu??[]
])
<li x-data="{isMenuIsOpen:false}" x-cloak class="border-b  pb-3 group/li-mobile border-gray-200 transition-all duration-300 ease-in-out">
    <a @click="isMenuIsOpen=!isMenuIsOpen" href="{{ $link }}" class="group-hover/li-mobile:text-main transition-all duration-300 ease-in ">
        <span>{{ $title }}</span>
        <i class="fa-solid fa-chevron-down text-xs"></i>
    </a>
    @if(count($subMenu))
    <ul
	class="py-3 pl-3"
	 x-show="isMenuIsOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="">
        @foreach($subMenu as $index=>$subMenuItem)
        <li  class="pb-3 group/li-mobile-2 transition-all duration-300 ease-in-out">
            <a  href="{{ $subMenuItem['link'] }}" class="group-hover/li-mobile-2:text-main text-gray-200 transition-all duration-300 ease-in capitalize">
                <span>{{ $subMenuItem['title'] }}</span>
            </a>
        </li>
		@endforeach
    </ul>
    @endif
</li>
