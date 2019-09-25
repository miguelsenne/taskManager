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
            'status' => 'To do'
        ]);
    }

    /**
     * Change task status
     *
     * @param string $id the id
     * @return array the task with status changed
     */
    public function changeProgress(string $id)
    {
        $task = Storage::find('tasks', 'id', $id);

        switch ($task['status']) {
            case 'To do':
                $progress = 'In progress';
                break;
            case 'In progress':
                $progress = 'Awaiting';
                break;
            case 'Awaiting':
                $progress = 'Done';
                break;
            default:
                $progress = 'To do';
                break;
        }

        return Storage::update('tasks', $id, 'status', $progress);
    }
}
