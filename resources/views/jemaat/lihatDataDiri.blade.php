@extends("default.default")
@section("head")
    <title>Lihat data diri</title>
@endsection

@section("content")

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lihat Data Diri</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="/edit-jemaat/{{ Session::get("HAS_SESSION")["no_anggota"] }}/N" class="btn btn-primary">Edit Data Diri</a>

            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">No Anggota</label>
                        <input type="text" value="{{ $anggota->no_anggota }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">No KK</label>
                        <input type="text" value="{{ $anggota->no_kk }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Lengkap</label>
                        <input type="text" value="{{ $anggota->nama_lengkap }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                        <input type="text" value="{{ $anggota->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Lahir</label>
                        <input type="text" value="{{ $anggota->tempat_lahir }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Lahir</label>
                        <input type="date" value="{{ \App\Helpers\DateUtil::date_display($anggota->tgl_lahir) }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <input type="text" value="{{ $anggota->alamat }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="text" value="{{ $anggota->email }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">No Telp</label>
                        <input type="text" value="{{ $anggota->no_telp }}" class="form-control" readonly>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
@section("before_end_body")
@endsection