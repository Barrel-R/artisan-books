<?php

use App\Models\Category;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookVideo;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create();
});

test("página de livros pode ser vista", function () {
    Book::factory()->create();

    $response = $this->actingAs($this->admin)->get("/livros");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("livro pode ser visto", function () {
    $livro = Book::factory()->create();

    $response = $this->actingAs($this->admin)->get("/livros/$livro->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("livro pode ser criado", function () {
    $livro = [
        "title" => "Um livro",
        "description" => "sobre gatinhos",
        "long_description" => "Um livro interativo com vários gatos sobre alguma história muito interessante",
        "gender" => "Masculino",
        "price" => 33.99,
        "age_range" => "3-5 anos",
        "page_count" => "35",
        "dimensions" => "90x35",
        "manufacturing_time" => "3 dias",
    ];

    $response = $this->actingAs($this->admin)->post("/livros", $livro);

    $response->assertSessionHasNoErrors()->assertRedirect("/livros");

    $this->assertDatabaseHas("books", $livro);
});

test("livro pode ser editado", function () {
    $livro = Book::factory()->create();

    $novoLivro = ["title" => "Um novo title"];

    $response = $this->actingAs($this->admin)->patch("/livros/$livro->id", $novoLivro);

    $livro->refresh();

    $response->assertSessionHasNoErrors()->assertRedirect("/livros/$livro->id");

    expect($livro->title)->toBe($novoLivro['title']);
});

test("livro pode ser deletado", function () {
    $livro = Book::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/livros/$livro->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/livros");
});

test("livro pode ter videos", function () {
    $livro = Book::factory()->create();
    $video = BookVideo::factory()->for($livro)->create();

    $livro->videos()->save($video);

    expect($livro->videos()->count())->toBe(1);
    expect($livro->videos()->first()->id)->toBe($video->id);
});

test("livro pode ter imagens", function () {
    $livro = Book::factory()->create();
    $imagem = BookImage::factory()->for($livro)->create();

    $livro->images()->save($imagem);

    expect($livro->images()->count())->toBe(1);
    expect($livro->images()->first()->id)->toBe($imagem->id);
});

test("livro pode ter categories", function () {
    $livro = Book::factory()->create();
    $categoria = Category::factory()->create();

    $livro->categories()->attach($categoria->id);

    expect($livro->categories()->count())->toBe(1);
    expect($livro->categories()->first()->id)->toBe($categoria->id);
});
