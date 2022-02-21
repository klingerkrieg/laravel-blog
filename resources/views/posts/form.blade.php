@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Posts') }}</div>

    <div class="card-body">

        @if ($data->id == "")
            <form id="main" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @else
            <form id="main" method="POST" action="{{ route('post.update',$data) }}" enctype="multipart/form-data">
            @method('PUT')
        @endif

            @csrf

        @if ($data->id != "")            
        <div class="row mb-3">
            <label for="subject" class="col-md-4 col-form-label text-md-right">
                {{ __('Dono') }}</label>
                
                <div class="col-md-6">
                    <input  class="form-control" 
                    name="subject" value="{{ $data->user->name }}" 
                    disabled>
                </div>
        </div>
        @endif
            
            <x-input name="subject" id="subject" 
                        class="subject" style='color:green'
                        label="Subject" required="true"
                        :value="$data->subject"></x-input>

            {{--<div class="row mb-3">
                <label for="subject" class="col-md-4 col-form-label text-md-right">
                    {{ __('Subject') }}</label>

                <div class="col-md-6">
                    <input id="subject" type="text" 
                            class="form-control @error('subject') is-invalid @enderror" 
                            name="subject" value="{{ old('subject',$data->subject) }}" 
                            autofocus>

                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>--}}

            <div class="row mb-3">
                <label for="publish_date" class="col-md-4 col-form-label text-md-right">
                    {{ __('Publish date') }}</label>

                <div class="col-md-6">
                    <input id="publish_date" type="date" 
                            class="form-control @error('publish_date') is-invalid @enderror" 
                            name="publish_date" value="{{ old('publish_date',$data->publish_date == "" ? "" : $data->publish_date->format('Y-m-d')) }}" 
                            >

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

                    <input type="file" name="image" id="image"
                        class="form-control-file @error('image') is-invalid @enderror">

                    @if ($data->id)
                        <img src="{{asset($data->image)}}" class="rounded" width='200'/>
                    @endif

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
                    <input type="text" readonly value="{{$data->slug}}"
                    class="form-control @error('slug') is-invalid @enderror">
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="text" class="col-md-4 col-form-label text-md-right">
                    {{ __('Text') }}</label>

                <div class="col-md-6">
                    <textarea name="text" id="text" 
                    class="form-control @error('text') is-invalid @enderror"
                    >{{old('text',$data->text)}}</textarea>

                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

        </form>
            
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    @can('update',$data)
                    <button type="submit" class="btn btn-primary" form="main">
                        {{ __('Save') }}
                    </button>
                    @endcan
                    
                    @can('create',$data)
                    <a class="btn btn-secondary" href='{{route("post.create")}}'>
                        {{ __('New Post') }}
                    </a>
                    @endcan

                    
                    @can('delete',$data)
                    <form name='delete' action="{{route('post.destroy',$data)}}" 
                        method="post"
                        style='display: inline-block;'>
                        @csrf
                        @method("DELETE")
                        <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
