@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Book Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $book->title }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $book->author }}</td>
            </tr>
            <tr>
                <th>ISBN</th>
                <td>{{ $book->isbn }}</td>
            </tr>
            <tr>
                <th>Genre</th>
                <td>{{ $book->genre }}</td>
            </tr>
            <tr>
                <th>Published</th>
                <td>
                    @if($book->published)
                        <span style="color: green;">Yes</span>
                    @else
                        <span style="color: red;">No</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Publisher</th>
                <td>{{ $book->publisher }}</td>
            </tr>
            <tr>
                <th>Publication Description</th>
                <td>{{ $book->publication_description }}</td>
            </tr>
            <tr>
            <th>Image</th>
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
        </tr>

            <tr>
                <th>Date</th>
                <td>{{ $book->date }}</td>
            </tr>
        </tbody>
    </table>
@endsection
