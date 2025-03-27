<?php

use App\Models\Categoria;
use App\Models\Livro;
use App\Models\LivroImagem;
use App\Models\LivroVideo;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->admin = User::factory()->create()->assignRole("Admin");
});

test("página de livros pode ser vista", function () {
    Livro::factory()->create();

    $response = $this->actingAs($this->admin)->get("/livros");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("livro pode ser criado", function () {
    $livro = ["titulo" => "Um Livro", "descricao" => "sobre gatinhos", "descricaoLonga" => "Um livro interativo com vários gatos sobre alguma história muito interessante", "genero" => "Masculino"];

    $response = $this->actingAs($this->admin)->post("/livros", $livro);

    $response->assertSessionHasNoErrors()->assertRedirect("/livros");
});

test("livro pode ser visto", function () {
    $livro = Livro::factory()->create();

    $response = $this->actingAs($this->admin)->get("/livros/$livro->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("livro pode ser editado", function () {
    $livro = Livro::factory()->create();

    $novoLivro = ["titulo" => "Um novo titulo"];

    $response = $this->actingAs($this->admin)->patch("/livros/$livro->id", $novoLivro);

    expect(Livro::find($livro->id)->titulo)->toBe($novoLivro['titulo']);

    $response->assertSessionHasNoErrors()->assertRedirect("/livros/$livro->id");
});

test("livro pode ser deletado", function () {
    $livro = Livro::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/livros/$livro->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/livros");
});

test("livro pode ter videos", function () {
    $livro = Livro::factory()->create();
    $video = LivroVideo::factory()->create();

    $livro->videos()->save($video);

    expect($livro->videos()->count())->toBe(1);
    expect($livro->videos()->first()->id)->toBe($video->id);
});

test("livro pode ter imagens", function () {
    $livro = Livro::factory()->create();
    $imagem = LivroImagem::factory()->create();

    $livro->imagens()->save($imagem);

    expect($livro->imagens()->count())->toBe(1);
    expect($livro->imagens()->first()->id)->toBe($imagem->id);
});

test("livro pode ter categorias", function () {
    $livro = Livro::factory()->create();
    $categoria = Categoria::factory()->create();

    $livro->categorias()->attach($categoria->id);

    expect($livro->categorias()->count())->toBe(1);
    expect($livro->categorias()->first()->id)->toBe($categoria->id);
});
