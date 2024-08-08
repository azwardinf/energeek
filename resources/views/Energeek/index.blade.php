@extends('layouts.app')
@section('content')
    <div class="container py-5">
        @if ($message = Session::get('success'))
            <div class="alert bg-success mb-3">
                {{ $message }}
            </div>
        @endif
        <form id="form-todos" method="POST" action="{{ route('store') }}">
            @csrf

            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="my-5">
                        <img src="{{ asset('icon/energeek2 1.png') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="errors" class="alert bg-danger text-white d-none mb-3">

                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input required class="form-control @error('user_nama') is-invalid @enderror" class="form-control"
                            id="nama" class="form-control" name="user_name" placeholder="Nama">
                        @error('user_nama')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input required type="text" class="form-control @error('user_username') is-invalid @enderror"
                            id="username" name="user_username" placeholder="Username">
                        @error('user_username')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input required type="email" class="form-control @error('user_email') is-invalid @enderror"
                            id="email" name="user_email" placeholder="Email">
                        @error('user_email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="button" id="btn-add" class="btn btn-danger">+ Tambah Data</button>
                </div>
            </div>

            <div class="to-do-list">
                <h2>To Do List</h2>
                <div id="todos">

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success w-100">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        let counter = 0;

        $(function() {
            $('#todos').on('click', '.btn-delete', function() {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "To do yang dihapus tidak akan dikembalikan.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "To do berhasil dihapus",
                            icon: "success",
                            confirmButtonText: "Selesai"
                        }).then(() => {
                            $(this).parentsUntil('#todos').remove();
                        });
                    }
                });
            });

            $('#btn-add').on('click', function() {
                $('#todos').append(`
                    <div class="row mb-3">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Judul To Do</label>
                                <input type="text" required class="form-control" placeholder="Contoh: Perbaikan api master" name="todos[${counter}][name]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" required name="todos[${counter}][category_id]">
                                @foreach ($ctg as $ct)
                                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-danger btn-delete" type="button">
                                <img src="{{ asset('/icon/fa-solid_trash.png') }}">
                            </button>
                        </div>
                    </div>
                `)
                counter++;
            });

            for (let index = 0; index < 3; index++) {
                $('#btn-add').click();
            }
        });

        $('#form-todos').on('submit', function() {
            $('#errors').addClass('d-none')
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function() {
                    window.location.reload();
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    let html = ''
                    $.each(errors.errors, function(key, value) {
                        html += `<div>${value[0]}</div>`
                    });
                    if (html != '') {
                        $('#errors').removeClass('d-none')
                        $('#errors').html(html)
                    }
                }
            });
            return false;
        });
    </script>
@endsection
