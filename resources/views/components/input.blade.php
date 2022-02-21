<div class="row mb-3 @if ($attributes->get('class')) {{$attributes->get('class')}} @endif"

    @if ($attributes->get('style'))
        style="{{$attributes->get('style')}}"
    @endif
    >
    @if ($label)
        <label for="{{$id}}" class="col-md-4 col-form-label text-md-right">
            {{ __($label) }}

            @if ($attributes->get('required') == true)
                <span style='color:red'>*</span>
            @endif
        </label>
    @endif
    
    <div class="col-md-6">
        <input  id="{{$id}}" 
                type="{{$type}}" 
                class="form-control @error($name) is-invalid @enderror" 
                name="name" 
                @if($value)
                    value="{{ $value }}"
                @else
                    value="{{ old($name) }}"
                @endif
                >

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>