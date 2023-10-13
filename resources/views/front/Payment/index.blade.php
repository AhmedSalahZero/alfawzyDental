@extends('front.layout.index')
@section('title')

    Payment
@endsection
@push('content')

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-md-6">
                <div class="text-center">
                    @if($payment->status =='pending')
                        <h2>welcome {{$payment->name}}</h2>
                        <p>the Service Pay For Is {{$payment->service->title??''}}</p>
                        <h4>The Price is {{$payment->price}}</h4>
                        <a href="{{route('payment',$payment->id)}}" class="btn btn-outline-dark my-4">Go To Payment</a>
                    @elseif($payment->status=='cancel')
                        <h2 class="btn btn-soft-success">Your Payment is Cancel </h2>

                    @else
                        <h2 class="btn btn-soft-success">You are Paid</h2>

                    @endif

                </div>
            </div>
        </div>
    </div>

@endpush

@push('js')


@endpush
