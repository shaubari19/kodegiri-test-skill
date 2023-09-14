@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
                </div>
            </div>

            <div class="row g-4 py-5 row-cols-1 row-cols-lg-2">
                <div class="feature col">
                    <div class="card">
                        <div class="card-body">
                            <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                                <i class="text-primary fas fa-circle-user"></i>
                            </div>
                            <h4 class="fs-2 text-body-emphasis">Update Profile</h4>
                            
                            <a href="{{ route('users.detail', Auth::user()->id) }}" class="btn btn-outline-primary mr-5"><i class="fas fa-circle-info"></i> Detail</a>
                            <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-outline-info ml-3"><i class="fas fa-pen-to-square"></i> Edit</a>
                        </div>
                    </div>
                </div>

                <div class="feature col">
                    <div class="card">
                        <div class="card-body">
                            <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                                <i class="text-primary fas fa-file"></i>
                            </div>
                            <h4 class="fs-2 text-body-emphasis">Document Management</h4>
                            
                            <a href="{{ route('documents.index') }}" class="btn btn-outline-primary mr-5"><i class="fas fa-circle-info"></i> Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">

        $(function() {
            @if ($message = Session::get('success'))
                swal({
                    title: "{{ $message }}",
                    icon: "success",
                });
            @endif
        })
    </script>
@endsection
