<section class="space-between-sections-y mt-52 lg:mt-0">
    <div class="res-container mt-96 md:mt-36">
        <div
            class="online-consultings text-left mt-24 mb-60  lg:my-0 flex justify-between  md:text-left items-center flex-col md:flex-row  gap-12 lg:gap-20 ">
            <div class="online-consulting scroll-from-left-to-right">
                <h4 class="main__title  mb-5 ">{{ __('Online Consulting') }}</h4>
                <h2 class="sub__title  max-w-[386px] mb-5">{{ __('Make online and live Consultation easily.') }}</h2>
                <a target="_blank" href="{{ getWhatsappApi($settings->whatsapp) }}" class="whatsapp__container absolute lg:static bottom-[-230%] left-1/2 -translate-x-1/2 lg:translate-x-0  inline-flex items-center justify-center social-whatsapp">
                    <x-social.whatsapp></x-social.whatsapp>
                </a>

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
