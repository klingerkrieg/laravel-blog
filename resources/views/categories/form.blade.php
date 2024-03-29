@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Categories') }}</div>

    <div class="card-body">

        @if ($item->id == "")
            <form id="main" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
        @else
            <form id="main" method="POST" action="{{ route('category.update',$item) }}" enctype="multipart/form-data">
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
                <label for="product_id" class="col-md-4 col-form-label text-md-right">
                    {{ __('Product') }}</label>
                
                <div class="col-md-6">

                    <select class="form-select @error('product_id') is-invalid @enderror" 
                            id="product_id"
                            name="product_id" >
                            <option value=''>{{__("Select one option")}}</option>
                            <option value='50'>Opção invalida</option>
                        @foreach($productsList as $product)
                            
                            <option value='{{$product->id}}'
                                @if (old('product_id',$item->product_id) == $product->id)
                                    selected
                                @endif
                                >{{$product->name}}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            {{--<ol>
            @foreach ($item->products as $product)
                <li><a href='{{route('product.edit',$product)}}'>{{ $product->name }}</a></li>
            @endforeach
            </ol>--}}

            @if($item->exists)
            <ol>
            @foreach ($products as $product)
                <li><a href='{{route('product.edit',$product)}}'>{{ $product->name }}</a></li>
            @endforeach
            </ol>
            {{ $products->links() }}
            @endif
        </form>
            
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" form="main">
                        {{ __('Save') }}
                    </button>

                    <a href='{{route("category.create")}}' class="btn btn-secondary">
                        {{ __('New Category') }}
                    </a>

                    @if ($item->id != "")
                    <form name='delete' action="{{route('category.destroy',$item)}}" 
                        method="category"
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
