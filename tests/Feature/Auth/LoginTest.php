<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_render_page()
    {
        $response = $this->get('/'); //arahkan ke routes login

        $response->assertStatus(200);
    }

    public function test_submit_data_success(){
        $user = user::factory()->create();

        $response = $this->post('/',[
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
    
}

