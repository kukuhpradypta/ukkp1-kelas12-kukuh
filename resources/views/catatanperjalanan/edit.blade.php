@extends('template.template')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-dark">Edit Data Journey</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('catatanperjalanan.update', $catatanperjalanan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal</label>
                                <input id="edit_tgl_group" type="date"
                                    class="form-control @error('tgl') is-invalid @enderror" name="tgl"
                                    value="{{ old('tgl', $catatanperjalanan->tgl) }}" placeholder="Masukkan Tanggal ">

                                <!-- error message untuk tgl -->
                                @error('tgl')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Waktu</label>
                                <input id="edit_jam_group" type="time"
                                    class="form-control @error('jam') is-invalid @enderror" name="jam"
                                    value="{{ old('jam', $catatanperjalanan->jam) }}" placeholder="Masukkan jam ">

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
                                    value="{{ old('lokasi', $catatanperjalanan->lokasi) }}"
                                    placeholder="Masukkan lokasi ">

                                <!-- error message untuk lokasi -->
                                @error('lokasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Suhu</label>
                                <input id="edit_suhu_group" type="text"
                                    class="form-control @error('suhu') is-invalid @enderror" name="suhu"
                                    value="{{ old('suhu', $catatanperjalanan->suhu) }}" placeholder="Masukkan suhu ">

                                <!-- error message untuk suhu -->
                                @error('suhu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Foto</label>
                                <input id="edit_foto_group" type="file"
                                    class="form-control @error('foto') is-invalid @enderror" name="foto"
                                    value="{{ old('foto') }}">
                                <img id="blah" class="mt-2" style="max-width: 180px" />
                                <!-- error message untuk foto -->
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="mt-2 btn btn-md btn-primary"><i class="fas fa-edit">
                                    Edit</i></button>
                            <button type="reset" class="mt-2 btn btn-md btn-warning"><i class="fas fa-redo-alt text-white">
                                    Reset</i></button>
                            <a href="/catatanperjalanan" type="reset" class="mt-2 btn btn-md btn-success"><i
                                    class="fas fa-arrow-left text-white">
                                    Back</i></a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
