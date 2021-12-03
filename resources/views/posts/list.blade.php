@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Posts') }}</div>

    <div class="card-body">
        <form method="GET" action="{{ route('post.list') }}">
            @csrf

            <div class="row mb-3">
                <label for="subject" class="col-md-4 col-form-label text-md-right">
                    {{ __('Subject') }}</label>

                <div class="col-md-6">
                    <input id="subject" type="text" 
                            class="form-control @error('subject') is-invalid @enderror" 
                            name="subject" value="{{ old('subject') }}" 
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
                            name="publish_date" value="{{ old('publish_date') }}" 
                            required>

                    @error('publish_date')
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
                    <textarea name="text" id="text" class="form-control"></textarea>

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
                        {{ __('Search') }}
                    </button>

                    <a href='{{route("post.create")}}' class="btn btn-primary">
                        {{ __('New Post') }}
                    </a>
                </div>
            </div>
        </form>

        <ul>
        @foreach ($list as $item)
        <li>

            {{$item->subject}} | {{$item->slug}} | {{$item->text}} |
            
            <form action="{{route('post.destroy',$item)}}" method="post">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger">
                    {{ __('Delete') }}
                </button>
            </form>

            <a href="{{route("post.edit",$item)}}" class="btn btn-primary">
                {{ __('Edit') }}
            </a>
        </li>
        @endforeach
        </ul>  
        {{ $list->links() }}

    </div>
</div>
</div>
</div>
</div>
@endsection
