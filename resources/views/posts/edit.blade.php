@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Posts') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('post.update',$item) }}">
            @csrf
            @method("PUT")

            <div class="row mb-3">
                <label for="subject" class="col-md-4 col-form-label text-md-right">
                    {{ __('Subject') }}</label>

                <div class="col-md-6">
                    <input id="subject" type="text" 
                            class="form-control @error('subject') is-invalid @enderror" 
                            name="subject" value="{{ $item->subject }}" 
                            required autofocus>

                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="publish_date" class="col-md-4 col-form-label text-md-right">
                    {{ __('Publish date') }}</label>

                <div class="col-md-6">
                    <input id="publish_date" type="date" 
                            class="form-control @error('publish_date') is-invalid @enderror" 
                            name="publish_date" value="{{ $item->publish_date->format("Y-m-d") }}" 
                            required>

                    @error('publish_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-md-4 col-form-label text-md-right">
                    {{ __('Image') }}</label>

                <div class="col-md-6">
                    <input type="text" name="image" value="{{$item->image}}">

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-md-4 col-form-label text-md-right">
                    {{ __('Slug') }}</label>

                <div class="col-md-6">
                    <input type="text" name="slug" value="{{$item->slug}}">

                </div>
            </div>


            <div class="row mb-3">
                <label for="text" class="col-md-4 col-form-label text-md-right">
                    {{ __('Text') }}</label>

                <div class="col-md-6">
                    <textarea name="text" id="text" class="form-control">{{$item->text}}</textarea>

                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
