<div class=" section  section-to-up min-services relative z-[60] -mt-10">
    <div class="res-container">
        <div class="min-services-container py-8 px-7 max-w-[90%] mx-auto bg-white rounded-2xl shadow-sm ">
            <div
                class="min-services  flex flex-col md:flex-row space-x-0  md:space-x-5 space-y-5 md:space-y-0  items-center justify-between    ">
                @foreach($categoryServices as $minService)
                    <div
                        class="min-service grow flex items-center justify-center h-[190px] w-full md:w-auto rounded-2xl shadow-md">
                        <h2 class="font-semibold md:text-xl lg:text-2xl text-black capitalize ">{{ $minService->title }}</h2>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
