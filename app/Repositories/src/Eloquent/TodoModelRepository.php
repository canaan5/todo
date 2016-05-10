<?php
/**
 * Created by Canaan Etaigbenu
 * User: canaan5
 * Date: 5/10/16
 * Time: 1:28 AM
 */

namespace Canaan\Repo\Eloquent;


use App\Todo;
use Canaan\Repo\Contracts\TodoInterface;

class TodoModelRepository implements TodoInterface
{
    /**
     * TodoModelRepository constructor.
     * @param Todo $model
     */
    public function __construct(Todo $model)
    {
        $this->model = $model;
    }

    /**
     * Get all todo list items
     *
     * @return array
     */
    public function getAll()
    {
        return $this->model->orderBy('date', 'asc')->get();
    }

    /**
     * Get a single item with its unique id from the todo list
     *
     * @param int $id item id
     * @return array
     */
    public function get($id)
    {
        return $this->model->find($id);
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
            return $this->model->create($input);
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
            return $this->model->where('id', $id)->update($data);
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
        return $this->model->where('id', $id)->delete();
    }
}