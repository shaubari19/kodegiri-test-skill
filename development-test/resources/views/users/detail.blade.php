@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h4>Detail User</h4>
                </div>
                <div class="card-body">

                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ $data->name }}" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ $data->phone }}" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company" class="form-control" value="{{ $data->company }}" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="division">Division</label>
                        <input type="text" id="division" name="division" class="form-control" value="{{ $data->division }}" readonly>
                    </div>

                    @if($data->image != null)
                        <img src="{{ $data->image_url }}" class="img-thumbnail img-fluid fluid mb-2 w-100">
                    @endif

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('users.edit', $data->id) }}" class="btn btn-primary">Edit Data</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection