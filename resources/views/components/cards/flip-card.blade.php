  <div class="doctors-card !px-5 shadow-lg  transition-all  duration-500   group/doctor-card preserve-3d  relative element-internal-padding rounded-[32px]">
                    <div class="card__front backface-hidden  text-center">
                        {{ $front__face }}
                    </div>
                    <div class="card__back rotate-y-180 backface-hidden absolute top-0 left-0 right-0 bottom-0 flex flex-center element-internal-padding ">
                        {{ $back__face }}
                    </div>
                </div>
