<section class=" @if(!isset($mt)) space-between-sections-y mt-52 @else mt-0 @endif  lg:mt-0">

    <div class="res-container @if(!isset($mt)) mt-96 md:mt-36 @endif ">
        <div class="online-consultings relative text-left @if(!isset($mt))  mt-24 @endif mb-60  lg:my-0 flex justify-between  md:text-left items-center flex-col md:flex-row  gap-12 lg:gap-20 ">
            <div class="online-consulting scroll-from-left-to-right">
                <h4 class="main__title  mb-5 ">{{ __('Online Consulting') }}</h4>
                <h2 class="sub__title  max-w-[386px] mb-5">{{ __('Make online and live Consultation easily.') }}</h2>
				@if(Request()->route()->getName() =='home.index')
                <a  href="{{ route('online-consulting') }}" class="whatsapp__container h-16  mt-4 w-[280px] shadow-md absolute lg:static bottom-[-6rem] flex items-center justify-center social-whatsapp">
                    {{-- <img src="{{ asset('front/image/teeth.png') }}"> --}}
                    <span class="text-xl font-semibold tracking-[0.2px] capitalize ml-2 ">{{ __('Online Consulting') }}</span>
                    {{-- <x-social.whatsapp></x-social.whatsapp> --}}
                </a>
				@endif 

            </div>
            <div class="online-consulting scroll-from-bottom-to-up">
                <img src="{{asset('front/image/doctors.png')}}">
            </div>
            <div class="online-consulting hidden md:block scroll-from-right-to-left">
                <img src="{{asset('front/image/doctor.png')}}">

            </div>
        </div>
    </div>
</section>
