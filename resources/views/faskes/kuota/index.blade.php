@extends('auth.layouts')
@section('title')
    Fasilitas Kesehatan
@endsection
@section('content')
        <!-- row -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="profile card card-body px-3 pt-3 pb-0">
                        <div class="profile-head">
                            <div class="photo-content">
                                <div class="cover-photo rounded"></div>
                            </div>
                            <div class="profile-info">
                                <div class="profile-details">
                                    <div class="profile-name px-3 pt-2">
                                        <h4 class="text-primary mb-0">{{$data->nm_faskes}}</h4>
                                        <p>Nama Faskes</p>
                                    </div>
                                    <div class="profile-email px-2 pt-2">
                                        <h4 class="text-muted mb-0">{{$data->telepon}}</h4>
                                        <p>No Telepon</p>
                                    </div>
                                    <div class="profile-email px-2 pt-2">
                                        <h4 class="text-muted mb-0">{{App\Helpers\AppHelper::type($data->tipe)}}</h4>
                                        <p>Tipe</p>
                                    </div>
                                    <div class="profile-email px-2 pt-2">
                                        <h4 class="text-muted mb-0">{{$data->alamat}}, {{$data->kota->nm_kota}}</h4>
                                        <p>Alamat</p>
                                    </div>
                                    <div class="dropdown ms-auto">
                                        <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class="dropdown-item text-danger"><a href="{{route('faskes.index')}}"><i class="fa fa-arrow-left text-danger me-2"></i> Back</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap border-0 pb-0">
                            <div class="me-auto mb-sm-0 mb-3">
                                <h4 class="card-title mb-2">Kuota Vaksin</h4>
                                <span class="fs-12">Data jumlah kuota vaksin dan jenis vaksin</span>
                            </div>
                            <a href="{{route('faskes.kuota.create',  $data->uuid)}}" class="btn btn-rounded btn-md btn-primary mr-3 me-3"><i class="fa fa-plus scale5 me-3"></i>Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table header-border table-hover verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Vaksin</th>
                                            <th scope="col">Kuota</th>
                                            <th scope="col" width="200">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data->kuota) > 0)

                                        @foreach ($data->kuota as $item)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$item->vaksin->nm_vaksin}}</td>
                                            <td>{{$item->kuota}}</td>
                                            <td><a href="{{route('faskes.kuota.edit', $item->uuid)}}" class="btn btn-sm btn-warning ms-1">Edit</a><a href="" class="btn btn-sm btn-danger ms-1">Delete</a></td>
                                            {{-- <td class="py-2 text-end">
                                                <div class="dropdown"><button class="btn btn-primary tp-btn-light sharp" type="button" data-bs-toggle="dropdown"><span class="fs--1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></span></button>
                                                    <div class="dropdown-menu dropdown-menu-end border py-0">
                                                        <div class="py-2"><a class="dropdown-item">Edit</a>

                                                            <form action="" method="POST">
                                                                @csrf
                                                                @method("DELETE")
                                                                <button type="submit" class="dropdown-item text-danger">Delete</button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <th colspan="4" class="text-center">Tidak Ada Data,  <a class="text-primary" href="{{route('faskes.kuota.create',  $data->uuid)}}">Tambah</a>?</th>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @php
                $key = ['No' => ['label'=>'angka', 'width'=>50], 'Nama Fasilitas Kesehatan' => ['label' => 'nm_faskes'], 'Kota' => ['label' => 'nm_kota'], 'Kuota' => ['label' => 'aksi']];
            @endphp
            <x-paginate :data="$data" :key="$key"></x-paginate> --}}
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
