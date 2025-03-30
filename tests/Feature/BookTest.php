<?php

use App\Models\Categoria;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookVideo;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $permissions = [
        ["name" => "ver livros", "guard_name" => "web"],
        ["name" => "ver um livro", "guard_name" => "web"],
        ["name" => "criar livros", "guard_name" => "web"],
        ["name" => "editar livros", "guard_name" => "web"],
        ["name" => "deletar livros", "guard_name" => "web"],
    ];

    $userPermissions = [
        "ver livros",
        "ver um livro",
        "criar livros",
        "editar livros",
        "deletar livros",
    ];

    Permission::insert($permissions);
    Role::create(['name' => 'Admin', 'guard_name' => 'web'])->givePermissionTo($userPermissions);

    $this->admin = User::factory()->create()->assignRole("Admin");
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
    $livro = ["titulo" => "Um livro", "descricao" => "sobre gatinhos", "descricaoLonga" => "Um livro interativo com vários gatos sobre alguma história muito interessante", "genero" => "Masculino"];

    $response = $this->actingAs($this->admin)->post("/livros", $livro);

    $response->assertSessionHasNoErrors()->assertRedirect("/livros");

    $this->assertDatabaseHas("livros", $livro);
});

test("livro pode ser editado", function () {
    $livro = Book::factory()->create();

    $novoLivro = ["titulo" => "Um novo titulo"];

    $response = $this->actingAs($this->admin)->patch("/livros/$livro->id", $novoLivro);

    $livro->refresh();

    $response->assertSessionHasNoErrors()->assertRedirect("/livros/$livro->id");

    expect($livro->titulo)->toBe($novoLivro['titulo']);
});

test("livro pode ser deletado", function () {
    $livro = Book::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/livros/$livro->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/livros");
});

test("livro pode ter videos", function () {
    $livro = Book::factory()->create();
    $video = LivroVideo::factory()->create();

    $livro->videos()->save($video);

    expect($livro->videos()->count())->toBe(1);
    expect($livro->videos()->first()->id)->toBe($video->id);
});

test("livro pode ter imagens", function () {
    $livro = Book::factory()->create();
    $imagem = BookImage::factory()->create();

    $livro->imagens()->save($imagem);

    expect($livro->imagens()->count())->toBe(1);
    expect($livro->imagens()->first()->id)->toBe($imagem->id);
});

test("livro pode ter categorias", function () {
    $livro = Book::factory()->create();
    $categoria = Categoria::factory()->create();

    $livro->categorias()->attach($categoria->id);

    expect($livro->categorias()->count())->toBe(1);
    expect($livro->categorias()->first()->id)->toBe($categoria->id);
});
