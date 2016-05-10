<?php
/**
 * Created by Canaan Etaigbenu
 * User: canaan5
 * Date: 5/10/16
 * Time: 1:13 AM
 */

namespace Canaan\Repo\Contracts;


interface TodoInterface
{
    /**
     * Get all todo list items
     *
     * @return array
     */
    public function getAll();

    /**
     * Get a single item with its unique id from the todo list
     *
     * @param int $id item id
     * @return array
     */
    public function get($id);

    /**
     * Add a new item to the todo list
     *
     * @param array $input new todo list item data
     * @return boolean
     */
    public function create(array $input = []);

    /**
     * update an item in the list
     *
     * @param int $id
     * @return boolean
     */
    public function update($id);

    /**
     * Delete and item from the list
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id);
}