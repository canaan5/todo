<?php
namespace Canaan\Persistance;

use Canaan\Contracts\TodoInterface;


class TodoModelRepository implements TodoInterface
{
    /**
     * TodoModelRepository constructor.
     */
    public function __construct()
    {
        // Concrete injection of Authenticated user instance through the constructor
        $this->model = \Auth::user();
    }

    /**
     * Get all todo list items
     *
     * @return array
     */
    public function getAll()
    {
        return $this->model->todo()->orderBy('date', 'asc')->get();
    }

    /**
     * Get a single item with its unique id from the todo list
     *
     * @param int $id item id
     * @return array
     */
    public function get($id)
    {
        return $this->model->todo()->find($id);
    }

    /**
     * Add a new item to the todo list
     *
     * @param array $input new todo list item data
     * @return boolean
     */
    public function create(array $input = [])
    {
        if(sizeof($input) > 0) {
            return $this->model->todo()->create($input);
        }
    }

    /**
     * update an item in the list
     *
     * @param int $id
     * @return boolean
     */
    public function update($id, array $data = [])
    {
        if (sizeof($data) > 0) {
            return $this->model->todo()->where('id', $id)->update($data);
        }
    }

    /**
     * Delete and item from the list
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->todo()->where('id', $id)->delete();
    }
}