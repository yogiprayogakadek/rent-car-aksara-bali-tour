<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\CarModelService;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    protected $carModelService;

    public function __construct(CarModelService $carModelService)
    {
        $this->carModelService = $carModelService;
    }

    public function index()
    {
        $fields = ['id', 'car_name', 'car_type', 'car_brand', 'car_price'];

        $carModels = $this->carModelService->getAllCarModels($fields);
        return view('main.backend.car-model.index', compact('carModels'));
    }

    public function create()
    {
        $carTypes = $this->carModelService->carTypes();
        $carBrands = $this->carModelService->carBrands();
        return view('main.backend.car-model.create', compact('carTypes', 'carBrands'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'car_price' => preg_replace('/[^0-9]/', '', $request->car_price)
        ]);

        $data = $request->validate([
            'car_name'        => 'required|string|max:255',
            'car_type'        => 'required|string|max:255',
            'car_brand'       => 'required|string|max:255',
            'car_price'       => 'required|numeric|min:0',
            'other_car_type'  => 'nullable|required_if:car_type,other|string|max:255',
            'other_car_brand' => 'nullable|required_if:car_brand,other|string|max:255',
            'car_description' => 'nullable|string',
        ], [
            'car_name.required'         => 'Car name is required.',
            'car_name.string'           => 'Car name must be a valid text.',
            'car_name.max'              => 'Car name cannot exceed 255 characters.',

            'car_type.required'         => 'Car type is required.',
            'car_type.string'           => 'Car type must be a valid text.',

            'car_brand.required'        => 'Car brand is required.',
            'car_brand.string'          => 'Car brand must be a valid text.',

            'car_price.required'        => 'Car price is required.',
            'car_price.numeric'         => 'Car price must be a number.',
            'car_price.min'             => 'Car price must be at least 0.',

            'other_car_type.required_if' => 'Other car type is required when car type is set to "Other".',
            'other_car_type.string'     => 'Other car type must be a valid text.',

            'other_car_brand.required_if' => 'Other car brand is required when car brand is set to "Other".',
            'other_car_brand.string'    => 'Other car brand must be a valid text.',

            'car_description.string'           => 'Car description must be a valid text.',
        ]);

        // Replace dengan "other" value kalau dipilih
        if ($data['car_type'] === 'other') {
            $data['car_type'] = $data['other_car_type'];
        }
        if ($data['car_brand'] === 'other') {
            $data['car_brand'] = $data['other_car_brand'];
        }

        // Hapus field tambahan biar tidak error di mass assignment
        unset($data['other_car_type'], $data['other_car_brand']);

        $this->carModelService->createCarModel($data);
        return redirect()->route('admin.car-models.index')->with('success', 'Car model created successfully.');
    }

    public function edit($id)
    {
        $carModel = $this->carModelService->getCarModelById($id);
        $carTypes = $this->carModelService->carTypes();
        $carBrands = $this->carModelService->carBrands();

        return view('main.backend.car-model.edit', compact('carModel', 'carTypes', 'carBrands'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'car_price' => preg_replace('/[^0-9]/', '', $request->car_price)
        ]);

        $data = $request->validate([
            'car_name'        => 'required|string|max:255',
            'car_type'        => 'required|string|max:255',
            'car_brand'       => 'required|string|max:255',
            'car_price'       => 'required|numeric|min:0',
            'other_car_type'  => 'nullable|required_if:car_type,other|string|max:255',
            'other_car_brand' => 'nullable|required_if:car_brand,other|string|max:255',
            'car_description' => 'nullable|string',
        ], [
            'car_name.required'         => 'Car name is required.',
            'car_name.string'           => 'Car name must be a valid text.',
            'car_name.max'              => 'Car name cannot exceed 255 characters.',

            'car_type.required'         => 'Car type is required.',
            'car_type.string'           => 'Car type must be a valid text.',

            'car_brand.required'        => 'Car brand is required.',
            'car_brand.string'          => 'Car brand must be a valid text.',

            'car_price.required'        => 'Car price is required.',
            'car_price.numeric'         => 'Car price must be a number.',
            'car_price.min'             => 'Car price must be at least 0.',

            'other_car_type.required_if' => 'Other car type is required when car type is set to "Other".',
            'other_car_type.string'     => 'Other car type must be a valid text.',

            'other_car_brand.required_if' => 'Other car brand is required when car brand is set to "Other".',
            'other_car_brand.string'    => 'Other car brand must be a valid text.',

            'car_description.string'           => 'Car description must be a valid text.',
        ]);

        // Replace dengan "other" value kalau dipilih
        if ($data['car_type'] === 'other') {
            $data['car_type'] = $data['other_car_type'];
        }
        if ($data['car_brand'] === 'other') {
            $data['car_brand'] = $data['other_car_brand'];
        }

        // Hapus field tambahan biar tidak error di mass assignment
        unset($data['other_car_type'], $data['other_car_brand']);

        $this->carModelService->updateCarModel($id, $data);
        return redirect()->route('admin.car-models.index')->with('success', 'Car model updated successfully.');
    }

    public function delete($id)
    {
        $this->carModelService->deleteCarModel($id);
        return redirect()->route('admin.car-models.index')->with('success', 'Car model deleted successfully.');
    }
}
