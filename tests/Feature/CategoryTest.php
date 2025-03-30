<?php

use App\Models\Categoria;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $permissions = [
        ["name" => "ver categorias", "guard_name" => "web"],
        ["name" => "ver uma categoria", "guard_name" => "web"],
        ["name" => "criar categorias", "guard_name" => "web"],
        ["name" => "editar categorias", "guard_name" => "web"],
        ["name" => "deletar categorias", "guard_name" => "web"],
    ];

    $userPermissions = [
        "ver categorias",
        "ver uma categoria",
        "criar categorias",
        "editar categorias",
        "deletar categorias",
    ];

    Permission::insert($permissions);
    Role::create(['name' => 'Admin', 'guard_name' => 'web'])->givePermissionTo($userPermissions);

    $this->admin = User::factory()->create()->assignRole("Admin");
});

test("página de categorias pode ser vista", function () {
    Categoria::factory()->create();

    $response = $this->actingAs($this->admin)->get("/categorias");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("categoria pode ser criada", function () {
    $categoria = ["descricao" => "createTest",];

    $response = $this->actingAs($this->admin)->post("/categorias", $categoria);

    $response->assertSessionHasNoErrors()->assertRedirect("/categorias");
});

test("categoria pode ser vista", function () {
    $categoria = Categoria::factory()->create();

    $response = $this->actingAs($this->admin)->get("/categorias/$categoria->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("categoria pode ser editada", function () {
    $categoria = Categoria::factory()->create();

    $novaCategoria = ["descricao" => "novacategoria"];

    $response = $this->actingAs($this->admin)->patch("/categorias/$categoria->id", $novaCategoria);

    $categoria->refresh();

    expect($categoria->descricao)->toBe($novaCategoria["descricao"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/categorias/$categoria->id");
});

test("categoria pode ser deletada", function () {
    $categoria = Categoria::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/categorias/$categoria->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/categorias");
});
