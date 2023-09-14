@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {!! Form::model($data, ['method' => 'PATCH', 'route' => ['users.update', $data->id], 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '', 'enctype' => 'multipart/form-data']) !!}
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="card-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}" placeholder="Name" autocomplete="off" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" value="{{ $data->email }}" placeholder="Email" autocomplete="off" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ $data->phone }}" placeholder="Phone Number" autocomplete="off" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="company">Company</label>
                                <input type="text" id="company" name="company" class="form-control" value="{{ $data->company }}" placeholder="Company" autocomplete="off">
                            </div>

                            <div class="form-group mb-2">
                                <label for="division">Division</label>
                                <input type="text" id="division" name="division" class="form-control" value="{{ $data->division }}" placeholder="Division" autocomplete="off">
                            </div>

                            <div class="form-group mb-2">
                                <label for="image">Photo Profile</label>
                                <input type="file" name="image" id="image" class="dropify" data-height="200" accept="image/*" data-allowed-file-extensions="png" data-default-file="{{ $data->image_url }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Confirm Password" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">

        $(function() {

            $('.dropify').dropify();
        });
    </script>
@endsection