<div class="mb-3">
    @if(isset($label))
        <label class="form-label fw-semibold text-dark mb-2">
            {{ $label }}
        </label>
    @endif

    <div class="input-group custom-input-group">
        @if(isset($icon))
            <span class="input-group-text">
                <i class="bi bi-{{ $icon }}"></i>
            </span>
        @endif

        <select
            name="{{ $name }}"
            class="form-select custom-input {{ $errors->has($name) ? 'is-invalid' : '' }}"
        >
            <option value="" disabled selected>
                {{ $placeholder ?? 'Select Option' }}
            </option>

            @foreach($options as $option)
                @php
                    if(is_array($option)){
                        $value = $option[$optionValue ?? 'id'];
                        $text  = $option[$optionLabel ?? 'name'];
                    }elseif(is_object($option)){
                        $value = $option->{$optionValue ?? 'id'};
                        $text  = $option->{$optionLabel ?? 'name'};
                    }else{
                        $value = $option;
                        $text  = $option;
                    }
                @endphp

                <option
                    value="{{ $value }}"
                    {{ (string) old($name, $selected ?? '') === (string) $value ? 'selected' : '' }}
                >
                    {{ $text }}
                </option>
            @endforeach
        </select>
    </div>

    @error($name)
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
