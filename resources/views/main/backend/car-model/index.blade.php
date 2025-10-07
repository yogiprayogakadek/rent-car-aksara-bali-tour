@extends('templates.backend.master')

@section('page-title', 'Car Model Management')
@section('page-link', route('admin.car-models.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
    @if (session('success'))
        <script>
            toastr.success(
                "{{ session('success') }}",
                "Success", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    timeOut: 2000
                }
            );
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Car Name</th>
                                    <th>Car Type</th>
                                    <th>Car Brand</th>
                                    <th>Car Rent Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carModels as $carModel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $carModel->car_name }}</td>
                                        <td>{{ $carModel->car_type }}</td>
                                        <td>{{ $carModel->car_brand }}</td>
                                        <td>{{ 'Rp.' . number_format($carModel->car_price, 0, '.', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.car-models.edit', $carModel->id) }}">
                                                <button type="button"
                                                    class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary d-flex align-items-center">
                                                    <i class="ti ti-pencil fs-4 me-2"></i>
                                                    Edit
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
