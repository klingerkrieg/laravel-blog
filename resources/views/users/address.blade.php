<div class="row mb-3">
    <label for="cep" class="col-md-4 col-form-label text-md-right">
        {{ __('CEP') }}</label>

    <div class="col-md-6">
        <input id="cep" type="text" 
                class="form-control @error('cep') is-invalid @enderror cep" 
                name="cep" value="{{ old('cep',!empty($item->address) ? $item->address->cep : '') }}" 
                autofocus>

        @error('cep')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="street" class="col-md-4 col-form-label text-md-right">
        {{ __('Street') }}</label>

    <div class="col-md-6">
        <input id="street" type="text" 
                class="form-control @error('street') is-invalid @enderror" 
                name="street" value="{{ old('street',!empty($item->address) ? $item->address->street : '') }}" 
                autofocus>

        @error('street')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="number" class="col-md-4 col-form-label text-md-right">
        {{ __('Number') }}</label>

    <div class="col-md-6">
        <input id="number" type="text" 
                class="form-control @error('number') is-invalid @enderror" 
                name="number" value="{{ old('number',!empty($item->address) ? $item->address->number : '') }}" 
                autofocus>

        @error('number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="complement" class="col-md-4 col-form-label text-md-right">
        {{ __('Complement') }}</label>

    <div class="col-md-6">
        <input id="complement" type="text" 
                class="form-control @error('complement') is-invalid @enderror" 
                name="complement" value="{{ old('complement',!empty($item->address) ? $item->address->complement : '') }}" 
                autofocus>

        @error('complement')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="district" class="col-md-4 col-form-label text-md-right">
        {{ __('District') }}</label>

    <div class="col-md-6">
        <input id="district" type="text" 
                class="form-control @error('district') is-invalid @enderror" 
                name="district" value="{{ old('district',!empty($item->address) ? $item->address->district : '') }}" 
                autofocus>

        @error('district')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>




<div class="row mb-3">
    <label for="city" class="col-md-4 col-form-label text-md-right">
        {{ __('City') }}</label>

    <div class="col-md-6">
        <input id="city" type="text" 
                class="form-control @error('city') is-invalid @enderror" 
                name="city" value="{{ old('city',!empty($item->address) ? $item->address->city : '') }}" 
                autofocus>

        @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



<div class="row mb-3">
    <label for="state" class="col-md-4 col-form-label text-md-right">
        {{ __('State') }}</label>

    <div class="col-md-6">
        <input id="state" type="text" 
                class="form-control @error('state') is-invalid @enderror" 
                name="state" value="{{ old('state',!empty($item->address) ? $item->address->state : '') }}" 
                autofocus>

        @error('state')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>