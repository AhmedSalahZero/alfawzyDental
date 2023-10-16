@extends('front.layout.index')
@section('title')

    Payment
@endsection
@push('content')
<div class="h-[50px] lg:h-[100px]"></div>
<section class="section space-between-sections faq-section">
    <div class="res-container">
	
		<div class="payment-container">
			<div class="flex flex-col gap-y-24 lg:flex-row payment items-center justify-center">
				<div class="payment__description relative p-5 rouned-[12px] max-w-[600px] flex-grow  space-y-8  shadow-md ">
					<p class="text-xl font-semibold payment-color leading-9">{{ __('Payment Request from Al Fawzy Dental') }}</p>
					<div class="payment__info text-base font-semibold leading-5 uppercase">
						<span class="block font-semibold color-subtext mb-2">{{ __('Payment for') }}</span>
						<span class="block payment-color font-medium text-[22px] ">{{ __('Periodontal Therapy') }}</span>
					 </div>
					 <div class="amount__payable">
					 	<span class="uppercase text-base mb-2 font-semibold color-subtext">{{ __('AMOUNT PAYABLE') }}</span>
						<span class="block payment-color text-[22px] font-semibold text">{{ __('15,000') }}</span>
					 </div>
				</div>
				<div class="payment__reciept flex-grow max-w-[490px]">
					<div class=" reciept-top px-8 bg-main text-white flex justify-between items-center h-[80px] rounded-t-[16px]">
						<span class="text-[20px] font-semibold text-2xl ">{{ __('Al fawzy Dental clinic') }}</span>
						<img src="{{ asset('front/image/min-logo.png') }}" class="max-w-[49px]">
					</div>
					<div class="bg-[#231F20] px-8 h-[80px] flex items-center justify-between ">
						<div>
							<span class="font-semibold text-white block text-base capitalize leading-5">{{ __('Total Amount') }}</span>
							<span class="text-[22px] text-white block ">15,000</span>
						</div>
						<div class="flex">
							<img src="{{ asset('front/image/sec1.png') }}">
							<span class="text-white font-normal text-sm mx-1">{{ __('Secured By') }}</span>
							<img src="{{ asset('front/image/sec2.png') }}">
						</div>
						
						
						
					</div>
					<div class="payment__content my-10 px-8 ">
							<span class="block font-medium leading-6 color-subtext mb-2 ">{{ __('Welcome') }}</span>
							<span class="text-[22px] font-semibold leading-6 text-black mb-7 ">{{ __('Yehia Mourad') }}</span>
							<p class="leading-8 text-black text-lg font-normal  mb-16 ">{{ __('Please make a payment to the service by using the following link. ') }}</p>
							<a href="#" class="bg-[#231F20] h-16 flex-center text-white rounded-xl  mb-3 hover:bg-[#31292b] transition-all duration-200 ">{{ __('Go To Payment') }}</a>
							<div class="flex justify-center items-center">
								<img src="{{ asset('front/image/sec3.png') }}" class="h-4 w-4 ">
								<p class="text-gray-800 ml-1">{{ __('Your payment info is stored securely') }}</p>
							</div>
						</div>
				</div>
			</div>
		</div>
       
    </div>
</section>

@endpush

@push('js')


@endpush
