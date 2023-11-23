@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Title:</strong>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Author:</strong>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" class="form-control" placeholder="Author">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New ISBN:</strong>
                    <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="form-control" placeholder="ISBN">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Genre:</strong>
                    <input type="text" name="genre" value="{{ old('genre', $book->genre) }}" class="form-control" placeholder="Genre">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Image:</strong>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Current Image:</strong>
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
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Published:</strong>
                    <input type="date" name="published" value="{{ old('published', $book->published) }}" class="form-control" placeholder="Published Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Publisher:</strong>
                    <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="form-control" placeholder="Publisher">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Publication Description:</strong>
                    <textarea name="publication_description" class="form-control" placeholder="Publication Description">{{ old('publication_description', $book->publication_description) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>New Date:</strong>
                    <input type="date" name="date" value="{{ old('date', $book->date) }}" class="form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
