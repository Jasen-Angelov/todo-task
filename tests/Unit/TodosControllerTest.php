<?php

namespace Tests\Unit;

use App\Enums\StatusCodesEnum;
use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodosControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_all_todos()
    {
        Todo::factory()->count(3)->create();

        $response = $this->getJson('/api/todos');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json()['data']);
    }

    /** @test */
    public function it_should_return_bad_request_for_create()
    {
        $response = $this->getJson('/api/todos/create');

        $response->assertJson([
            'success' => 0,
            'statusCode' => StatusCodesEnum::METHOD_NOT_ALLOWED->value,
            'message' => 'Resource forbidden',
            'data' => null
        ]);
    }

    /** @test */
    public function it_should_store_a_new_todo()
    {
        $todoData = [
            'description' => 'Test description',
        ];

        $response = $this->postJson('/api/todos', $todoData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('todos', $todoData);
    }

    /** @test */
    public function it_should_return_bad_request_for_show()
    {
        $response = $this->getJson('/api/todos/1');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => 0,
            'statusCode' => StatusCodesEnum::METHOD_NOT_ALLOWED->value,
            'message' => 'Resource forbidden',
            'data' => null
        ]);
    }

    /** @test */
    public function it_should_return_bad_request_for_edit()
    {
        $response = $this->getJson('/api/todos/1/edit');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => 0,
            'statusCode' => StatusCodesEnum::METHOD_NOT_ALLOWED->value,
            'message' => 'Resource forbidden',
            'data' => null
        ]);
    }

    /** @test */
    public function it_should_return_bad_request_for_update()
    {
        $response = $this->putJson('/api/todos/1');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => 0,
            'statusCode' => StatusCodesEnum::METHOD_NOT_ALLOWED->value,
            'message' => 'Resource forbidden',
            'data' => null
        ]);
    }

    /** @test */
    public function it_should_delete_a_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->deleteJson("/api/todos/{$todo->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => 1,
            'statusCode' => StatusCodesEnum::ACCEPTED->value,
            'message' => 'Todo has been deleted',
            'data' => null
        ]);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }

    /** @test */
    public function it_should_return_bad_request_for_invalid_delete()
    {
        $response = $this->deleteJson("/api/todos/999");
        $response->assertStatus(200);
        $response->assertJson([
            'success' => 0,
            'statusCode' => StatusCodesEnum::UNPROCESSABLE->value,
            'message' => json_encode(['id' => ['The selected id is invalid.']]),
            'data' => null
        ]);
    }
}
