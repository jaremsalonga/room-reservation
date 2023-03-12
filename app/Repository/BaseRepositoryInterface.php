<?php

namespace App\Repository;

interface BaseRepositoryInterface {

    public function store(array $params); 

    public function index();

    public function show(string $id);

    public function update(string $key, $value, array $params);

    public function destroy(string $id);

    public function findByKeyAndValue(string $key, $value);

    public function between(string $key, array $value);
}