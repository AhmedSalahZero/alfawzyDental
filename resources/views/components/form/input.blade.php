@props([
'label'=>$label,
'id'=>$id ,
'name'=>$name,
'placeholder'=>$placeholder ?? '',
'type'=>$type ??'text',
'required'=>$required ?? false
])
<div class="w-full md:w-1/2 px-3 mb-2">
    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="{{ $id }}">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <input @if($required) required @endif id="{{ $id }}" name="{{ $name }}" class="appearance-none  block w-full bg-white text-gray-700 border rounded-2xl min-h-[56px]
	 pl-[20px] py-3 px-4 mb-3 leading-tight focus:outline-none " type="{{ $type }}" placeholder="{{ $placeholder }}">
    {{-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> --}}
</div>
