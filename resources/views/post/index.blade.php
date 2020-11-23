@extends('adminlte.master')

@section('content')
<a href="/post/create" class="btn btn-primary">Tambah</a>
<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($post as $key=>$value)
            <tr>
                <td>{{$key + 1}}</th>
                <td>{{$value->title}}</td>
                <td>{{$value->body}}</td>
                <td  style="display: inline-block">
                    <a href="/post/{{$value->id}}" class="btn btn-info">Show</a>
                    <a href="/post/{{$value->id}}/edit" class="btn btn-primary">Edit</a>
                    <form action="/post/{{$value->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger my-1" value="Delete">
                    </form>
                </td>
            </tr>
        @empty
            <tr colspan="3">
                <td>No data</td>
            </tr>  
        @endforelse              
    </tbody>
</table>
@endsection

@push('scripts')
    
@endpush