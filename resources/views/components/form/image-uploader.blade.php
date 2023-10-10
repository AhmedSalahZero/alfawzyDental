@props([
'id',
'imageUploadId',
'rounded'=>true ,
'borderRadius'=>'100%',
'label'=>'',
'required'=>true ,
'name',
'readUrlFunctionName'=>'readUrl',
'image'=>'image',
])
<div class="file-upload-container">

    @if($label)

        <label class="text-sm text-[#4B4B4B] leading-6 tracking-tight ">{{ $label }} </label>
    @endif
    @if($required)
        <label class="text-red-500">*</label>
    @endif
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input data-id="{{ $id }}" name="{{ $name }}" type='file' id="{{ $imageUploadId }}"  />
            <label for="{{ $imageUploadId }}">
                <i class="fa-solid fa-file-arrow-up mr-2 "></i>
                {{ __('Choose File') }}
            </label>
        </div>
        <div class="avatar-preview">
            <div id="{{ $id }}" style="background-image: url('{{get_file($image)}}');border-radius:{{ $borderRadius }}">
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + id).css('background-image', 'url(' + e.target.result + ')');
                    $('#' + id).hide();
                    $('#' + id).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#{{ $imageUploadId }}").change(function() {
            const id = $(this).attr('data-id');
            readURL(this, id);
        });

    </script>
@endpush
