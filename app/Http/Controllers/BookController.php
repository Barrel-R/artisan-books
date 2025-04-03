<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookVideo;
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

    public function create(CategoryService $service)
    {
        return inertia('Books/Create', [
            'categories' => $service->getAllCategories(),
        ]);
    }

    public function store(BookStoreRequest $request)
    {
        $book = $this->bookService->createBook($request->validated());

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $this->bookService->addImage($book, $image);
            }
        }

        if ($request->has('videos')) {
            foreach ($request->file('videos') as $video) {
                $this->bookService->addVideo($book, $video);
            }
        }

        return redirect()->route('books.index')
            ->with('status', 'Book created successfully');
    }

    public function edit(Book $book, CategoryService $service)
    {
        return inertia('Books/Edit', [
            'book' => $book->load(['images', 'videos', 'categories']),
            'categories' => $service->getAllCategories(),
        ]);
    }

    public function update(BookUpdateRequest $request, Book $book)
    {
        $this->bookService->updateBook($book, $request->validated());

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $this->bookService->addImage($book, $image);
            }
        }

        if ($request->has('videos')) {
            foreach ($request->file('videos') as $video) {
                $this->bookService->addVideo($book, $video);
            }
        }

        return redirect()->route('livros.index')
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
