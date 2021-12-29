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
                            class="form-control" 
                            name="subject" value="{{ old('subject') }}" 
                            autofocus>

                </div>
            </div>

            <div class="row mb-3">
                <label for="publish_date" class="col-md-4 col-form-label text-md-right">
                    {{ __('Publish date') }}</label>

                <div class="col-md-6">
                    <input id="publish_date" type="date" 
                            class="form-control" 
                            name="publish_date" value="{{ old('publish_date') }}" >
                </div>
            </div>

            <div class="row mb-3">
                <label for="text" class="col-md-4 col-form-label text-md-right">
                    {{ __('Text') }}</label>

                <div class="col-md-6">
                    <input id="text" type="text" 
                            class="form-control" 
                            name="text" value="{{ old('text') }}" >
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

        <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">{{__("Subject")}}</th>
                <th scope="col">{{__("Slug")}}</th>
                <th scope="col">{{__("Publish date")}}</th>
                <th scope="col">{{__("Text")}}</th>
                <th scope="col">{{__("Owner")}}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>
                        <a href="{{route("post.edit",$item)}}" class="btn btn-primary">
                            {{ __('Edit') }}
                        </a>
                    </td>
                    <td>{{ $item->subject }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->publish_date->format('d/m/Y') }}</td>
                    <td>{{ $item->text }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <form action="{{route('post.destroy',$item)}}" method="post">
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
