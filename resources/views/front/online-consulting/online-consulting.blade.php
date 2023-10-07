@extends('front.layout.index')
@section('title')

Online Consulting
@endsection
@push('content')

@include('front.home.parts.doctor',['mt'=>false])


<section class="space-between-sections-b">
    <div class="res-container">
        <div class="online-consulting-form max-w-2xl mx-auto ">
            <h1 class="font-bold main__title__bold capitalize mb-4 lg:text-center">{{ __('Get Your Live E-Consulting') }}</h1>
            <p class="description__paragraph lg:!text-center mb-10">{{ __('To know your treatment plan, estimated duration and cost of the treatment.') }}</p>
            <form method="post" action="#" class="online-consulting-form mx-auto " enctype="multipart/form-data">
                @csrf
                <x-form.input :classParent="'mx-auto md:w-full'" :required="true" :label="'Full Name'" :name="'name'" :type="'text'" :id="'name'" :placeholder="__('Enter Your Name ..')"></x-form.input>
                <x-form.input :classParent="'mx-auto md:w-full'" :required="true" :label="'Email Address'" :name="'address'" :type="'text'" :id="'address'" :placeholder="__('Enter Your Address ..')"></x-form.input>
                <x-form.input :classParent="'mx-auto md:w-full'" :required="true" :label="'Phone Number'" :name="'phone'" :type="'text'" :id="'phone'" :placeholder="__('Enter Your Address ..')"></x-form.input>
                <x-form.textarea :required="true" :label="'Main complaint'" :name="'complaint'" :id="'complaint'" :placeholder="__('Enter Your Complaint ..')"> </x-form.textarea>
                <div class="grid items-center justify-center grid-cols-2  md:grid-cols-3 gap-y-24 gap-x-10">
                    @foreach([
                    [
                    'id'=>'front-teeth',
                    'image-upload-id'=>'front-teeth-upload',
                    'name'=>'front_teeth',
                    'label'=>'Front teeth picture',
                    'readUrlFunctionaName'=>'readUrl'
                    ],
                    [
                    'id'=>'side-teeth',
                    'image-upload-id'=>'side-teeth-upload',
                    'name'=>'side_teeth',
                    'label'=>'Side teeth picture',
                    ] ,[
                    'id'=>'upper-teeth',
                    'image-upload-id'=>'upper-teeth-upload',
                    'name'=>'upper_teeth',
                    'label'=>'Upper teeth picture',
                    ],

                    [
                    'id'=>'lower-teeth',
                    'image-upload-id'=>'lower-teeth-upload',
                    'name'=>'lower_teeth',
                    'label'=>'lower teeth picture',
                    ],
                    [
                    'id'=>'xray-teeth',
                    'image-upload-id'=>'xray-teeth-upload',
                    'name'=>'xray_teeth',
                    'label'=>'X-Ray (Required)',
                    ],
                    [
                    'id'=>'passport-or-id',
                    'image-upload-id'=>'passport-or-id-upload',
                    'name'=>'passport_or_id',
                    'label'=>'Passport Or Id',
                    ]

                    ] as $teethArr)
                    <x-form.image-uploader :name="$teethArr['name']" :borderRadius="'8px'" :id="$teethArr['id']" :imageUploadId="$teethArr['image-upload-id']" :label="$teethArr['label']"></x-form.image-uploader>
                    @endforeach
				</div>	
                    <button type="submit" type="submit" class=" max-w-[420px] mb-10 mt-24 mx-auto md:mb-0 submit__btn grow w-full px-10 py-2  md:max-w-[200px] lg:max-w-[290px] bg-main rounded-2xl text-white capitalize text-center flex-center">{{ __('Submit') }}</button>
				
            </form>
        </div>

    </div>
</section>

@endpush

@push('js')

@include('front.contact.contactJs')

@endpush
