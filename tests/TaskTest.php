<?php

namespace miguelsenne\Tests;

use PHPUnit\Framework\TestCase;
use miguelsenne\TaskManager\Database\Storage;
use miguelsenne\TaskManager\Models\Task;
use miguelsenne\TaskManager\Models\Project;
use Faker\Factory;

class TaskTest extends TestCase
{
    private $task;
    private $project;

    public function setUp(): void
    {
        $this->project = new Project;
        $faker = Factory::create();
        Storage::reset();
        $project = $this->project->store($faker->word());
        $this->task = new Task($project['id']);
    }

    public function testIfTaskIsStored()
    {
        $faker = Factory::create();
        $task = $this->task->store($faker->word());
        $this->assertCount(1, Storage::findCollection('tasks'));
    }

    public function testIfStatusIsChanged()
    {
        $faker = Factory::create();

        $task = $this->task->store($faker->word());

        $status = [
            "In progress",
            "Awaiting",
            "Done",
            "To do"
        ];

        for ($i = 0; $i <= 3; $i++) {
            $task = $this->task->changeProgress($task['id']);
            $this->assertEquals($status[$i], $task['status']);
        }
    }
}
