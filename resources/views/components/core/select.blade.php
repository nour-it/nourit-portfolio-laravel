
<select name="{{ $label }}" id="{{ $label }}" aria-placeholder="{{ $label }}" class="border rounded">
    @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ $option->id == $value ? "selected" : ""}} >{{ $option->$field }}</option>
    @endforeach
</select>
@error($label)
    <span class="ft-red">{{ Arr::join($errors->get($label), ' | ') }}</span>
@enderror
