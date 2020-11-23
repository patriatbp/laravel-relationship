@extends('adminlte.master')

@section('content')
<div>
    <h2>Edit Post {{$post->id}}</h2>
    <form action="/post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{$post->title}}" id="title" placeholder="Masukkan Title">
            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">body</label>
            <input type="text" class="form-control" name="body"  value="{{$post->body}}"  id="body" placeholder="Masukkan Body">
            @error('body')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
@endsection

@push('scripts')
    
@endpush