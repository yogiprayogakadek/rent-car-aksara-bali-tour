<?php

namespace App\Repositories;

use App\Models\CarModel;

class CarModelRepository
{
    public function getAll(array $fields = ['*'])
    {
        return CarModel::select($fields)->get();
    }

    public function getById(int $id)
    {
        return CarModel::findOrFail($id);
    }

    public function create(array $data): CarModel
    {
        return CarModel::create($data);
    }

    public function update(int $id, array $data)
    {
        $car = CarModel::findOrFail($id);
        $car->update($data);

        return $car;
    }

    public function delete(int $id)
    {
        $car = CarModel::findOrFail($id);
        return $car->delete();
    }
}
