<?php

namespace miguelsenne\TaskManager\Models;

use Sinergi\Token\StringGenerator;
use miguelsenne\TaskManager\Database\Storage;

class Project
{
    /**
     * Store an project
     * @param  string $name project name
     * @return string mensagem de sucesso
     */
    public function store(string $name)
    {
        $name = preg_replace("/[0-9\s]+$/", null, $name);

        return Storage::store('projects', [
            "name" => $name
        ]);
    }

    /**
     * Generate an ID
     *
     * @return string the ID
     */
    public function generateID()
    {
        return StringGenerator::randomId();
    }

    /**
     * delete an item from projects
     *
     * @param string $id the ID
     * @return array projects
     */
    public function delete(string $id)
    {
        Storage::delete('projects', $id);

        return Storage::$data['projects'];
    }

    /**
     * Find an project by ID
     *
     * @param string $id the ID
     * @return array selected project
     */
    public function find(string $id)
    {
        return Storage::find('projects', 'id', $id);
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
