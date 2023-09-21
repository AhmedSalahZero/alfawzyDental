@props([
'label'=>$label,
'id'=>$id ,
'name'=>$name,
'placeholder'=>$placeholder ?? '',
'type'=>$type ??'text',
'required'=>$required ?? false
])
<div class="w-full px-3 mb-2">
    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="{{ $id }}">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <textarea name="{{ $name }}" rows="8" @if($required) required @endif id="{{ $id }}" class="appearance-none pl-[20px] min-h-[56px] block w-full bg-white text-gray-700 border  rounded-2xl py-3 px-4 mb-3 leading-tight focus:outline-none "  placeholder="{{ $placeholder }}"></textarea>
    {{-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> --}}
</div>
