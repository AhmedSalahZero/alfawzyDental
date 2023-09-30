<section class="section-dentinal-card section bg-[#CECECE] h-[380px] relative mt-80 md:mt-[460px] lg:mt-80 ">
    <div class="res-container ">
        <div
            class="dential-card-image absolute bottom-[-120%] left-1/2 -translate-x-1/2 md:translate-x-0 w-full md:w-auto md:left-auto   md:bottom-0 md:max-w-[300px] xl:max-w-[550px]">
            <img src="{{ get_file($about->image2)  }}" class=" img-radius mx-auto" alt="">
        </div>
        <div
            class="rounded-none   md:rounded-[40px] text-center md:text-left left-1/2 -translate-x-1/2 md:translate-x-0 w-full md:w-auto dential-card-content bg-white shadow-sm -mt-6   md:max-w-[422px] lg:max-w-[622px] absolute md:left-auto  -top-full md:top-0  md:-translate-y-1/2 right:0 md:right-[5%] py-10 md:py-10 px-5 md:px-10 md:mt-36">
            <h2 class="main__title  max-w-none md:max-w-[274px] mb-4 ">{{$about->title}}</h2>
            <p class="leading-7 font-medium text-justify color-gray mb-10 ">{{$about->desc}} </p>
            <div class="columns-1 lg:columns-2 gap-8 mb-6 space-y-10 md:space-y-0">

                <div class="">
                    <h2 class="mb-3 font-semibold text-2xl"> {{$about->our_goal_title}} </h2>
                    <p class="color-gray text-sm leading-6 font-normal ">{{$about->our_goal_desc}}</p>
                </div>

                <div class="">
                    <h2 class="mb-3 font-semibold text-2xl"> {{$about->our_mission_title}} </h2>
                    <p class="color-gray text-sm leading-6 font-normal ">{{$about->our_mission_desc}}</p>
                </div>


                {{--                    <div class="">--}}
                {{--                        <h2 class="mb-3 font-semibold text-2xl"> {{$about->our_vision_title}} </h2>--}}
                {{--                        <p class="color-gray text-sm leading-6 font-normal ">{{$about->our_vision_desc}}</p>--}}
                {{--                    </div>--}}

            </div>

            <a target="_blank" href="{{ getWhatsappApi($settings->whatsapp) }}" class="whatsapp__container inline-flex items-center justify-center social-whatsapp">
                <x-social.whatsapp></x-social.whatsapp>
            </a>
        </div>

    </div>
</section>
