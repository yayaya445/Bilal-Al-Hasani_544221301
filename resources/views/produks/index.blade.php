@extends('menus.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right" style="margin-bottom: 10px; ">
                <a class="btn btn-success" href="{{ route('produks.create') }}"> tambah </a>
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
            <th>nama</th>
            <th>kategori</th>
            <th>harga</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($produks as $produk)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $produk->nama }}</td>
            <td>{{ $produk->kategori }}</td>
            <td>{{ $produk->harga_jual }}</td>
            <td>
                <form action="{{ route('produks.destroy',$produk->id) }}" method="POST">
     
                    <a class="btn btn-primary" href="{{ route('produks.edit',$produk->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $produks->links() !!}
        
@endsection