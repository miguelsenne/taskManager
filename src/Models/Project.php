<?php

namespace miguelsenne\TaskManager\Models;

use Sinergi\Token\StringGenerator;
use miguelsenne\TaskManager\Database\Storage;

class Project
{

    public $id;

    public function __construct($projectid = '')
    {
        $this->id = $projectid;
    }

    public function getProject()
    {
        return Storage::find('projects', 'id', $this->id);
    }

    /**
     * Get project id
     *
     * @return string the id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set project id
     *
     * @param string $id the id
     * @return string $id the id
     */
    public function setId(string $id)
    {
        return $this->id = $id;
    }

    /**
     * Store an project
     * @param  string $name project name
     * @return string mensagem de sucesso
     */
    public function store(string $name)
    {
        $name = preg_replace("/[0-9\s]+$/", null, $name);

        $project = Storage::store('projects', [
            "name" => $name
        ]);

        $this->id = $project['id'];

        return $project;
    }

    /**
     * delete an item from projects
     *
     * @param string $id the ID
     * @return array projects
     */
    public function delete()
    {
        Storage::delete('projects', $this->id);

        return Storage::$data['projects'];
    }

    /**
     * Find an project by ID
     *
     * @param string $id the ID
     * @return array selected project
     */
    public function find()
    {
        return Storage::find('projects', 'id', $this->id);
    }

    /**
     * Reset items in array
     *
     * @return array an empty array
     */
    public function reset()
    {
        Storage::$data['projects'] = [];
    }
}
