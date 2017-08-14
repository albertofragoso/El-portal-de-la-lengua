<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    //Crea tuplas en la DB pero las elimina al terminar el test
    use DatabaseTransactions;

    public function testCanSeeUserPage()
    {
      $user = factory(User::class)->create();

      $response = $this->get('/usuarios/'.$user->id);
      $response->assertSee($user->name);
    }

    public function testCanLogin()
    {
      $user = factory(User::class)->create();

      $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'secret',
        ]);

        $this->seeIsAuthenticatedAs($user);
    }
}
