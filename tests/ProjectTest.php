<?php

namespace miguelsenne\Tests;

use PHPUnit\Framework\TestCase;
use miguelsenne\TaskManager\Models\Project;
use miguelsenne\TaskManager\Database\Storage;

class ProjectTest extends TestCase
{

    protected $project;

    public function setUp(): void
    {
        $this->project = new Project;

        $this->project->store('Estudos de PHPUnit');
    }

    public function tearDown(): void
    {
        $this->project->reset();
    }

    public function testProjectStoreItem()
    {
        $this->project->reset();

        $this->project->store('Estudos de PHP');

        $projects = Storage::$data['projects'];

        $this->assertCount(1, $projects);
    }

    public function testProjectStoreOnlyWords()
    {
        $project = $this->project->store('Estudos de PHP 7');

        $this->assertEquals('Estudos de PHP', $project['name']);
    }

    public function testProjectStoreGenerateNewIdOnStore()
    {
        $project = $this->project->store('Estudos de PHP');

        $this->assertArrayHasKey('id', $project);
    }

    public function testProjectDelete()
    {
        $this->project->reset();

        $project = $this->project->store('Estudos de PHP');

        $projects = $this->project->delete($project['id']);

        $this->assertCount(0, $projects);
    }

    public function testFindAnProject()
    {
        $project = $this->project->store('Lista de tarefas');

        $project = $this->project->find($project['id']);

        $this->assertEquals('Lista de tarefas', $project['name']);
    }
}
