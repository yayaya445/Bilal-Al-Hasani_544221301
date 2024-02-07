@extends('strukturs.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('strukturs.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>foto</th>
            <th>nama</th>
            <th>divisi</th>
            <th>latar belakang</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($strukturs as $struktur)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/images/{{ $struktur->image }}" width="100px"></td>
            <td>{{ $struktur->nama }}</td>
            <td>{{ $struktur->divisi }}</td>
            <td>{{ $struktur->latarbelakang }}</td>
            <td>
                <form action="{{ route('strukturs.destroy',$struktur->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('strukturs.show',$struktur->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('strukturs.edit',$struktur->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $strukturs->links() !!}
        
@endsection