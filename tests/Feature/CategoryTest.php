<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create();
});

test("página de categorias pode ser vista", function () {
    Category::factory()->create();

    $response = $this->actingAs($this->admin)->get("/categorias");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("categoria pode ser criada", function () {
    $categoria = ["description" => "createTest", "slug" => fake()->slug()];

    $response = $this->actingAs($this->admin)->post("/categorias", $categoria);

    $response->assertSessionHasNoErrors()->assertRedirect("/categorias");
});

test("categoria pode ser vista", function () {
    $categoria = Category::factory()->create();

    $response = $this->actingAs($this->admin)->get("/categorias/$categoria->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("categoria pode ser editada", function () {
    $categoria = Category::factory()->create();

    $novaCategoria = ["description" => "novacategoria"];

    $response = $this->actingAs($this->admin)->patch("/categorias/$categoria->id", $novaCategoria);

    $categoria->refresh();

    expect($categoria->description)->toBe($novaCategoria["description"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/categorias/$categoria->id");
});

test("categoria pode ser deletada", function () {
    $categoria = Category::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/categorias/$categoria->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/categorias");
});
