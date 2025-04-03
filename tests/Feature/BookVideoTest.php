<?php

use App\Models\Book;
use App\Models\BookVideo;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $permissions = [
        ["name" => "ver videos", "guard_name" => "web"],
        ["name" => "ver um video", "guard_name" => "web"],
        ["name" => "criar videos", "guard_name" => "web"],
        ["name" => "editar videos", "guard_name" => "web"],
        ["name" => "deletar videos", "guard_name" => "web"],
    ];

    $userPermissions = [
        "ver videos",
        "ver um video",
        "criar videos",
        "editar videos",
        "deletar videos",
    ];

    Permission::insert($permissions);
    Role::create(['name' => 'Admin', 'guard_name' => 'web'])->givePermissionTo($userPermissions);

    $this->admin = User::factory()->create()->assignRole("Admin");
});

test("página de vídeos pode ser vista", function () {
    BookVideo::factory()->create();

    $response = $this->actingAs($this->admin)->get("/videos");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("vídeo pode ser criado", function () {
    $livro = Book::factory()->create();

    $video = ["path" => "/age10/test/", "livro_id" => $livro->id];

    $response = $this->actingAs($this->admin)->post("/videos", $video);

    $response->assertSessionHasNoErrors()->assertRedirect("/videos");
});

test("vídeo pode ser visto", function () {
    $video = BookVideo::factory()->create();

    $response = $this->actingAs($this->admin)->get("/videos/$video->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("video pode ser editado", function () {
    $video = BookVideo::factory()->create();

    $novoVideo = ["path" => "/newpath/"];

    $response = $this->actingAs($this->admin)->patch("/videos/$video->id", $novoVideo);

    $video->refresh();

    expect($video->path)->toBe($novoVideo["path"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/videos/$video->id");
});

test("video pode ser deletado", function () {
    $video = BookVideo::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/videos/$video->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/videos");
});
