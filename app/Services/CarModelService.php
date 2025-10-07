<?php

namespace App\Services;

use App\Repositories\CarModelRepository;
use InvalidArgumentException;

class CarModelService
{
    protected CarModelRepository $carModelRepository;

    public function __construct(CarModelRepository $carRepository)
    {
        $this->carModelRepository = $carRepository;
    }

    public function getAllCarModels(array $fields = ['*'])
    {
        return $this->carModelRepository->getAll($fields);
    }

    public function getCarModelById(int $id)
    {
        return $this->carModelRepository->getById($id);
    }

    public function createCarModel(array $data)
    {
        // if (isset($data['car_price']) && $data['car_price'] < 0) {
        //     throw new InvalidArgumentException("Car price cannot be negative");
        // }

        return $this->carModelRepository->create($data);
    }

    public function updateCarModel(int $id, array $data)
    {
        if (isset($data['car_price']) && $data['car_price'] < 0) {
            throw new InvalidArgumentException("Car price cannot be negative");
        }

        return $this->carModelRepository->update($id, $data);
    }

    public function deleteCarModel(int $id): bool
    {
        // bisa tambahin aturan bisnis, misal cek status mobil dulu
        return $this->carModelRepository->delete($id);
    }

    public static function carTypes()
    {
        $carTypes = [
            'city_car'     => 'City Car',
            'hatchback'    => 'Hatchback',
            'sedan'        => 'Sedan',
            'mpv'          => 'MPV',
            'suv'          => 'SUV',
            'crossover'    => 'Crossover',
            'van'          => 'Van / Minibus',
            'pickup'       => 'Pickup',
            'double_cabin' => 'Double Cabin',
            'luxury'       => 'Luxury',
            'convertible'  => 'Convertible',
            'bus'          => 'Bus / Medium Bus',
        ];

        return $carTypes;
    }

    public static function carBrands(): array
    {
        return [
            'toyota'        => 'Toyota',
            'honda'         => 'Honda',
            'suzuki'        => 'Suzuki',
            'daihatsu'      => 'Daihatsu',
            'mitsubishi'    => 'Mitsubishi',
            'nissan'        => 'Nissan',
            'hyundai'       => 'Hyundai',
            'kia'           => 'Kia',
            'mazda'         => 'Mazda',
            'isuzu'         => 'Isuzu',
            'ford'          => 'Ford',
            'chevrolet'     => 'Chevrolet',
            'mercedes_benz' => 'Mercedes-Benz',
            'bmw'           => 'BMW',
            'audi'          => 'Audi',
            'volkswagen'    => 'Volkswagen',
            'peugeot'       => 'Peugeot',
            'lexus'         => 'Lexus',
            'wuling'        => 'Wuling',
            'dfsk'          => 'DFSK',
        ];
    }
}
