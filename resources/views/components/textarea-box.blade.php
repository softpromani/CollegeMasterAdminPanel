<div class="mb-3">
    @if(isset($label))
        <label class="form-label fw-semibold text-dark mb-2">
            {{ $label }}
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        rows="{{ $rows ?? 4 }}"
        class="form-control custom-textarea {{ $errors->has($name) ? 'is-invalid' : '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        {{ $attributes }}
    >{{ $value ?? old($name) }}</textarea>

    @error($name)
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
