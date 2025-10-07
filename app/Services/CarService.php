<?php

namespace App\Services;

use App\Repositories\CarRepository;

class CarService
{
    protected $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getAllCars()
    {
        return $this->carRepository->getAll();
    }

    public function getCarById($id)
    {
        return $this->carRepository->getById($id);
    }

    public function createCar(array $data)
    {
        return $this->carRepository->create($data);
    }

    public function updateCar($id, array $data)
    {
        return $this->carRepository->update($id, $data);
    }

    public function deleteCar($id)
    {
        return $this->carRepository->delete($id);
    }
}
