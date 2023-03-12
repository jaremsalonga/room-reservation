<?php

namespace App\Repository;

use App\Repository\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface {

    public $model;

    public function __construct($model) {
        $this->model = app()->make($model);
    }

    public function store(array $params) {
        return $this->model->create($params);
    }

    public function index() {
        return $this->model->all();
    }

    public function show(string $id) {
        return $this->model->findOrFail($id);
    }

    public function update(string $key, $value, array $params) {
        return $this->model->where($key, $value)->update($params);
    }

    public function destroy(string $id) {
        return $this->model->delete($id);
    }

    public function findByKeyAndValue(string $key, $value) {
        return $this->model->where($key, $value);
    }

    public function between(string $key, array $value) {
        return $this->model->whereBetween($key, $value);
    }
}