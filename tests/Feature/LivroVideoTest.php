<?php

use App\Models\Livro;
use App\Models\LivroVideo;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->admin = User::factory()->create()->assignRole("Admin");
});

test("página de vídeos pode ser vista", function () {
    LivroVideo::factory()->create();

    $response = $this->actingAs($this->admin)->get("/videos");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("vídeo pode ser criado", function () {
    $livro = Livro::factory()->create();

    $video = ["path" => "/age10/test/", "livro_id" => $livro->id];

    $response = $this->actingAs($this->admin)->post("/videos", $video);

    $response->assertSessionHasNoErrors()->assertRedirect("/videos");
});

test("vídeo pode ser visto", function () {
    $video = LivroVideo::factory()->create();

    $response = $this->actingAs($this->admin)->get("/videos/$video->id");

    $response->assertSessionHasNoErrors()->assertSuccessful();
});

test("video pode ser editado", function () {
    $video = LivroVideo::factory()->create();

    $novoVideo = ["path" => "/newpath/"];

    $response = $this->actingAs($this->admin)->patch("/videos/$video->id", $novoVideo);

    expect(LivroVideo::find($video->id)->path)->toBe($novoVideo["path"]);

    $response->assertSessionHasNoErrors()->assertRedirect("/videos/$video->id");
});

test("video pode ser deletado", function () {
    $video = LivroVideo::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/videos/$video->id");

    $response->assertSessionHasNoErrors()->assertRedirect("/videos");
});
