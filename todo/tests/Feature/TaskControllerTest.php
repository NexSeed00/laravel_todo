<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class TaskControllerTest extends TestCase
{
    /**
     *
     * @test
     * @return void
     */
    public function index_response_ok()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function create_response_ok_only_sign_in()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/tasks/create');

        $response->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function create_ログインしてない場合はログイン画面にリダイレクト()
    {
        $response = $this->get('/tasks/create');

        $response->assertRedirect(route('login'));
    }
}
