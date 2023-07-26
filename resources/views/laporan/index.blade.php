@extends('auth.layouts')

@section('title')
    Laporan
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="modal fade" id="kuota">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nm_faskes"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body" id="content">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <input type="hidden" id="token" value="{{ Auth::user()->api_token }}">
                <label class="form-label">Provinsi</label>
                <select class="form-control select2" required>
                    <option value="" selected disabled>Pilih</option>
                    @foreach ($provinsis as $item)
                        <option value="{{ $item->id }}">{{ $item->nm_provinsi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6 kota">
                <label class="form-label">Kota</label>
                <select class="form-control" id="kota" name="kota_id" required>
                    <option value="" selected disabled>Pilih</option>
                </select>
            </div>
        </div>



        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kuota Vaksin</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-primary solid alert-rounded" id="peringatan">
                                    <strong>Perhatian!</strong> Silahkan Masukan Data Provinsi Dan Kota Terlebih dahulu
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="example5" class="display" style="min-width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Fasilitas Kesehatan</th>
                                        <th>Tipe</th>
                                        <th width="200">Kuota Vaksin</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    </div>


@section('js')
    <!-- Dashboard 1 -->
    {{-- <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script> --}}

    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>


    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>


@endsection

@endsection
