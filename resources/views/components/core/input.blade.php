<input name="{{ $name }}" id="{{ $name }}" class="{{ $class ?? "border rounded" }}" placeholder="{{ $holder ?? '' }}"
    value="{{ old($name) ?? ($value ?? '') }}" type="{{ $type ?? 'text' }}" multiple>
@error($name)
    <span class="ft-red">{{ $name }} should not be empty</span>
@enderror
