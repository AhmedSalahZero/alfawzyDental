<section class="space-between-sections-y mt-52 md:mt-0">
    <div class="res-container mt-96 md:mt-36">
        <div
            class="online-consultings flex justify-between text-center md:text-left items-center flex-col md:flex-row  gap-20 ">
            <div class="online-consulting ">
                <h4 class="main__title mb-5">{{ __('Online Consulting') }}</h4>
                <h2 class="sub__title max-w-[386px] mb-5">{{ __('Make online and live Consultation easily.') }}</h2>
                <a target="_blank" href="{{ getWhatsappApi($settings->whatsapp) }}" class="whatsapp__container inline-flex items-center justify-center social-whatsapp">
                    <x-social.whatsapp></x-social.whatsapp>
                </a>

            </div>
            <div class="online-consulting">
                <img src="{{asset('front/image/doctors.png')}}">
            </div>
            <div class="online-consulting">
                <img src="{{asset('front/image/doctor.png')}}">

            </div>
        </div>
    </div>
</section>
