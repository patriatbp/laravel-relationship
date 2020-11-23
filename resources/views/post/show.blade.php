@extends('adminlte.master')

@section('content')
    <h2>Post {{$post->id}} </h2>
    <h4> {{$post->title}} </h4>
    <p> {{$post->body}} </p>
    <p> Penulis : {{ $post->author->name }} </p>
@endsection

@push('scripts')
    
@endpush