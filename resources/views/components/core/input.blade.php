<input name="{{ $name }}" id="{{ $name }}" class="{{ $class ?? "border rounded" }}" placeholder="{{ $holder ?? '' }}"
    value="{{ old($name) ?? ($value ?? '') }}" type="{{ $type ?? 'text' }}" @isset($multiple)multiple @endisset>
@error($name)
    <span class="ft-red">{{ Arr::join($errors->get($name), ' | ') }}</span>
@enderror
