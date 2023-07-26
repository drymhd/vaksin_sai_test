@extends('auth.layouts')

@section('title')
    Tambah Pengguna
@endsection


@section('content')
        <!-- row -->
        <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah User</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('user.store')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" required placeholder="Nama" name="name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" required placeholder="Email" name="email">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" required placeholder="Password" name="password">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Re-Password</label>
                                        <input type="password" class="form-control" required placeholder="Password" name="password_confirmation">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <div class="input-group mb-3">
											<span class="input-group-text">Photo</span>
                                            <div class="form-file">
                                                <input type="file" name="file" accept="image/png, image/jpeg" class="form-file-input form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <button type="button" onclick="history.back()" class="btn btn-danger">Kembali</button>

                            </form>
                        </div>
                    </div>
                </div>

        </div>
    <!--**********************************
        Content body end
    ***********************************-->




</div>

@section('js')

    <script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/dlabnav-init.js') }}"></script>

@endsection

@endsection
