<?php

namespace miguelsenne\TaskManager\Database;

use Sinergi\Token\StringGenerator;

class Storage
{

    public static $data = [];

    /**
     * Store an data
     *
     * @param string $collection collection name to store your items
     * @param array $name data to store
     * @return array storaged data
    */
    public static function store(string $collection, array $data)
    {
        $data['id'] = self::generateID();

        return self::$data[$collection][] = $data;
    }

    /**
     * delete an item from some collection
     *
     * @param string $collection the collection
     * @param string $id the ID
     * @return array some selected collection
     */
    public static function delete(string $collection, string $id)
    {
        if (!array_key_exists($collection, self::$data)) {
            throw new \Exception("Collection not found", 1);
        }

        $items = self::$data[$collection];

        $key = array_search($id, array_column($items, 'id'));

        unset(self::$data[$collection][$key]);

        return self::$data[$collection];
    }

    /**
     * Find an item from some collection
     *
     * @param string $collection the collection
     * @param string $where the attribute to be search
     * @param string $id the value
     * @return array selected item
     */
    public static function find(string $collection, string $where, string $value)
    {
        if (!array_key_exists($collection, self::$data)) {
            throw new \Exception("Collection not found", 1);
        }

        $items = self::$data[$collection];

        $key = array_search($value, array_column($items, $where));

        return ($key !== false) ? self::$data[$collection][$key] : [];
    }

    /**
     * Generate an ID
     *
     * @return string the ID
     */
    public static function generateID()
    {
        return StringGenerator::randomId();
    }

    /**
     * Reset all data
     *
     * @return array an empty array
     */
    public static function reset()
    {
        self::$data = [];
    }

    /**
     * Find and return all items from collection
     *
     * @param string $collection the collection
     * @return array an array of collection
     */
    public static function findCollection(string $collection)
    {
        self::checkCollection($collection);
        return self::$data[$collection];
    }

    /**
     * Check if exist collection
     *
     * @param string $collection the collection
     * @return boolean if exists return true
     */
    public static function checkCollection(string $collection)
    {
        if (!array_key_exists($collection, self::$data)) {
            throw new \Exception("Collection not found", 1);
        }

        return true;
    }

    /**
     * Update an item from collection
     *
     * @param string $collection the collection
     * @param string $id the id
     * @param string $key property to be changed
     * @param mixed $value value to be changed
     */
    public static function update(string $collection, string $id, string $key, $value)
    {
        self::checkCollection($collection);

        $items = self::findCollection($collection);

        $itemKey = array_search($id, array_column($items, 'id'));

        self::$data[$collection][$itemKey][$key] = $value;

        return self::$data[$collection][$itemKey];
    }
}
