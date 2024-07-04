
<select name="{{ $label }}" id="{{ $label }}" aria-placeholder="{{ $label }}" class="border rounded">
    @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ $option->id == $value ? "selected" : ""}} >{{ $option->$field }}</option>
    @endforeach
</select>
@error($value)
    <span class="ft-red">category should not be empty</span>
@enderror
