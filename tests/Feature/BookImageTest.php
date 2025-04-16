<?php

use App\Models\Book;
use App\Models\BookImage;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create();
});

test("página de imagens pode ser vista", function () {
    BookImage::factory()->for(Book::factory()->create())->create();

    $response = $this->actingAs($this->admin)->get("/imagens");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("imagem pode ser criada", function () {
    $livro = BookImage::factory()->for(Book::factory()->create())->create();

    $imagem = ["path" => "/age12/test-image/", "book_id" => $livro->id];

    $response = $this->actingAs($this->admin)->post("/imagens", $imagem);

    $response->assertSessionHasNoErrors()->assertRedirect("/imagens");
});

test("imagem pode ser vista", function () {
    $imagem = BookImage::factory()->for(Book::factory()->create())->create();

    $response = $this->actingAs($this->admin)->get("/imagens/$imagem->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("imagem pode ser editada", function () {
    $imagem = BookImage::factory()->for(Book::factory()->create())->create();

    $novaImagem = ["path" => "/newpath323/"];

    $response = $this->actingAs($this->admin)->patch("/imagens/$imagem->id", $novaImagem);

    $imagem->refresh();

    expect($imagem->path)->toBe($novaImagem["path"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/imagens/$imagem->id");
});

test("imagem pode ser deletada", function () {
    $imagem = BookImage::factory()->for(Book::factory()->create())->create();

    $response = $this->actingAs($this->admin)->delete("/imagens/$imagem->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/imagens");
});
