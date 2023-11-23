<?php
  
namespace App\Http\Controllers;
  
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
  
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

   
     public function index(Request $request)
     {
         $books = Book::when($request->search, function ($query, $search) {
             return $query->where('title', 'like', '%' . $search . '%');
         })->paginate(10);
     
         return view('books.index', compact('books'))
             ->with('i', (request()->input('page', 1) - 1) * 10);
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('books.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'genre' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'date',
            'publication_description' => 'nullable|string',
            'date' => 'date',
        ]);

        $book = new Book();
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = $imagePath;
        }

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->isbn = $request->input('isbn');
        $book->genre = $request->input('genre');
        $book->published = $request->input('published');
        $book->publisher = $request->input('publisher');
        $book->publication_description = $request->input('publication_description');
        $book->date = $request->input('date');

        $book->save();
    
        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }
    
  
    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('books.show',compact('book'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('books.edit',compact('book'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'genre' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'date',
            'publication_description' => 'nullable|string',
            'date' => 'date',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = $imagePath;
        }
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->isbn = $request->input('isbn');
        $book->genre = $request->input('genre');
        $book->published = $request->input('published');
        $book->publisher = $request->input('publisher');
        $book->publication_description = $request->input('publication_description');
        $book->date = $request->input('date');

        $book->save();

        return redirect()->route('books.index')
                        ->with('success', 'Book updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
         
        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }
}