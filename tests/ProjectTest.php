<?php  

namespace miguelsenne\Tests;

use PHPUnit\Framework\TestCase;
use miguelsenne\TaskManager\Models\Project;

class ProjectTest extends TestCase
{

	protected static $project;

	public function setUp(): void
	{
		$this->project = new Project;
	}
	
}

?>