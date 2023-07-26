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
                    <form action="{{ route('faskes.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Fasilitas Kesehatan</label>
                                <input type="text" class="form-control" required placeholder="Fasilitas Kesehatan"
                                    name="nm_faskes">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Type</label>
                                <select class="form-control" required name="tipe">
                                    <option value="" selected disabled>Pilih</option>
                                    {{-- @foreach ($provinsis as $item) --}}
                                    <option value="rumah_sakit">Rumah Sakit</option>
                                    <option value="puskesmas">Puskesmas</option>
                                    <option value="klinik">Klinik</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
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
                            <div class="mb-3 col-md-12">
                                <label class="form-label">No Telepon</label>
                                <input type="text" class="form-control" required placeholder="No Telp"
                                    name="telepon">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" required placeholder="Alamat"
                                    name="alamat"> </textarea>
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


    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(".kota").hide();

        $('.select2').select2().on('change', (e) => {
            $(".kota").show();
            if ($('#kota').hasClass("select2-hidden-accessible")) {

                $("#kota").val('');
                $("#kota").select2('destroy');
            // Select2 has been initialized
        }
            setTimeout(() => {
                test(e);
            }, 200);
        });

        test = function(e) {
            $("#kota").select2({
                ajax: {
                    url: "/kota/"+$(".select2").val(),
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Cari Kota',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }


                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(repo.text);
                return $container;
            }

            function formatRepoSelection(repo) {
                console.log(repo)
                return repo.full_name || repo.text;
            }


        }
    </script>
@endsection

@endsection
