@props([
'settings'=>$settings ?? [],
])

<img class="mr-3" src="{{ asset('front/image/whatsapp.png') }}" alt="">
                    <div class="whatsapp__info">
                        <span class="block uppercase text-black font-medium text-sm lg:text-base  lg:font-semibold">{{ __('Whatsapp') }}</span>
                        <span class="block capitalize text-black text-xs lg:text-base">{{ $settings->whatsapp }}</span>
                    </div>
