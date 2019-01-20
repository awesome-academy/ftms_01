<?php
namespace App\Repositories;

abstract class EloquentRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function create(array $input)
    {
        return $this->model->create($input);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $input, $id)
    {
        $result = $this->find($id);
        if($result)
        {
            $result->update($input);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result)
        {
            $result->delete();
            return true;
        }

        return false;
    }

    public function paginate($perpage)
    {
        return $this->model->paginate($perpage);
    }

    public function where($conditions, $operator = null, $value)
    {
       return $this->model->where($conditions, $operator, $value);
    }

    public function all()
    {
        return $this->model->all();
    }
}
