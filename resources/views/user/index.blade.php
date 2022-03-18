@extends('template.template')
@section('headcss')
    <style>
        .profile-widget {
            margin-top: 35px;
        }

        .profile-widget .profile-widget-picture {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
            width: 100px;
            margin: -35px 0px 0 40%;
            position: relative;
            z-index: 1;
        }

        .profile-widget .profile-widget-header {
            display: inline-block;
            width: 100%;
            margin-bottom: 10px;
        }


        .profile-widget .profile-widget-description {
            padding: 20px;
            line-height: 26px;
        }

        .profile-widget .profile-widget-description .profile-widget-name {
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        @media (max-width: 575.98px) {
            .profile-widget .profile-widget-picture {
                left: 50%;
                transform: translate(-50%, 0);
                margin: 40px 0;
                float: none;
            }


        }

    </style>
@endsection
@section('content')
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="mt-5 col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="{{ Auth::user()->name }}" src="{{ asset('assets/images/' . Auth::user()->foto) }}"
                            class="rounded-circle profile-widget-picture">
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name text-center">{{ auth()->user()->name }} <div
                                class="text-muted d-inline font-weight-normal">
                            </div>
                        </div>

                        <div>NIK : {{ auth()->user()->nik }} </div>
                        <div>Email : {{ auth()->user()->email }} </div>

                        <div class="text-left">
                            <button onclick="create()" class="btn btn-primary mt-4">Edit Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            Edit Account Data </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Name</label>
                                    <input value="{{ old('name', Auth::user()->name) }}" type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Nik</label>
                                    <input value="{{ old('nik', Auth::user()->nik) }}" type="text" name="nik"
                                        class="form-control @error('nik') is-invalid @enderror">
                                    @error('nik')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Email</label>
                                    <input value="{{ old('email', Auth::user()->email) }}" type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    id="image-label">Foto</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type='file' value="{{ old('foto', Auth::user()->foto) }}" name="foto"
                                        onchange="readURL(this);" />
                                    <img id="blah" class="mt-2" style="max-width: 180px" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {});

        function create() {
            $.get("{{ url('userprofile') }}", {},
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('change/password/db') }}">
                        @csrf
                        <div class="form-group">
                            <label>Old password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror "
                                name="current_password" value="{{ old('current_password') }}"
                                placeholder="Enter Old Password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                name="new_password" placeholder="Enter Current Password">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm password</label>
                            <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror"
                                name="new_confirm_password" placeholder="Choose Confirm Password">
                            @error('new_confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
