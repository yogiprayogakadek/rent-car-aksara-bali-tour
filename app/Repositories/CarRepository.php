<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository
{

    public function getAll(array $fields = ['*'])
    {
        return Car::select($fields)->get();
    }

    public function getById(int $id, array $fields = ['*'])
    {
        return Car::select($fields)->where('id', $id)->first();
    }

    public function create(array $data)
    {
        return Car::create($data);
    }

    public function update(int $id, array $data)
    {
        $car = Car::findOrFail($id);
        $car->update($data);

        return $car;
    }

    public function delete(int $id)
    {
        $car = Car::findOrFail($id);
        return $car->delete();
    }
}
