@extends('front.layout.index')
@section('title')

    Payment
@endsection
@push('content')
<div class="h-[50px] lg:h-[100px]"></div>
<section class="section space-between-sections faq-section">
    <div class="res-container">
		<div class="payment-success h-[366px]">
			<div class="flex flex-col lg:flex-row items-center justify-center gap-y-5 gap-x-4">
				<div class="success-img">
					<img src="{{ asset('front/image/status.png') }}" class="h-24 w-24">
				</div>
			<div class="text-center lg:text-left">
				<h2 class="font-semibold text-xl lg:text-3xl leading-9 text-black mb-5 ">{{ __('Payment successfully completed') }}</h2>
				<p class="text-base lg:text-[22px] text-black leading-7 ">{{ __('Thank you for your payment. Your transaction has been completed.') }}</p>
			</div>
			</div>
			</div>
		
    </div>
</section>

@endpush

@push('js')


@endpush
