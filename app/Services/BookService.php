<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookVideo;
use Illuminate\Support\Facades\Storage;

class BookService
{
    public function getAllBooks()
    {
        return Book::with(['images', 'videos', 'categories'])->latest()->get();
    }

    public function createBook(array $data)
    {
        $book = Book::create($data);

        if (isset($data['categories'])) {
            $book->categories()->sync($data['categories']);
        }

        return $book;
    }

    public function updateBook(Book $book, array $data)
    {
        $book->update($data);

        if (isset($data['categories'])) {
            $book->categories()->sync($data['categories']);
        }

        return $book->fresh();
    }

    public function deleteBook(Book $book)
    {
        // Delete associated images and videos
        $this->deleteAllImages($book);
        $this->deleteAllVideos($book);

        return $book->delete();
    }

    public function addImage(Book $book, $imageFile)
    {
        $path = $imageFile->store('public/book_images');
        return $book->images()->create([
            'path' => Storage::url($path),
            'original_name' => $imageFile->getClientOriginalName()
        ]);
    }

    public function deleteImage(BookImage $image)
    {
        Storage::delete(str_replace('/storage', 'public', $image->path));
        return $image->delete();
    }

    public function deleteAllImages(Book $book)
    {
        foreach ($book->images as $image) {
            $this->deleteImage($image);
        }
    }

    public function addVideo(Book $book, $videoFile)
    {
        $path = $videoFile->store('public/book_videos');
        return $book->videos()->create([
            'path' => Storage::url($path),
            'original_name' => $videoFile->getClientOriginalName()
        ]);
    }

    public function deleteVideo(BookVideo $video)
    {
        Storage::delete(str_replace('/storage', 'public', $video->path));
        return $video->delete();
    }

    public function deleteAllVideos(Book $book)
    {
        foreach ($book->videos as $video) {
            $this->deleteVideo($video);
        }
    }
}
