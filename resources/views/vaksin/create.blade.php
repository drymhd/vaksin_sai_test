@extends('auth.layouts')

@section('title')
    Tambah - Vaksin
@endsection
@section('content')
        <!-- row -->
        <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Vaksin</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('vaksin.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Nama Vaksin</label>
                                        <input type="text" class="form-control" required placeholder="Vaksin" name="nm_vaksin">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
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
