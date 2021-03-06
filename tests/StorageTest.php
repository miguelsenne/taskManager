<?php

namespace miguelsenne\Tests;

use PHPUnit\Framework\TestCase;
use miguelsenne\TaskManager\Database\Storage;
use Faker\Factory;

class StorageTest extends TestCase
{

    public function setUp(): void
    {
        Storage::reset();
    }

    public function testIfDataIsEmpty()
    {
        $this->assertCount(0, Storage::$data);
    }

    public function testIfItemHasBeenStored()
    {
        $item = Storage::store('foo', ['bar' => 'foo']);

        $this->assertEquals('foo', $item['bar']);

        $this->assertCount(1, Storage::$data['foo']);
    }

    public function testIfHasBeenStoredMultipleItems()
    {
        for ($i = 0; $i < 4; $i++) {
            Storage::store('foo', ['bar' => 'foo']);
        }

        $this->assertCount(4, Storage::$data['foo']);
    }

    public function testIfHasBeenNotStoredWithAnyParamters()
    {
        $this->expectException("ArgumentCountError");

        Storage::store();
    }

    public function testIfNotFoundAnCollectionWhenOnDelete()
    {
        $this->expectException('Exception');

        $this->expectExceptionMessage('Collection not found');

        Storage::delete('bar', Storage::generateID());
    }

    public function testIfItemHasBeenDeleted()
    {
        for ($i = 0; $i < 10; $i++) {
            $item = Storage::store('foo', ['bar' => 'foo']);
        }

        Storage::delete('foo', $item['id']);

        $this->assertCount(9, Storage::$data['foo']);
    }

    public function testIfHasBeenFounded()
    {
        $faker = Factory::create();

        Storage::store('persons', ['name' => 'Miguel Senne']);

        for ($i = 0; $i < 10; $i++) {
            $item = Storage::store('persons', ['name' => $faker->name]);
        }

        $search = Storage::find('persons', 'name', 'Miguel Senne');

        $this->assertArraySubset(['name' => 'Miguel Senne'], $search);

        $find_item = Storage::find('persons', 'name', $item['name']);

        $this->assertArraySubset(['name' => $item['name']], $find_item);
    }

    public function testSeeAnEmptyArrayWhenNotFound()
    {
        Storage::store('persons', ['bar' => 'foo']);

        $search = Storage::find('persons', 'name', 'miguel');

        $this->assertEmpty($search);
    }

    public function testIfNotFoundAnCollectionWhenOnFind()
    {
        $this->expectException('Exception');

        $this->expectExceptionMessage('Collection not found');

        Storage::find('bar', 'name', 'John Doe');
    }

    public function testIfGenerateIdIsUniq()
    {
        for ($i = 0; $i < 100; $i++) {
            $hash[] = Storage::generateID();
        }

        $this->assertEquals(1, array_count_values($hash)[$hash[10]]);
        $this->assertEquals(1, array_count_values($hash)[$hash[20]]);
        $this->assertEquals(1, array_count_values($hash)[$hash[5]]);
    }

    public function testIfDataReturnAnEmptyArrayOnReset()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Storage::store('items', ['name' => $faker->name]);
        }

        Storage::reset();

        $this->assertIsArray(Storage::$data);
        $this->assertEmpty(Storage::$data);
    }

    public function testIfReturnAnCollection()
    {
        Storage::store('collections', ['name' => 'John Doe']);
        $collection = Storage::findCollection('collections');
        $this->assertCount(1, $collection);
    }

    public function testReturnAnExceptionIfTheCollectionNotExists()
    {
        $this->expectException('Exception');

        $this->expectExceptionMessage('Collection not found');

        Storage::findCollection('collections');
    }

    public function testIfCollectionDoenstExistReturnsException()
    {
        $this->expectException('Exception');

        $this->expectExceptionMessage('Collection not found');

        Storage::checkCollection('collections');
    }

    public function testCollectionExistAndReturnTrue()
    {
        Storage::store('collections', ['name' => 'John Doe']);

        $check_collection = Storage::checkCollection('collections');

        $this->assertTrue($check_collection);
    }

    public function testIfReturnsExceptionWhenDoesntExistCollection()
    {
        $faker = Factory::create();

        $this->expectException('Exception');

        Storage::update('collection', $faker->uuid(), $faker->word(), $faker->word());
    }

    public function testIfDataIsUpdated()
    {
        $item = Storage::store('items', ['name' => 'Miguel Senne']);

        $this->assertEquals('Miguel Senne', $item['name']);

        $item = Storage::update('items', $item['id'], 'name', 'Miguel');

        $this->assertEquals('Miguel', $item['name']);
    }

    public function testIfUpdateAddNewKeyWhenUpdated()
    {
        $item = Storage::store('items', ['name' => 'Miguel Senne']);

        $this->assertEquals('Miguel Senne', $item['name']);

        $item = Storage::update('items', $item['id'], 'age', 25);

        $this->assertEquals(25, $item['age']);
    }
}
