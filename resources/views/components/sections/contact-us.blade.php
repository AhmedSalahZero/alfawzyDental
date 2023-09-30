@props([
	'paddingBottom'=>$paddingBottom ?? true,
    'all_services'=>$all_services??[],
    'settings'=>$settings??[],
	])
<section class="
@if($paddingBottom)
space-between-sections-y
@else
space-between-sections-t
@endif
 contact-us-section section">
    <div class="res-container">
        <div class="contact-us flex flex-col lg:flex-row gap-[118px]">
            <div class="h-[500px] lg:basis-2/5  space-right contact__map ">
                @include('front.map.maps',[
                'mapId'=>'map__contact',
                'searchTextField'=>'map__search',
                'lang'=>App()->getLocale(),
                'latitude'=>'30.033333',
                'longitude'=>'31.233334',
                'mapHeight'=>'!h-full'
                ])
            </div>
            <div class="basis-3/5   space-left  contact__form">
				<h2 class="header__text font-bold mb-4">{{ __('Get A Quote') }}</h2>
				<p class="small_description text-black font-medium text-lg mb-10">{{$settings->contact_us_desc}}</p>

                <form id="Form" method="post" class="w-full" action="{{route('web_contacts.store')}}">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <x-form.input :required="true" :label="'name'" :name="'name'" :type="'text'" :id="'name'" :placeholder="__('Enter Your Name ..')"></x-form.input>
                        <x-form.input :required="true" :label="'Email'" :name="'email'" :id="'email'" :type="'email'" :placeholder="__('Enter Your Email ..')"></x-form.input>
                        <x-form.input :required="true" :label="'Phone Number'" :name="'phone'" :id="'phone'" :type="'text'" :placeholder="__('Enter Your phone ..')"></x-form.input>
                        <x-form.select :multi="true" :required="true" :options="$all_services" :label="'Services'" :name="'service_id'" :id="'service_id'"></x-form.select>
                        <x-form.textarea :required="true" :label="'Messages'" :name="'message'" :id="'message'" :placeholder="__('Enter Your Messages ..')">
                            </x-form.input>
                    </div>
                    <div class="text-center md:text-left">
                        <div class="form__submit inline-flex md:flex flex-col md:flex-row justify-between items-center md:items-stretch">
                            <div class="order-2 md:order-1  form__actions grow inline-flex justify-start items-center gap-5 ">
                                <div class=" icon__parent bg-[#FAF7F0] w-16 h-16  flex items-center justify-center border border-[#D1AA65]  rounded-2xl">
                                    <div class="w-12 h-12 rounded-2xl bg-main relative">
                                        <i class="fa-solid fa-phone-volume text-2xl text-white absolute-center "></i>
                                    </div>
                                </div>

                                <div class="contact__div ">
                                    <p onclick="window.open('tel:{{ $settings->phone }}');" class="text-main text-xs uppercase cursor-pointer"> {{ __('Call Now') }}</p>
                                    <p  onclick="window.open('tel:{{ $settings->phone }}');" class="tracking-wider normal__header text-black cursor-pointer">{{$settings->phone}}</ش>
                                </div>

                            </div>
                            <button id="submit_button" form="Form"  type="submit" type="submit" class="order-1 md:order-2 mb-10 md:mb-0 submit__btn grow w-full px-10 py-2 mt-5  lg:mt-0 md:max-w-[200px] lg:max-w-[290px] bg-main rounded-2xl text-white capitalize text-center flex-center">{{ __('Submit') }}</button>
                        </div>
                    </div>



                </form>


            </div>
        </div>
        <div class="mt-10 text-center md:text-right fixed bottom-[5%] right-[5%] z-[9999] ">
            <a target="_blank" href="https://wa.me/{{$settings->whatsapp}}" class="inline-block text-center  md:text-right ">
                <img src="{{ asset('front/image/lg-whatsapp.png') }}" class="w-12 h-12 md:w-[82px] md:h-[82px] rounded-full shadow-sm">
            </a>
        </div>
    </div>
</section>
