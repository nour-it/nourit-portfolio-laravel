<input name="{{ $name }}" id="{{ $name }}" class="border rounded" placeholder="{{ $holder ?? "" }}"
    value="{{ old($name) ?? $value }}">
@error($name)
    <span class="ft-red">{{ $name }} should not be empty</span>
@enderror
