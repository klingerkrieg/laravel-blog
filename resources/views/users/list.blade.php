@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Users') }}</div>

    <div class="card-body">
        <form method="GET" action="{{ route('user.list') }}">
            @csrf

            <div class="row mb-3">
                <label for="subject" class="col-md-4 col-form-label text-md-right">
                    {{ __('Search') }}</label>

                <div class="col-md-6">
                    <input id="search" type="text" 
                            class="form-control" 
                            name="search" value="{{ old('search') }}" 
                            autofocus>

                </div>
            </div>

            
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">{{__("Name")}}</th>
                <th scope="col">{{__("E-mail")}}</th>
                <th scope="col">{{__("Posts count")}}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>
                        <a href="{{route("user.edit",$item)}}" class="btn btn-primary">
                            {{ __('Edit') }}
                        </a>
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->posts->count() }}</td>
                    <td>
                        <form action="{{route('user.destroy',$item)}}" method="user">
                            @csrf
                            @method("DELETE")
                            <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>

        {{ $list->links() }}

    </div>
</div>
</div>
</div>
</div>
@endsection
