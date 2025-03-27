<?php

use App\Models\Livro;
use App\Models\LivroImagem;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->admin = User::factory()->create()->assignRole("Admin");
});

test("página de imagens pode ser vista", function () {
    LivroImagem::factory()->create();

    $response = $this->actingAs($this->admin)->get("/imagens");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("imagem pode ser criada", function () {
    $livro = Livro::factory()->create();

    $imagem = ["path" => "/age12/test-image/", "livro_id" => $livro->id];

    $response = $this->actingAs($this->admin)->post("/imagens", $imagem);

    $response->assertSessionHasNoErrors()->assertRedirect("/imagens");
});

test("imagem pode ser vista", function () {
    $imagem = LivroImagem::factory()->create();

    $response = $this->actingAs($this->admin)->get("/imagens/$imagem->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("imagem pode ser editada", function () {
    $imagem = LivroImagem::factory()->create();

    $novaImagem = ["path" => "/newpath323/"];

    $response = $this->actingAs($this->admin)->patch("/imagens/$imagem->id", $novaImagem);

    $imagem->refresh();

    expect($imagem->path)->toBe($novaImagem["path"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/imagens/$imagem->id");
});

test("imagem pode ser deletada", function () {
    $imagem = LivroImagem::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/imagens/$imagem->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/imagens");
});
