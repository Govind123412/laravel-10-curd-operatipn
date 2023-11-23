
@extends('books.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel Book Store Curd Application</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('books.create') }}"> Create New Book</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <form action="{{ route('books.index') }}" method="GET">
                <div class="form-group">
                    <input type="text" name="search" value="{{ old('search') }}" class="form-control" placeholder="Search by title">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
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
            <th>Title</th>
            <th>author</th>
            <th>isbn</th>
            <th>genre</th>
            <th>image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->genre }}</td>
            <td>
                @if ($book->image)
                    @php
                        $imageUrl = $book->image;
                        if (!Str::startsWith($imageUrl, 'https://') && !Str::startsWith($imageUrl, 'http://')) {
                            $imageUrl = asset('storage/' . $imageUrl);
                        }
                    @endphp

                    <img src="{{ $imageUrl }}" alt="Book Image" style="max-width: 100px; max-height: 100px;">
                @else
                    No Image
                @endif               
            </td>           

            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $books->links() !!}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      
@endsection