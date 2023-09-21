<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('front/icons/fontawesome-6-4-2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/scss/main.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{url('front')}}/alertify/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="{{url('front')}}/alertify/css/themes/default.min.css" />

    @stack('css')
</head>
<body x-data="{showSideBar:false}" class="overflow-x-hidden ">

<div class="fixed-video">
    <video  loop="" autoplay="" playsinline="" muted="" preload="auto" controlslist="nodownload" disablepictureinpicture=""	>
        <source src="{{get_file($settings->video_url)}}" type="video/mp4">
    </video>
</div>
<x-sidebar></x-sidebar>
<div class="inline-flex md:hidden z-[999] fixed md:static bottom-0 md:bottom-auto left-1/2 md:left-auto w-full md:w-auto -translate-x-1/2 md:-translate-x-0  md:z-0    whatsapp__container  items-center justify-center social-whatsapp mr-8">
    <x-social.whatsapp></x-social.whatsapp>
</div>
<header class="
	z-50
	@if(isset($showHeaderBanner) && $showHeaderBanner)
	h-[90vh]
	@else
	h-[123px]

	@endif
	 header  bg-cover bg-no-repeat relative" @if(isset($showHeaderBanner) && $showHeaderBanner) style="background-position:center center;background-image:linear-gradient(to bottom, #00000082 51%, #00000000 100%),url({{get_file($settings->main_home_image)}})" @endif>

    <div class="res-container h-full !items-start">
        <div class="header__menu  flex justify-between
			@if(isset($showHeaderBanner) && $showHeaderBanner)
			items-start
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
                    <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                        <a @click="isOpen=!isOpen" href="{{route('home.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                           Home
                        </a>
                    </li>


                <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                    <a @click="isOpen=!isOpen" href="{{route('web_about.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                        About
                    </a>
                </li>

                <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                    <a @click="isOpen=!isOpen" href="#" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                        Services
                        <i class="fa-solid fa-chevron-down text-xs"></i>

                    </a>
                    <ul x-show="isOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="submenu px-5 w-52 bg-white    rounded-md shadow-md  absolute top-9 left-1/2 -translate-x-1/2 z-10 ">
                       @foreach($serviceCategories as $category)
                        <x-links.sub-menu-item :link="route('web_category_services.index',$category->id)" :title="$category->title">
                        </x-links.sub-menu-item>
                        @endforeach

                    </ul>

                </li>



                <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                    <a @click="isOpen=!isOpen" href="{{route('web_contacts.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                        Contact Us
                    </a>
                </li>


                <li class="group/li relative" x-data="{isOpen:false}" {{-- @mouseover.away="isOpen=false" @mouseover="isOpen = true" --}} @click.away="isOpen=false">
                    <a @click="isOpen=!isOpen" href="{{route('web_partners.index')}}" class="
						@if(isset($showHeaderBanner) && $showHeaderBanner)
						text-white
						@else
						text-black
						@endif
						 text-nowrap capitalize text-sm flex items-center lg:text-base md:gap-1 lg:font-semibold  group-hover/li:text-main transition-colors duration-300">
                        Partners
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
                        Blogs
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
                        Faq Questions
                    </a>
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



            </ul>

            <div class="hidden md:inline-flex fixed md:static bottom-0 md:bottom-auto left-1/2 md:left-auto w-full md:w-auto -translate-x-1/2 md:-translate-x-0 z-50 md:z-0    whatsapp__container  items-center justify-center social-whatsapp mr-8">
                <x-social.whatsapp :settings="$settings"></x-social.whatsapp:>
            </div>
            <div class="w-10 h-10 rounded-lg bg-white hidden md:flex md:justify-center md:items-center  cursor-pointer" @click="showSideBar=!showSideBar">
                <i class="fa-solid fa-bars-staggered text-black icon-size"></i>
            </div>


            <div class="bar__menu relative z-20   md:hidden " x-data="{mobileMenuIsOpen:false }">
                <div class="bar__ment-content  " @click.away="mobileMenuIsOpen=false">
                    <div @click="mobileMenuIsOpen=!mobileMenuIsOpen" class="cursor-pointer">
                        <i class="fa-solid fa-bars-staggered text-white "></i>
                    </div>
                    <div class="fixed  top-0 left-0 w-[70vw] h-screen bg-white  " x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" x-show="mobileMenuIsOpen">
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
                </div>

            </div>
        </div>
        @if(isset($showHeaderBanner) && $showHeaderBanner)
            <div class="header__main-content flex items-center ">

                <div class="hidden md:block icons  ">
                    <ul class="flex  flex-col space-y-7 ">
                        @foreach([
                        __('Instagram')=>[
                        'icon'=>'fa-brands fa-instagram',
                        'link'=>'#'
                        ],
                        __('Facebook')=>[
                        'icon'=>'fa-brands fa-facebook-f',
                        'link'=>'#'
                        ],
                        __('Snapchat')=>[
                        'icon'=>'fa-brands fa-snapchat',
                        'link'=>'#'
                        ],
                        __('Google')=>[
                        'icon'=>'fa-brands fa-google',
                        'link'=>'#'
                        ],
                        __('Tiktok')=>[
                        'icon'=>'fa-brands fa-tiktok',
                        'link'=>'#'
                        ]
                        ] as $iconName=>$iconArr)
                            <x-links.social-links :iconName="$iconName" :iconClass="$iconArr['icon']" :iconLink="$iconArr['link']"></x-links.social-links>
                        @endforeach
                    </ul>

                </div>

                <div class=" grow flex flex-col items-center self-end  gap-24 ">
                    <h1 class="header__text  text-center  text-white uppercase font-semibold  ">
                        {{$settings->main_home_title}}
                    </h1>
                    <div class="header__contact  items-stretch md:items-center flex flex-col md:flex-row  space-x-0 md:space-x-10 space-y-7 md:space-y-0">
                        @foreach ([
                        [
                        'icon'=> 'fa-solid fa-phone-volume',
                        'title'=>__('call now'),
                        'value'=>__($settings->phone)
                        ],
                        [
                        'icon'=> 'fa-solid fa-envelope',
                        'title'=>__('email'),
                        'value'=>__($settings->email)
                        ]
                        ] as $contactInfoArr)

                            <div class="contact__element rounded-2xl px-2  sm:px-4  h-[76px] py-2 bg-white flex space-x-1 sm:space-x-3 items-center  ">
                                <div class="contact-icon bg-main rounded-2xl  px-1 py-2 w-[42px] h-[42px] flex-center ">
                                    <i class="{{ $contactInfoArr['icon'] }} text-white icon-size    "></i>
                                </div>
                                <div class="contact__description">
                                    <p class="tracking-tight text-black xs:font-normal sm:font-medium md:font-semibold text-xs  md:text-base uppercase ">{{$contactInfoArr['title'] }}</p>
                                    <p class="tracking-tight text-black xs:font-normal sm:font-medium md:font-medium text-xs  md:text-base uppercase ">{{ $contactInfoArr['value'] }}</p>
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

<footer class="pt-20 h-[425px] bg-cover "  style="background:url('{{ asset('front/image/footer.jpg') }}'),lightgray 50%;background-position:left center; ">
    <div class="res-container">
        <div class="footer__content flex flex-col md:flex-row ">
            <div class="footer__logos w-full md:w-1/3 flex space-y-10 items-center justify-between flex-col  h-full">
                <div class="footer__logo ">
                    <img src="{{get_file($settings->logo_footer)}}" class=" w-[100px] h-[175px] md:w-[138px] md:h-[195px] " alt="">
                </div>
                <ul class="footer__social flex space-x-4 sm:space-x-3  md:space-x-4 lg:space-x-4 items-center h-full  ">
                    @foreach(getSocialIcons() as $iconName=>$iconArr)
                        <li class="mb-10 mb:mb-0">
                            <a title="{{ $iconName }}" href="{{ $iconArr['link'] }}" class="w-8 h-8 flex items-center justify-center  bg-main object-cover rounded-full p-1 ">
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
                            <a class="font-semibold transition-all duration-400 hover:text-main text-black capitalize mb-5 inline-block" href="{{ $footerPageArr['link'] }}">{{ $footerPageArr['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="font-semibold text-xs lg:text-base tracking-tight ">{{ __('bookappointment@alfawzydental.com') }}</a>
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
        {{ __('Copyright © 2023 All Right Reserved Al Fawzy Dental.') }}
    </div>

</footer>

<script src="{{ asset('front/js/plugins.js') }}"></script>
<script src="{{ asset('front/icons/fontawesome-6-4-2/js/all.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{asset('assets/admin/js/jquery.js')}}" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous"></script>

<script src="{{url('front')}}/alertify/alertify.min.js"></script>


@stack('js')


<script>
    window.addEventListener('online', () =>{
        alertify.success('عادت خدمة الانترنت !');
    });
    window.addEventListener('offline', () =>{
        alertify.error('لا يوجد خدمة انترنت !');
    });

</script>
</body>
</html>
