<?php  

namespace miguelsenne\TaskManager\Models;
use Sinergi\Token\StringGenerator;

class Project {

	/**
	 * ID
	 * @var string
	 */
	public $id;

	/**
	 * Project name
	 * @var string
	 */
	public $name;

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
		
		$this->projects[] = [
			"id" => $this->generateID(),
			"name" => $name
		];

		return "Adicionado com sucesso";
		
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
}

?>