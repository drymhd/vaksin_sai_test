@extends('auth.layouts')
@section('title')
    Tambah - Fasilitas Kesehatan
@endsection

@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Fasilitas Kesehatan</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('faskes.kuota.store', $faskes->uuid) }}" method="post">
                        <input type="hidden" value="{{$faskes->id}}" name="faskes_id">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Type Vaksin</label>
                                <x-select2 id="vaksin" name="vaksin_id">
                                    @foreach ($vaksin as $item)
                                    <option value="{{$item->id}}">{{$item->nm_vaksin}}</option>
                                    @endforeach
                                </x-select2>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Kuota</label>
                                    <input type="number" class="form-control" required placeholder="Kuota"
                                        name="kuota">
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
