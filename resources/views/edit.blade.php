<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu Undangan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        .img1 {
            background-color: #3498db;
            width: 100%;
            height: 200px;
        }

        .card {
            margin-top: -120px;
        }

    </style>
</head>

<body>
    <div class="img1">
        <nav class="navbar">
            <span class="navbar-brand mb-0 h1 text-white">Tamu Undangan</span>
        </nav>
    </div>
    <div class="img2"></div>

    <div class="container">
        <div class="card">
            <div class="card-body shadow-sm">
                <h4>Ubah Data Tamu Undangan</h4>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-left">Nama</label>

                    <div class="col-md-10">
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" value="{{ $tamu->nama }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-left">Instansi</label>

                    <div class="col-md-10">
                        <input id="instansi" type="text" class="form-control @error('instansi') is-invalid @enderror"
                            name="instansi" value="{{ $tamu->instansi}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-left">Status</label>

                    <div class="col-md-10">
                        <select id="status" type="text" class="form-control @error('status') is-invalid @enderror"
                            name="status" required>
                            <option value="Hadir" {{ $tamu->status === "Hadir" ? "selected" : "" }}>Hadir</option>
                            <option value="Belum Konfirmasi"
                                {{ $tamu->status === "Belum Konfirmasi" ? "selected" : "" }}>
                                Belum Konfirmasi</option>
                            <option value="Tidak Hadir" {{ $tamu->status === "Tidak Hadir" ? "selected" : "" }}>Tidak
                                Hadir</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <a href="/" class="btn btn-primary btn-sm float-left">
                            <span class="fa fa-arrow-left"></span> Kembali
                        </a>
                        <button data-id="{{ $tamu->id }}" id="save" class="btn btn-success float-right btn-sm">
                            <span class="fa fa-save"></span> Simpan
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $("#save").click(function () {
            var id = $(this).attr('data-id');
            var data = {
                "_token": "{{ csrf_token() }}",
                'nama': $("#nama").val(),
                'instansi': $("#instansi").val(),
                'status': $("#status").val(),
            };

            var nama = $("#nama").val();
            var instansi = $("#instansi").val();

            if (nama.length <= 2) {
                swal({
                    icon: "warning",
                    title: "Error!",
                    text: "Nama minimal berisi 2 karakter.",
                    timer: 2300,
                    buttons: false,
                });
            } else if (instansi.length <= 2) {
                swal({
                    icon: "warning",
                    title: "Error!",
                    text: "Instansi minimal berisi 2 karakter.",
                    timer: 2300,
                    buttons: false,
                });
            } else {
                $.ajax({
                    url: "/update/" + id,
                    type: 'POST',
                    cache: false,
                    data: data,
                    success: function (result) {
                        console.log(result)
                        swal({
                            title: "Sukses!",
                            text: "Tamu berhasil diupdate.",
                            icon: "success",
                            buttons: false,
                            timer: 1500,
                        });
                        setTimeout(function () {
                            window.location.href = '/';
                        }, 1000);
                    }
                })
            }
        })

    </script>
</body>

</html>
