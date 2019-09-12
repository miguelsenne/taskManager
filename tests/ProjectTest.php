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

	public function dataProviderAttributtes()
	{
		return [
			["id"],
			["name"]
		];
	}
	
	/**
	 * Test project attributes is empty by default
	 *
	 * @dataProvider dataProviderAttributtes
	 * 
	 * @return void
	 */
	public function testProjectAttributesIsEmptyByDefault($name)
	{

		$this->assertEquals('', $this->project->$name);

	}
	
}

?>