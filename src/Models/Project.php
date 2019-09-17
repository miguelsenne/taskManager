<?php  

namespace miguelsenne\TaskManager\Models;
use Sinergi\Token\StringGenerator;

class Project {
	
	/**
	 * Armazenamento de projetos
	 * @var array
	 */
	public $projects = [];

	/**
	 * Store an project
	 * @param  string $name project name
	 * @return string mensagem de sucesso
	 */
	public function store(string $name)
	{
		$name = preg_replace("/[0-9\s]+$/", null, $name);
		
		return $this->projects[] = [
			"id" => $this->generateID(),
			"name" => $name
		];	
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
		$projects = $this->projects;

		$key = array_search($id, array_column($projects, 'id'));

		unset($this->projects[$key]);

		return $this->projects;
	}

	/**
	 * Find an project by ID
	 * 
	 * @param string $id the ID
	 * @return array selected project
	 */
	public function find(string $id)
	{
		$projects = $this->projects;

		$key = array_search($id, array_column($projects, 'id'));
		
		return ($key !== false) ? $projects[$key] : [];
	}

	/**
	 * Reset items in array
	 * 
	 * @return array an empty array
	 */
	public function reset()
	{
		$this->projects = [];
	}

}

?>