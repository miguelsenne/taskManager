Task manager
=============
This is a package to manage tasks and projects.

We stored the data in memory as a database.

Requires PHP 7.2

![Build Status](https://travis-ci.org/miguelsenne/taskManager.svg?branch=master) ![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/miguelsenne/taskManager/badges/quality-score.png?b=master) ![Packagist](https://img.shields.io/packagist/dt/miguelsenne/task-manager.svg)

Installation
------------

You can install task manager using Composer:

```
composer require miguelsenne/task-manager
```

Getting started
--------

Start by `use`-ing the class and creating an instance with id project if you need access an **project**

```php
use  \miguelsenne\TaskManager\Models\Project;  

$Project = new Project();

```

Then, register an project

```php 
$result = $Project->store('New Project');

print_r($result);

```

Remove an project using the `delete` method:

```php 
$project = new Project('5d8f83f6d1f2c9.59688033');

$result = $project->delete();

print_r($result);

```

Find an project using the `find` method:

```php 
$project = new Project('5d8f83f6d1f2c9.59688033');

$result = $project->find();

print_r($result);

```

Clear all projects using the `reset` method:

```php 
$project = new Project;

$result = $project->reset();

print_r($result);

```

Tasks
--------

Start by `use`-ing the class and creating an instance with an project id

```php 
use miguelsenne\TaskManager\Models\Task;

$task = new Task('5d8f83f6d1f2c9.59688033');

```

Then, register an task

```php 
$result = $task->store('New Task');

print_r($result);

```

Change progress of the task. The task, when created, starts with **to do** progress

```php 
$result = $task->changeProgress();

print_r($result);

```
