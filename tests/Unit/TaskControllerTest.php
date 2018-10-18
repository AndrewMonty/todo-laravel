<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Task;
use Illuminate\Support\Carbon;

class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory(Task::class, 23)->create();

        $this->getJson('/api/tasks')
            ->assertSuccessful()
            ->assertJson([
                'total' => 23
            ]);
    }

    public function testStore()
    {
        $input = [
            'name' => 'Buy Miley\'s latest album'
        ];

        $this->postJson('/api/tasks', $input)
            ->assertSuccessful()
            ->assertJson($input)
            ->assertJsonStructure([
                'id', 'name', 'completed_at', 'created_at', 'updated_at'
            ]);
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create();

        $input = [
            'complete' => true
        ];

        $now = now();
        Carbon::setTestNow($now);

        $this->patchJson("/api/tasks/$task->id", $input)
            ->assertSuccessful()
            ->assertJson([
                'completed_at' => $now->toDateTimeString()
            ]);
    }

    public function testDelete()
    {
        $task = factory(Task::class)->create();

        $response = $this->deleteJson("/api/tasks/$task->id")
            ->assertStatus(204);
        
        $this->assertEmpty($response->getContent());
    }
}
