@extends('adminlte.master')

@section('content')
    <h2>Post {{$post->id}} </h2>
    <h4> {{$post->title}} </h4>
    <p> {{$post->body}} </p>
    <p> Penulis : {{ $post->author->name }} </p>

    <div>
        Tags :
        @foreach ($post->tags as $tag)
            <button class="btn btn-primary btn-sm"> {{$tag->tag_name}} </button>
        @endforeach
    </div>
@endsection

@push('scripts')
    
@endpush