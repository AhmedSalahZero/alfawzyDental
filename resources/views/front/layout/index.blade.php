<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{setting()->app_name}} -@yield('title') </title>

    <link rel="stylesheet" href="{{ asset('front/icons/fontawesome-6-4-2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/scss/main.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{url('front')}}/alertify/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="{{url('front')}}/alertify/css/themes/default.min.css" />
    <link rel="shortcut icon" href="{{get_file($settings->fave_icon)}}">

    <style>


    </style>
    @stack('css')
</head>
<body x-data="{showSideBar:false,mobileMenuIsOpen:false}" class="overflow-x-hidden">

    <div class="fixed-video">
        <span id="close-video">x</span>
        <video id="fixed-video-id" loop="" autoplay="" playsinline="" muted="muted" {{-- controls --}} preload="auto" controlslist="nodownload" disablepictureinpicture="">
            {{-- <source src="https://media.geeksforgeeks.org/wp-content/uploads/20210314115545/sample-video.mp4" type="video/mp4"> --}}
            <source src="{{get_file($settings->video_footer)}}" type="video/mp4">
        </video>
    </div>
    <x-sidebar></x-sidebar>
    {{-- <a target="_blank" href="{{ getWhatsappApi($settings->whatsapp) }}"
    class="inline-flex md:hidden z-[999] !rounded-none fixed md:static bottom-0 md:bottom-auto left-1/2 md:left-auto w-full md:w-auto -translate-x-1/2 md:-translate-x-0 md:z-0 whatsapp__container items-center justify-center social-whatsapp mr-8">
    <x-social.whatsapp></x-social.whatsapp>
    </a> --}}

    <div x-cloak class="fixed z-[9999999] top-0 left-0 w-[70vw] h-screen bg-white  " x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" x-show="mobileMenuIsOpen">
        <ul class="pt-10 px-3  flex flex-col gap-2 ">
            @foreach(getPages() as $pageName=>$navArr)
            <x-links.mobile-nav-link :subMenu="[['title'=>'first','link'=>'#'],['title'=>'second','link'=>'#']]" :title="$navArr['title']" :link="$navArr['url']"></x-links.mobile-nav-link>
            @endforeach
        </ul>
        <ul class="flex space-between items-center pt-4">
            @foreach(getSocialIcons() as $iconName=>$iconArr)
            <x-links.social-links :icon-size="'text-lg'" :iconName="$iconName" :iconClass="$iconArr['icon']" :iconLink="$iconArr['link']"></x-links.social-links>
            @endforeach
        </ul>
        <div @click="mobileMenuIsOpen=false" class="remove border border-gray-300  absolute top-3 right-3 h-6 flex-center  w-6 rounded-full cursor-pointer  bg-white">
            <i class="fa-solid fa-xmark text-black  icon-size "></i>
        </div>
    </div>

    <header class="
	z-50
	@if(isset($showHeaderBanner) && $showHeaderBanner)
	h-[65vh] lg:h-[90vh]
	@else
	h-[123px]

	@endif
	 header
	  relative
	   " {{--
	    bg-cover bg-no-repeat

	   --}}>
        @if(isset($showHeaderBanner) && $showHeaderBanner)
        <div class="dark-layer pointer-events-none h-full w-full absolute z-[5]" style="background-image:linear-gradient(180deg, #00000032 20%, #00000000 58%)">

        </div>
        @endif
        <div class="res-container h-full !items-stretch md:!items-start pb-16 md:pb-0">
            <div class="header__menu z-[5] flex justify-between
			items-start
			md:items-center
			@if(isset($showHeaderBanner) && $showHeaderBanner)
			pt-4
			@else
			self-center
			@endif

			  ">
                <div class="logo__container flex flex-col gap-20">
                    <a href="{{ route('home.index') }}" class="logo__image max-w-[]">
                        <img class="w-[40px]   lg:h-[75px] lg:w-auto" src="{{ get_file($settings->logo_header) }}" alt="{{ env('APP_NAME	') }}">
                    </a>

                </div>

                <ul x-cloak class="grow   text-center hidden md:flex  md:space-x-3 lg:space-x-4 items-center justify-center  ">


                    <li class="group/li relative" x-data="{isOpen:false}" @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('home.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            {{ __('Home') }}
                        </a>
                    </li>



                    <li class="group/li relative " x-data="{isOpen:false}" @mouseleave="isOpen = false" @mouseover="isOpen = true" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{ route('web_about.index') }}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm inline pb-8 items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            About
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </a>
                        <ul x-cloak x-show="isOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="submenu px-5 w-52 bg-white    rounded-md shadow-md  absolute top-9 left-1/2 -translate-x-1/2 z-10 ">

                            <li class="py-2  group/li2 block ">
                                <a href="{{ route('web_about.index') }}" class="group-hover/li2:text-main text-black capitalize transition-colors duration-300">Our
                                    Team</a>
                            </li>
                            <li class="py-2  group/li2 block ">
                                <a href="{{ route('web_about.index') }}" class="group-hover/li2:text-main text-black capitalize transition-colors duration-300">Our
                                    Partners</a>
                            </li>


                        </ul>
                    </li>



                    <li class="group/li relative " x-data="{isOpen:false}" @mouseleave="isOpen = false" @mouseover="isOpen = true" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('web_services.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            Our Services
                            <i class="fa-solid fa-chevron-down text-xs"></i>

                        </a>
                        <ul x-cloak x-show="isOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="submenu px-5 w-52 bg-white    rounded-md shadow-md  absolute top-9 left-1/2 -translate-x-1/2 z-10 ">
                            @foreach($serviceCategories as $category)
                            <x-links.sub-menu-item :link="route('web_category_services.index',$category->id)" :title="$category->title">
                            </x-links.sub-menu-item>
                            @endforeach




                        </ul>

                    </li>


                    <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('dental.tourism.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            Dental Tourism
                        </a>
                    </li>


                    <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('web_gallery.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            Gallery
                        </a>
                    </li>


                    <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('web_faq.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            FAQs
                        </a>
                    </li>



                    <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('web_blogs.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            Blog
                        </a>
                    </li>


                    <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('web_contacts.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                            Contacts
                        </a>
                    </li>




                </ul>
                <a target="_blank" href="{{ getWhatsappApi($settings->whatsapp) }}" class="hidden lg:inline-flex fixed md:static bottom-0 md:bottom-auto left-1/2 md:left-auto w-full md:w-auto -translate-x-1/2 md:-translate-x-0 z-50 md:z-0    whatsapp__container  items-center justify-center social-whatsapp mr-8">
                    <x-social.whatsapp :settings="$settings">
                        </x-social.whatsapp:>
                </a>
                <div class="w-10 h-10 rounded-lg   md:justify-center md:items-center  cursor-pointer flex-center bg-transparent" @click="showSideBar=!showSideBar">
                    <i class="fa-solid fa-bars-staggered
				@if(isset($showHeaderBanner) && $showHeaderBanner)
				text-white
				 @else
				 text-black
				 @endif  
				 
				  icon-size"></i>
                </div>


                <div class="bar__menu relative z-20   hidden ">
                    <div class="bar__ment-content  " @click.away="mobileMenuIsOpen=false">
                        <div @click="mobileMenuIsOpen=!mobileMenuIsOpen" class="cursor-pointer">
                            <i class="fa-solid fa-bars-staggered text-white "></i>
                        </div>

                    </div>

                </div>
            </div>
            @if(isset($showHeaderBanner) && $showHeaderBanner)
            <div class="header__main-content flex items-center ">

                <div class="hidden md:block icons  z-[12]">
                    <ul class="flex  flex-col space-y-7 ">
                        @foreach([
                        __('Instagram')=>[
                        'icon'=>'fa-brands fa-instagram',
                        'link'=>$settings->instagram
                        ],
                        __('Facebook')=>[
                        'icon'=>'fa-brands fa-facebook-f',
                        'link'=>$settings->facebook
                        ],
                        __('Snapchat')=>[
                        'icon'=>'fa-brands fa-snapchat',
                        'link'=>$settings->snapchat
                        ],
                        __('Google')=>[
                        'icon'=>'fa-brands fa-google',
                        'link'=>$settings->gmail,
                        ],
                        __('Tiktok')=>[
                        'icon'=>'fa-brands fa-tiktok',
                        'link'=>$settings->tiktok,
                        ]
                        ] as $iconName=>$iconArr)
                        <x-links.social-links :iconName="$iconName" :iconClass="$iconArr['icon']" :iconLink="$iconArr['link']"></x-links.social-links>
                        @endforeach
                    </ul>

                </div>

                <div class=" grow flex flex-col items-center self-end  gap-24 ">
                    <div class="swiper header-swiper">
                        <div class="swiper-wrapper">
                            @isset($sliders)
                            @foreach($sliders as $slider)
                            <div class="swiper-slide">
                                <div class="absolute top-0 right-0 left-0 bottom-0 bg-no-repeat bg-cover " style="background-image:url('{{get_file($slider->image)}}')">
                                    {{-- <img src="{{ asset('front/image/home.jpg') }}"> --}}


                                </div>
                                <h1 class="absolute-center header__text w-full text-center  text-white uppercase font-semibold mt-[-50px] lg:mt-0 scroll-from-left-to-right">
                                    {{$slider->title}}
                                </h1>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        {{-- <div class="swiper-button-next-header"></div>
                            <div class="swiper-button-prev-header"></div>
                            <div class="swiper-pagination-header"></div> --}}
                    </div>
                    <div class="header__contact z-[8]  items-stretch md:items-center flex flex-col md:flex-row  space-x-0 md:space-x-10 space-y-7 md:space-y-0">
                        @foreach ([
                        [
                        'icon'=> 'fa-solid fa-phone-volume',
                        'title'=>__('call now'),
                        'value'=>__($settings->phone),
						'animation'=>'scroll-from-left-to-right'
                        ],
                        [
                        'icon'=> 'fa-solid fa-envelope',
                        'title'=>__('email'),
                        'value'=>__($settings->email),
						'animation'=>'scroll-from-right-to-left'
                        ]
                        ] as $iconIndex=>$contactInfoArr)

                        <div @if($iconIndex==0) onclick="window.open('tel:{{ $contactInfoArr['value'] }}');" @else onclick="window.open('mailto:{{ $contactInfoArr['value'] }}')" @endif class="contact__element {{ $contactInfoArr['animation'] ?? '' }} rounded-2xl px-2 cursor-pointer  sm:px-4  h-[76px] py-2 bg-white flex space-x-1 sm:space-x-3 items-center  ">
                            <div class="contact-icon bg-main  rounded-2xl  px-1 py-2 w-[42px] h-[42px] flex-center ">
                                <i class="{{ $contactInfoArr['icon'] }} text-white icon-size    "></i>
                            </div>
                            <div class="contact__description">
                                <p class="tracking-tight text-black xs:font-normal sm:font-medium md:font-semibold text-xs  md:text-base uppercase ">{{$contactInfoArr['title'] }}</p>
                                <p class="tracking-tight text-black xs:font-normal sm:font-medium md:font-medium text-xs  md:text-base lowercase ">{{ $contactInfoArr['value'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>

            </div>
            @endif


        </div>
    </header>
    @stack('content')

    <footer class="pt-20 lg:h-[425px] bg-cover footer">
        <div class="res-container">
            <div class="footer__content flex flex-col md:flex-row ">
                <div class="footer__logos w-full md:w-1/3 flex space-y-10 items-center justify-between flex-col  h-full">
                    <a href="{{ route('home.index') }}" class="footer__logo ">
                        <img src="{{get_file($settings->logo_footer)}}" class=" w-[87px] h-[103px] md:w-[138px] md:h-[195px] " alt="">
                    </a>
                    <ul class="footer__social flex space-x-4 sm:space-x-3  md:space-x-4 lg:space-x-4 items-center h-full  ">
                        @foreach(getSocialIcons() as $iconName=>$iconArr)
                        <li class="mb-10 mb:mb-0">
                            <a target="_blank" title="{{ $iconName }}" href="{{ $iconArr['link'] }}" class="w-8 h-8 flex items-center justify-center  bg-main object-cover rounded-full p-1 ">
                                <i class="{{ $iconArr['icon'] }} text-white icon-size"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer__links w-full md:w-1/3 h-full flex flex-col mb-10 md:mb-0 ">
                    <h3 class="normal__title capitalize md:mb-8">{{ __('Quick Links') }}</h3>
                    <ul class="columns-2 gap-2   justify-end">
                        @foreach(footerPages() as $index=>$footerPageArr )
                        <li>
                            <a class=" transition-all duration-400 hover:text-main text-black capitalize mb-5 inline-block font-normal" href="{{ $footerPageArr['link'] }}">{{ $footerPageArr['title'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <a href="mailto:bookappointment@alfawzydental.com" class="font-semibold text-xs lg:text-base tracking-tight ">{{ __('bookappointment@alfawzydental.com') }}</a>
                </div>
                <div class="footer__addresses w-full md:w-1/3 ">
                    <div class="branches flex flex-col h-full justify-between items-start md:items-center">

                        <div class="branch-parent mb-3">
                            <h2 class="font-semibold text-xl mb-3">
                                {{$settings->footer_title1}}

                            </h2>
                            <p class="font-normal text-black leading-7 max-w-[80%] md:max-w-[272px]">{{ $settings->footer_desc1 }}</p>
                        </div>

                        <div class="branch-parent mb-3">
                            <h2 class="font-semibold text-xl mb-3">
                                {{$settings->footer_title2}}

                            </h2>
                            <p class="font-normal text-black leading-7 max-w-[80%] md:max-w-[272px]">{{ $settings->footer_desc2 }}</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="footer__bottom min-h-[60px]  flex items-center justify-center bg-main text-white">
            <div class="res-container">
                {{ __('Copyright © 2023 All Right Reserved Al Fawzy Dental.') }}
            </div>
        </div>

    </footer>

    <script src="{{ asset('front/js/plugins.js') }}"></script>
    <script src="{{ asset('front/icons/fontawesome-6-4-2/js/all.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- <script src="{{asset('assets/admin/js/jquery.js')}}" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}

    <script src="{{url('front')}}/alertify/alertify.min.js"></script>


    @stack('js')


    <script>
        window.addEventListener('online', () => {
            alertify.success('عادت خدمة الانترنت !');
        });
        window.addEventListener('offline', () => {
            alertify.error('لا يوجد خدمة انترنت !');
        });


        var swiper = new Swiper(".header-swiper", {
            spaceBetween: 30
            , slidesPerView: "1"
            , effect: 'fade'
            , crossFade: true
            , centeredSlides: true
            , autoplay: {
                delay: 2500
                , disableOnInteraction: false
            , }
            , pagination: {
                el: ".swiper-pagination-header"
                , clickable: true
            , }
            , navigation: {
                nextEl: ".swiper-button-next-header"
                , prevEl: ".swiper-button-prev-header"
            , }
        , });

        $('#close-video').click(function(e) {
            e.preventDefault();
            $('.fixed-video').remove();
        })
        $(document).on('click', '.fixed-video', function() {
            $(this).find('video').prop('muted', false)
            $(this).css('height', '260px');
            $(this).css('width', '300px');
        })

    </script>

</body>
</html>
