<?php

namespace miguelsenne\TaskManager\Models;

use miguelsenne\TaskManager\Models\Project;
use miguelsenne\TaskManager\Database\Storage;

class Task
{
    public $project;

    public function __construct($projectId)
    {
        $this->project = new Project($projectId);
    }

    /**
     * Store an task
     *
     * @param string $name the name of task
     * @return array the task stored
     */
    public function store(string $name)
    {
        return Storage::store('tasks', [
            'projectId' => $this->project->getProject()['id'],
            'name' => $name,
            'status' => 'In progress'
        ]);
    }
}
