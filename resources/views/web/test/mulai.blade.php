@extends('web.templates.index')
@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')

<div class="container my-5">
    <div id="loading" style="margin-bottom: 800px">
        <h5>Memuat soal...</h5>
    </div>
    <div id="content" class="row d-none">

        <h3 class="mb-5">{{ $test->judul }} - {{ $test->keterangan }}</h3>

        <p class="mb-0">Nomor Soal</p>
        <div class="container">
            <div class="row mb-3 px-2" id="daftar-nomor">
                {{-- @foreach ($soal as $item)
                <button class="btn btn-light col-1 rounded-0 card-nomor-soal" data-id="{{ $item->id }}" id="soal{{ $item->id }}">{{ $item->nomor_soal }}</butt>
                @endforeach --}}
            </div>
            <button class="btn btn-danger rounded-0 mb-3" id="finish">SELESAI</button>
        </div>

        <div class="card">
            <form action="#" method="POST">
                <div class="card-title pt-4 px-3">
                    {{-- {!! $soal[0]->soal !!} --}}
                    <span class="badge bg-primary mb-3" id="no-soal"></span>

                    <div id="soal"></div>
                </div>
                <div class="card-body">
                    @if ($test->tipe == 'berganda')
                    <ul class="list-group rounded-0 mb-3" id="pilihan">
                        {{-- @foreach ($soal[0]->pilihan->shuffle() as $item)
                    <li class="list-group-item"> <input type="radio" name="jawaban" id="jawaban{{ $item->id }}"> <label for="jawaban{{ $item->id }}">{{ $item->pilihan }}</label> </li>
                        @endforeach --}}
                    </ul>
                    @else
                    <div id="textarea"></div>
                    {{-- <textarea class="form-control mb-3" name="jawaban" id="jawaban" cols="30" rows="10" placeholder="Masukan jawaban" required></textarea> --}}
                    @endif
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <button class="btn btn-secondary rounded-0" id="prev">Sebelumnya</button>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-success rounded-0 right" id="next">Jawab</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-loading-overlay@1.1.0/dist/js-loading-overlay.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    let soal;
    let index_soal = 0;
    let row = 0;
    let jawaban = [];
    let id_jawaban = 0;
    let tipe_soal = `{{ $test->tipe }}`;

    // Ajax data soal
    $.ajax(`{{ url('web-api/v1/tes') }}/{{ $test->id }}/soal`)
        .done(function(data) {
            console.log(data)
            soal = data;
            row = soal.length;
            if (row > 0) {
                // Buat tombol nomor berdasarkan banyak soal
                soal.forEach(item => {
                    $('#daftar-nomor').append(`<button class="btn btn-light col-1 rounded-0 card-nomor-soal" data-id="${item.id}" id="soal${item.id}">${item.nomor_soal}</button>`)
                });

                // load daftar jawaban
                loadJawaban();

                // Event click pada tombol nomor soal
                $('.card-nomor-soal').click(function(e) {
                    var id = $(this).data('id');
                    soal.findIndex(function(entry, i) {
                        if (entry.id == id) {
                            index_soal = i;
                            return true;
                        }
                    });
                    // tampilkan soal sesuai nomor yang di click
                    showSoal();
                });
                setTimeout(() => {
                    // Tunggu setelah beberapa dtik lalu tampilkan soal yang di load pertama kali dari ajax
                    showSoal();
                    $('#loading').addClass('d-none');
                    $('#content').removeClass('d-none');
                }, 3000);
            }
        })
        .fail(function(e) {
            console.log(e);
        });

        // fungsi untuk mengambil dan mnyimpan data jawaban
    function loadJawaban() {
        // Ajax data jawaban user
        $.ajax(`{{ url('web-api/v1/tes/' . $test->id) }}`)
            .done(function(data) {
                id_jawaban = data.id
                // simpan data jawaban berganda
                if (tipe_soal == 'berganda') {
                    if (data.detail_jawaban_berganda.length > 0) {
                        data.detail_jawaban_berganda.forEach(element => {
                            $('#soal' + element.id_soal).addClass('bg-success bg-opacity-75');

                            jawaban.push({
                                'id_soal': element.id_soal
                                , 'id_pilihan_jawaban': element.id_pilihan_jawaban
                            });
                        });
                    }
                }else{
                    // simpan data jawaban jawaban_essay
                    if (data.detail_jawaban_essay.length > 0) {
                        data.detail_jawaban_essay.forEach(element => {
                            $('#soal' + element.id_soal).addClass('bg-success bg-opacity-75');
                            jawaban.push({
                                'id_soal': element.id_soal
                                , 'jawaban': element.jawaban
                            });
                        });
                    }
                }
            })
            .fail(function(e) {
                console.log(e);
            })
    }

    // fungsi untuk menampilkan soal
    function showSoal() {
        var _soal = soal[index_soal];
        loadSoal(_soal.soal, _soal.id, _soal.nomor_soal, _soal.pilihan);
    }
    // fungsi untuk menampilkan soal
    function loadSoal(soal, id, noSoal, pilihan) {
        $('.card-nomor-soal').removeClass('bg-primary');
        $('.card-nomor-soal').removeClass('text-white');
        $('#soal' + id).addClass('bg-primary');
        $('#soal' + id).addClass('text-white');
        $('#soal').html(soal)
        $('#no-soal').html('No Soal : ' + noSoal);
        if (tipe_soal != 'essay') {
            // tampilkan soal untuk pilihan ganda
            $('#pilihan').empty();
            pilihan.forEach(pilihan => {
                var selected = '';
                jawaban.findIndex(function(entry, i) {
                    if (entry.id_soal == id) {
                        if (entry.id_pilihan_jawaban == pilihan.id) {
                            selected = 'checked';
                        } else {
                            selected = '';
                        }
                        return;
                    }
                });
                var el = `<li class="list-group-item"> <input type="radio" ${selected} name="jawaban" value="${pilihan.id}" id="jawaban${pilihan['id']}" required> <label for="jawaban${pilihan['id']}">${pilihan['pilihan']}</label> </li>`;

                $('#pilihan').append(el);
            });
        }else{
            // tampilkan soal untuk essay
            var jawaban_essay = '';
            $('#textarea').empty();
            jawaban.findIndex(function(entry, i) {
                if (entry.id_soal == id) {
                    jawaban_essay = entry.jawaban;
                    return;
                }
            });
            var el = `<textarea class="form-control mb-3" name="jawaban" id="jawaban" cols="30" rows="10" placeholder="Masukan jawaban" required>${jawaban_essay}</textarea>`;
            $('#textarea').append(el);
        }

    }
    // config loading
    JsLoadingOverlay.setOptions({
        "overlayBackgroundColor": "#198754"
        , "overlayOpacity": 0.3
        , "spinnerIcon": "ball-atom"
        , "spinnerColor": "#198754"
        , "spinnerSize": "3x"
        , "overlayIDName": "overlay"
        , "spinnerIDName": "spinner"
        , "offsetX": 0
        , "offsetY": 0
        , "containerID": null
        , "lockScroll": true
        , "overlayZIndex": 19998
        , "spinnerZIndex": 9999
    });

    // Aksi untuk menjawab soal
    function jawab() {
        // ambil soal berdasarkan index aktif
        var _soal = soal[index_soal];
        var val;
        var data;
        if (tipe_soal == 'berganda') {
            // jika soal berganda
            val = $('input[type=radio]:checked').val();
            data = {
                'id_soal': _soal.id
                , 'id_pilihan_jawaban': val
                , '_token': `{{ csrf_token() }}`
            };
        } else {
            // jika soal essay
            val = $('#jawaban').val();
            data = {
                'id_soal': _soal.id
                , 'jawaban': val
                , '_token': `{{ csrf_token() }}`
            };
        }
        // ajax jawab soal
        $.ajax({
            url: `{{ url('web-api/v1/tes/' . $test->id . '/soal') }}/${id_jawaban}`
            , type: 'POST'
            , dataType: 'json'
            , data: data
        }).done(function(data) {
            console.log(data)
            JsLoadingOverlay.hide();
            if (index_soal < (row - 1)) {
                index_soal += 1;
                showSoal();
            }

        }).fail(function(e) {
            JsLoadingOverlay.hide();
            console.log(e)
            toastr.error(e.responseJSON.message)
        })

        jawaban.findIndex(function(entry, i) {

            if (entry?.id_soal != undefined) {
                if (entry['id_soal'] == _soal.id) {
                    jawaban.splice(i, 1);
                    return;
                }
            }
        });

        $('#soal' + _soal.id).addClass('bg-success bg-opacity-75');

        if (tipe_soal == 'berganda') {
            jawaban.push({
                'id_soal': _soal.id
                , 'id_pilihan_jawaban': val
            });
        } else {
            jawaban.push({
                'id_soal': _soal.id
                , 'jawaban': val
            });
        }
    }

    $('document').ready(function() {

        $('form').submit(function(e) {
            JsLoadingOverlay.show();
            e.stopPropagation();
            e.preventDefault();
            jawab();

        });
        $('#prev').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            if (index_soal < row && index_soal > 0) {
                index_soal -= 1;
                showSoal();
            }
        });
        $('#finish').click(function(e) {
            if (row > jawaban.length) {
                if(!confirm('Anda belum menjawab semua soal! Yakin ingin selesai?')){
                    return;
                }
            } else {
                if(!confirm('Yakin ingin selesai?'))
                {
                    return;
                }
            }
            JsLoadingOverlay.show();
            $.ajax({
                url: `{{ url('web-api/v1/tes/' . $test->id . '/selesai') }}`
                , type: 'POST'
                , dataType: 'json'
                , data: {
                    '_token': `{{ csrf_token() }}`
                }
            }).done(function(result) {
                JsLoadingOverlay.hide();
                console.log(result)
            }).fail(function(e) {
                JsLoadingOverlay.hide();
                console.log(e)
                toastr.error(e.responseJSON.message)
            });
        });
    });

</script>

@endsection
