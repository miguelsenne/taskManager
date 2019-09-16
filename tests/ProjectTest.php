<?php  

namespace miguelsenne\Tests;

use PHPUnit\Framework\TestCase;
use miguelsenne\TaskManager\Models\Project;

class ProjectTest extends TestCase
{

	protected $project;

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

	public function testProjectStoreItem()
	{

		$this->project->store('Estudos de PHP');
		
		$this->assertCount(1, $this->project->projects);
	
	}

	public function testProjectStoreOnlyWords()
	{

		$this->project->store('Estudos de PHP 7');

		$this->assertEquals('Estudos de PHP', $this->project->projects[0]['name']);

	}

	public function testProjectStoreGenerateNewIdOnStore()
	{
		$this->project->store('Estudos de PHP');
		$this->assertArrayHasKey('id', $this->project->projects[0]);
	}

	public function testProjectDelete()
	{
		$project = $this->project->store('Estudos de PHP');
		$projects = $this->project->delete($project['id']);

		$this->assertCount(0, $projects);
	}
	
}

?>