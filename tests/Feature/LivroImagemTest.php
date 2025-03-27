<?php

use App\Models\Livro;
use App\Models\LivroImagem;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $permissions = [
        ["name" => "ver imagens", "guard_name" => "web"],
        ["name" => "ver uma imagem", "guard_name" => "web"],
        ["name" => "criar imagens", "guard_name" => "web"],
        ["name" => "editar imagens", "guard_name" => "web"],
        ["name" => "deletar imagens", "guard_name" => "web"],
    ];

    $userPermissions = [
        "ver imagens",
        "ver uma imagem",
        "criar imagens",
        "editar imagens",
        "deletar imagens",
    ];

    Permission::insert($permissions);
    Role::create(['name' => 'Admin', 'guard_name' => 'web'])->givePermissionTo($userPermissions);

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
