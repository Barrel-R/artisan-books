<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookVideo;
use App\Models\Category;
use App\Services\BookService;
use App\Services\CategoryService;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();

        return inertia('Books/Index', [
            'books' => $books,
            'status' => session('status'),
        ]);
    }

    public function show(Category $category)
    {
        return inertia('Books/Show', [
            'category' => $category,
        ]);
    }


    public function create(CategoryService $service)
    {
        return inertia('Books/Create', [
            'categories' => $service->getAllCategories(),
        ]);
    }

    public function store(BookStoreRequest $request)
    {
        $book = $this->bookService->createBook($request);

        return redirect()->route('livros.index')
            ->with('status', 'Book created successfully');
    }

    public function edit(Book $book, CategoryService $service)
    {
        return inertia('Books/Edit', [
            'book' => $book->load(['images', 'videos', 'categories']),
            'categories' => $service->getAllCategories(),
        ]);
    }

    public function update(BookUpdateRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $this->bookService->updateBook($request, $book);

        return redirect()->route('livros.show', ["livro" => $id])
            ->with('status', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $this->bookService->deleteBook($book);
        return redirect()->route('livros.index')
            ->with('status', 'Book deleted successfully');
    }

    public function deleteImage(BookImage $image)
    {
        $this->bookService->deleteImage($image);

        return back()->with('status', 'Imagem deleteda com sucesso.');
    }

    public function deleteVideo(BookVideo $video)
    {
        $this->bookService->deleteVideo($video);

        return back()->with('status', 'Vídeo deletado com sucesso.');
    }
}
