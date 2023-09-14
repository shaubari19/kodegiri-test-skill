@extends('layouts.app')

@section('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {!! Form::model($data, ['method' => 'PATCH', 'route' => ['documents.update', $data->id], 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '', 'enctype' => 'multipart/form-data']) !!}
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Dokumen</h4>
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
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Title" value="{{ $data->title }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="content">Konten</label>
                                <textarea class="form-control" id="content" name="content" placeholder="Konten" style="min-height: 200px;">{!! $data->content !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="signing">Singing</label>
                                <input type="file" name="signing" id="signing" class="dropify" data-height="200" accept="image/*" data-allowed-file-extensions="png" data-default-file="{{ $data->signing_url }}">
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('documents.index') }}" class="btn btn-secondary">Kembali</a>
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