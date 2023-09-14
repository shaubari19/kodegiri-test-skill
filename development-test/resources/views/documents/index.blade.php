@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Document Management</h4>
    
                        <div class="card-header-action">
                            <a href="{{ route('home') }}" class="btn btn-sm btn-secondary">Kembali</a>

                            <a href="{{ route('documents.create') }}" class="btn btn-sm btn-primary">Tambah Dokumen</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="mt-3 table table-hover table-bordered p-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Title</th>
                                    <th width="25%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documents as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <div class="btn-toolbar mb-2" role="toolbar">
                                                <div class="btn-group mr-2 mb-2">
                                                    <button type="button" class="btn btn-outline-primary btn-show-document" data-toggle="modal" data-target="#modal-show-document" data-route="{{ route("documents.show", $value->id) }}">Detail</button>

                                                    <a href="{{ route('documents.edit', $value->id) }}" class="btn btn-primary">Edit</a>
                                                </div>
                                                &nbsp;
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger" id="button-delete-{{ $value->id }}" data-route="{{ route('documents.destroy', $value->id) }}" onclick="delete_data({{ $value->id }})">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Document Data Not Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-show-document" tabindex="-1" role="dialog" aria-labelledby="modal-document-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Dokumen</h5>
            </div>
            <div class="modal-body p-4">
                <div id="modal-body-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

            $('.modal').on('hidden.bs.modal', function (e) {
                $('#modal-body-content').html('<p class="text-center font-weight-bold">Mohon Tunggu ...</p>');
            });

            $(document).on('click', '.btn-show-document', function() {
                $('.modal').appendTo('body');
                $('.modal').modal('show');

                var url = $(this).data('route');
                $('#modal-body-content').html('<p class="text-center font-weight-bold">Mohon Tunggu ...</p>');
                $.ajax({
                    url: url,
                    dataType: 'JSON'
                })
                .done(function(result) {
                    $('#modal-body-content').html(result.view);
                })
                .fail(function() {
                    console.log("error");
                })
            });
        });

        function delete_data(id)
        {
            var formUrl = $('#button-delete-'+ id).data('route');
            swal({
                title: 'Are you sure?',
                text: 'Do you want to delete this record?',
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Hapus!",
                        closeModal: false,
                    }
                },
                dangerMode: true,
                closeOnClickOutside: false
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'DELETE',
                        url : formUrl,
                        dataType: 'JSON',
                        data: {'id': id, '_token': '{{ csrf_token() }}'},
                        success: function(res)
                        {
                            swal.stopLoading();
                            swal.close();
                            if(res.status == true)
                            {
                                swal({
                                    title: res.message,
                                    icon: "success",
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal.stopLoading();
                            swal.close();
                            swal({
                                title: "Failed Delete Document",
                                icon: "error",
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
