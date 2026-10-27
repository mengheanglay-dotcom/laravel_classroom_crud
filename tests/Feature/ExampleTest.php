<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Teacher;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_student_directory_returns_a_successful_response(): void
    {
        $this->get('/students')->assertOk();
    }

    public function test_teacher_directory_returns_a_successful_response(): void
    {
        $this->get('/teachers')->assertOk();
    }

    public function test_teacher_create_page_returns_a_successful_response(): void
    {
        $this->get('/teachers/create')->assertOk();
    }

    public function test_teacher_can_be_created_without_a_profile_photo(): void
    {
        $response = $this->post('/teachers', [
            'name' => 'Jane Doe',
            'gender' => 'female',
            'email' => 'jane@example.com',
            'phone' => '0123456789',
        ]);

        $response->assertRedirect('/teachers');
        $this->assertDatabaseHas('teachers', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
    }
}
