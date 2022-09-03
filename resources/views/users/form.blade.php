@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Users') }}</div>

    <div class="card-body">

        @if ($item->id == "")
            <form id="main" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @else
            <form id="main" method="POST" action="{{ route('user.update',$item) }}" enctype="multipart/form-data">
            @method('PUT')
        @endif

            @csrf

            
            
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    {{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name',$item->name) }}" 
                            autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                    {{ __('E-mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email',$item->email) }}" 
                            autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <ol>
            @foreach ($products as $product)
                <li><a href='{{route('product.edit',$product)}}'>{{ $product->name }}</a></li>
            @endforeach
            </ol>
            {{ $products->links() }}



            @include('users.address')

        </form>
            
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" form="main">
                        {{ __('Save') }}
                    </button>

                    @if ($item->id != "")
                    <form name='delete' action="{{route('user.destroy',$item)}}" 
                        method="user"
                        style='display: inline-block;'>
                        @csrf
                        @method("DELETE")
                        <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
