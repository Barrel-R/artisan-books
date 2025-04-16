<?php

use App\Models\Book;
use App\Models\BookVideo;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create();
});

test("página de vídeos pode ser vista", function () {
    BookVideo::factory()->for(Book::factory()->create())->create();

    $response = $this->actingAs($this->admin)->get("/videos");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("vídeo pode ser criado", function () {
    $livro = Book::factory()->create();

    $video = ["path" => "/age10/test/", "book_id" => $livro->id];

    $response = $this->actingAs($this->admin)->post("/videos", $video);

    $response->assertSessionHasNoErrors()->assertRedirect("/videos");
});

test("vídeo pode ser visto", function () {
    $video = BookVideo::factory()->for(Book::factory()->create())->create();


    $response = $this->actingAs($this->admin)->get("/videos/$video->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("video pode ser editado", function () {
    $video = BookVideo::factory()->for(Book::factory()->create())->create();

    $novoVideo = ["path" => "/newpath/"];

    $response = $this->actingAs($this->admin)->patch("/videos/$video->id", $novoVideo);

    $video->refresh();

    expect($video->path)->toBe($novoVideo["path"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/videos/$video->id");
});

test("video pode ser deletado", function () {
    $video = BookVideo::factory()->for(Book::factory()->create())->create();

    $response = $this->actingAs($this->admin)->delete("/videos/$video->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/videos");
});
