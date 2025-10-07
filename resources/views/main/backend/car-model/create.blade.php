@extends('templates.backend.master')

@section('page-title', 'Create Car Model')
@section('page-link', route('admin.car-models.create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.car-models.store') }}" method="POST">
                        @csrf
                        {{-- Car Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="carName" class="form-label col-sm-3 col-form-label">Car Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('car_name') is-invalid @enderror"
                                    id="carName" name="car_name" placeholder="Enter car name"
                                    value="{{ old('car_name') }}">
                                @error('car_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Car Type --}}
                        <div class="mb-4 row align-items-center">
                            <label for="carType" class="form-label col-sm-3 col-form-label">Car Type</label>
                            <div class="col-sm-12">
                                <select name="car_type" id="carType"
                                    class="form-select @error('car_type') is-invalid @enderror">
                                    <option value="">Choose car type...</option>
                                    @foreach ($carTypes as $key => $value)
                                        <option value="{{ $key }}" {{ old('car_type') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                    <option value="other" {{ old('car_type') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('car_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 mt-2" id="otherCarTypeWrapper">
                                <input type="text" class="form-control @error('other_car_type') is-invalid @enderror"
                                    id="otherCarType" name="other_car_type" placeholder="Enter car type"
                                    value="{{ old('other_car_type') }}">
                                @error('other_car_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Car Brand --}}
                        <div class="mb-4 row align-items-center">
                            <label for="carBrand" class="form-label col-sm-3 col-form-label">Car Brand</label>
                            <div class="col-sm-12">
                                <select name="car_brand" id="carBrand"
                                    class="form-select @error('car_brand') is-invalid @enderror">
                                    <option value="">Choose car brand...</option>
                                    @foreach ($carBrands as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('car_brand') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                    <option value="other" {{ old('car_brand') == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('car_brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 mt-2" id="otherCarBrandWrapper">
                                <input type="text" class="form-control @error('other_car_brand') is-invalid @enderror"
                                    id="otherCarBrand" name="other_car_brand" placeholder="Enter car brand"
                                    value="{{ old('other_car_brand') }}">
                                @error('other_car_brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Car Price --}}
                        <div class="mb-4 row align-items-center">
                            <label for="carPrice" class="form-label col-sm-3 col-form-label">Car Price</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('car_price') is-invalid @enderror"
                                    id="carPrice" name="car_price" placeholder="Enter rent car price"
                                    value="{{ old('car_price') }}">
                                @error('car_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Car Description --}}
                        <div class="mb-4 row align-items-center">
                            <label for="carDescription" class="form-label col-sm-3 col-form-label">Car Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control @error('car_description') is-invalid @enderror" id="carDescription" rows="5"
                                    name="car_description" placeholder="Enter car description">{{ old('car_description') }}</textarea>
                                @error('car_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary hstack gap-6 float-right">
                                <i class="ti ti-send fs-4"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#otherCarTypeWrapper').hide();
            $('#otherCarBrandWrapper').hide();

            $('#carType').change(function() {
                if ($(this).val() === 'other') {
                    $('#otherCarTypeWrapper').show();
                } else {
                    $('#otherCarTypeWrapper').hide();
                    $('#otherCarType').val('');
                }
            });

            $('#carBrand').change(function() {
                if ($(this).val() === 'other') {
                    $('#otherCarBrandWrapper').show();
                } else {
                    $('#otherCarBrandWrapper').hide();
                    $('#otherCarBrand').val('');
                }
            });

            $('#carPrice').on('keyup', function() {
                let value = $(this).val();
                value = value.replace(/[^,\d]/g, '').toString();
                let split = value.split(',');
                let remainder = split[0].length % 3;
                let rupiah = split[0].substr(0, remainder);
                let thousands = split[0].substr(remainder).match(/\d{3}/gi);

                if (thousands) {
                    let separator = remainder ? '.' : '';
                    rupiah += separator + thousands.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                $(this).val(rupiah ? 'Rp. ' + rupiah : '');
            })
        });
    </script>
@endpush
