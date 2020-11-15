<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu Undangan</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <style>
        body {
            font-family: 'Poppins';
        }

        .img1 {
            background-color: #3498db;
            width: 100%;
            height: 200px;
        }

        .card {
            margin-top: -120px;
        }

        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info {
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter.warning {
            background-color: #ffed4a;
            color: #FFF;
        }

        .card-counter i {
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers {
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 32px;
            display: block;
        }

        .card-counter .count-name {
            position: absolute;
            right: 35px;
            top: 65px;
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 18px;
        }

        @media screen and (max-width: 500px) {
            .card-counter .count-name {
                font-size: 12px;
                margin-top: 10px;
            }
        }

        .card-2 {
            margin-top: 30px;
            margin-bottom: 50px;
        }

    </style>
</head>

<body>
    <div class="img1">
        <nav class="navbar">
            <span class="navbar-brand mb-0 h1 text-white">TAMU UNDANGAN</span>
        </nav>
    </div>
    <div class="img2"></div>

    <div class="container">
        <div class="card">
            <div class="card-body shadow-sm">
                <span class="clock">
                    <span id="jam"></span> :
                    <span id="menit"></span> :
                    <span id="detik"></span>
                </span>
                <span class="float-right">SMK Nurul Islam</span>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="card-counter success">
                            <i class="fa fa-check-circle fa-3x"></i>
                            <span class="count-numbers">{{ count($hadir) }}</span>
                            <span class="count-name">Hadir</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="card-counter danger">
                            <i class="fa fa-times-circle fa-3x"></i>
                            <span class="count-numbers">{{ count($tidak_hadir) }}</span>
                            <span class="count-name">Tidak Hadir</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="card-counter warning">
                            <i class="fa fa-question-circle fa-3x"></i>
                            <span class="count-numbers">{{ count($belum_konfirmasi) }}</span>
                            <span class="count-name">Belum Konfirmasi</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="card-counter info">
                            <i class="fa fa-users fa-3x"></i>
                            <span class="count-numbers">{{ count($tamu) }}</span>
                            <span class="count-name">Total Tamu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-2">
            <div class="card-body shadow-sm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            <a href="/export-tamu" class="btn btn-warning btn-sm" id="exportTamu">
                                <span class="fa fa-upload"></span>
                                Export
                            </a>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalImport">
                                <span class="fa fa-download"></span>
                                Import
                            </button>
                            <a href="/create" class="btn btn-primary btn-sm">
                                <span class="fa fa-plus"></span> Tamu
                            </a>
                        </div>
                        <div class="table-responsive mt-5">
                            <table class="table table-hover table-bordered" id="table_id">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Instansi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tamu as $key => $t)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $t->nama }}</td>
                                        <td>{{ $t->instansi }}</td>
                                        <th>
                                            @if($t->status == 'Hadir')
                                            <span class="badge badge-success">Hadir</span>
                                            @elseif($t->status == 'Tidak Hadir')
                                            <span class="badge badge-danger">Tidak Hadir</span>
                                            @elseif($t->status == 'Belum Konfirmasi')
                                            <span class="badge badge-warning">Belum Konfirmasi</span>
                                            @else
                                            <span class="badge">Tidak ada dalam status! Harap Ubah</span>
                                            @endif
                                        </th>
                                        <td class="text-center">
                                            <a href="/edit/{{ $t->id }}" class="btn btn-warning btn-sm">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{ $t->id }}"
                                                class="btn btn-danger btn-sm button-delete">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/import-tamu" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <labe>File</labe>
                            <input type="file" name="import" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="/export/template.xlsx" class="btn btn-sm btn-primary">
                                Download Template!
                            </a> <br>
                            <small>
                                Sesuaikan format isian dengan template! <br>
                                untuk status ada 3, <br> <b>Hadir</b>, <b>Belum Konfirmasi</b> dan <b>Tidak
                                    Hadir</b>.
                            </small>
                            <button type="submit" id="import-send" class="btn btn-sm btn-success float-right">
                                <span class="fa fa-download"></span> Import!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="fontawesome/js/all.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#table_id").DataTable();
        });

        window.setTimeout("waktu()", 1000);

        function waktu() {
            var tanggal = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = tanggal.getHours();
            document.getElementById("menit").innerHTML = tanggal.getMinutes();
            document.getElementById("detik").innerHTML = tanggal.getSeconds();
        }

        $("#exportTamu").on('click', function () {
            var url = "/export-tamu";
            swal({
                icon: "success",
                title: "Export Berhasil!",
                text: "Sedang mengambil data . . .",
                buttons: false,
                timer: 1500,
            });
            setTimeout(function () {
                window.location.href = url;
            });
        });

        $(".button-delete").on('click', function () {
            var id = $(this).attr('data-id');
            var url = "/delete/" + id;
            swal({
                    icon: "warning",
                    title: "Apakah anda yakin?",
                    text: "Data ini tidak bisa dipulihkan setelah dihapus!",
                    buttons: ["Batal", "Ya"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal({
                            icon: "success",
                            title: "Sukses!",
                            text: "Tamu berhasil dihapus.",
                            buttons: false,
                            timer: 1500,
                        });
                        setTimeout(function () {
                            window.location.href = url
                        }, 1000);
                    }
                })
        });

        $("#import-send").on('click', function () {
            swal({
                icon: "success",
                title: "Import berhasil!",
                text: "Sedang menginput data . . .",
                buttons: false,
                timer: 1500,
            });
            setTimeout(function () {
                window.location.href = url;
            }, 1000);
        });

    </script>
</body>

</html>
