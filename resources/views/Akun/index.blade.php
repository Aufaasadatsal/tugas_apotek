@extends('layouts.template')

@section('content')
@if(Session::get('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if(Session::get('deleted'))
<div class="alert alert-warning">{{ Session::get('deleted') }}</div>
@endif

<a href="{{ route('user.create') }}" class="btn btn-secondary mb-2 float-end">Tambah Pengguna</a>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">Aksi</th>   
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($users as $user)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['role'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('user.edit', $user['id']) }}" class="btn btn-primary me-3">Edit</a>

                <!-- Modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user['id']}}">
                    Hapus
                </button>
            </td>
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{$user['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfrimasi Kalo Mau Hapus!!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin akan menghapus?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('user.delete', $user['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
@endsection