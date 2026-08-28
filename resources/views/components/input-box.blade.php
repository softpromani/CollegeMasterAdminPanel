<div class="mb-3">
    @if(isset($label))
        <label class="form-label fw-semibold text-dark mb-2">
            {{ $label }}
        </label>
    @endif

    {{-- File Input --}}
    @if(($type ?? 'text') == 'file')
        <input
            type="file"
            name="{{ $name }}"
            class="form-control custom-input {{ $errors->has($name) ? 'is-invalid' : '' }}"
            {{ $attributes }}
        >
    @else
        {{-- Normal Input --}}
        <div class="input-group custom-input-group">
            @if(isset($icon))
                <span class="input-group-text">
                    <i class="{{ $icon }}"></i>
                </span>
            @endif

            <input
                type="{{ $type ?? 'text' }}"
                name="{{ $name }}"
                value="{{ $value ?? old($name) }}"
                placeholder="{{ $placeholder ?? '' }}"
                class="form-control custom-input {{ $errors->has($name) ? 'is-invalid' : '' }}"
                {{ $attributes }}
            >
        </div>
    @endif

    @error($name)
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
