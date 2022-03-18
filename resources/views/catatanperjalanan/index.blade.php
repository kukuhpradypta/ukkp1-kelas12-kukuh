@extends('template.template')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" onclick="create()">
                <i class="fas fa-folder-plus pr-2"></i>Create Journey Data
            </button>
        </div>
        <div class="card-body">
            <form class="form" style="margin-left:10%; " method="get" action="{{ route('search') }}">
                <div class="form-group w-100 mb-3">
                    <input type="text" name="search" class="form-control w-75 d-inline" id="search"
                        placeholder="Search Location or Date !">
                    <button type="submit" class="btn btn-primary mb-1"><i class="fas fa-search"></i></button>
                    <a href="/catatanperjalanan" class="btn btn-success mb-1">
                        <i class="fas fa-redo-alt"></i></a>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered " id="#" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>NO</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Temperature</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Temperature</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($catatanperjalanans as $catatanperjalanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $catatanperjalanan->tgl }}</td>
                                <td>{{ $catatanperjalanan->jam }}</td>
                                <td>{{ $catatanperjalanan->lokasi }}</td>
                                <td>{{ $catatanperjalanan->suhu }}</td>
                                <td class="text-center">
                                    <img src="{{ Storage::url('public/catatanperjalanans/') . $catatanperjalanan->foto }}"
                                        class="rounded pt-1 pb-1" style="max-width: 130px;max-height:140px">
                                </td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('catatanperjalanan.destroy', $catatanperjalanan->id) }}"
                                        method="POST">
                                        <a type="button"
                                            href="{{ route('catatanperjalanan.edit', $catatanperjalanan->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>

                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                No Journey Data !
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $catatanperjalanans->links() }}
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif

        function create() {
            $.get("{{ url('catatanperjalanan') }}", {},
                function(data, status) {
                    $("#staticBackdrop").modal('show');

                });
        }
    </script>

    @section('modalcreate')
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('catatanperjalanan.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal</label>
                                <input id="edit_tgl_group" type="date" class="form-control @error('tgl') is-invalid @enderror"
                                    name="tgl" value="{{ old('tgl') }}" placeholder="Masukkan Tanggal ">

                                <!-- error message untuk tgl -->
                                @error('tgl')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Waktu</label>
                                <input id="edit_jam_group" type="time" class="form-control @error('jam') is-invalid @enderror"
                                    name="jam" value="{{ old('jam') }}" placeholder="Masukkan jam ">

                                <!-- error message untuk jam -->
                                @error('jam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Lokasi</label>
                                <input id="edit_lokasi_group" type="text"
                                    class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                    value="{{ old('lokasi') }}" placeholder="Masukkan lokasi ">

                                <!-- error message untuk lokasi -->
                                @error('lokasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Suhu</label>
                                <input id="edit_suhu_group" type="text" class="form-control @error('suhu') is-invalid @enderror"
                                    name="suhu" value="{{ old('suhu') }}" placeholder="Masukkan suhu ">

                                <!-- error message untuk suhu -->
                                @error('suhu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Foto</label>
                                <input id="edit_foto_group" type="file" class="form-control @error('foto') is-invalid @enderror"
                                    name="foto" value="{{ old('foto') }}">
                                <img id="blah" class="mt-2" style="max-width: 180px" />
                                <!-- error message untuk foto -->
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-save">
                                    Simpan</i></button>
                            <button type="reset" class="btn btn-md btn-warning"><i class="fas fa-redo-alt text-white">
                                    Reset</i></button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection
