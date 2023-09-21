@props([
'label'=>$label,
'id'=>$id ,
'name'=>$name,
'required'=>$required ?? false,
'options'=>$options,
''
])

 <div class="w-full md:w-1/2 px-3 mb-2">
      <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="{{ $id }}">
        {{ $label }}
      </label>
      <div class="relative">
        <select name="{{ $name }}" class="block min-h-[56px]  pl-[20px] appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3  pr-8 rounded-2xl leading-tight focus:outline-none  focus:border-gray-500" id="{{ $id }}">
          @foreach ($options as $option)
		  <option value="{{$option->id}}">{{$option->title}}</option>
		  @endforeach
        </select>
        <div class="pointer-events-none pr-[20px] absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
