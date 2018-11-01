@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Data Kematian</h3>
        </div>

        @if(Session::has("err_msg"))
            <div class="alert alert-danger">
                {{Session::get("err_msg")}}.
            </div>
        @endif

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/do-simpan-data-kematian" method="post">
            <div class="box-body">
                {{ csrf_field() }}

                <input type="hidden" name="anggota_kematian_id" class="form-control" value="{{ $kematian->anggota_kematian_id }}">

                <div class="form-group">
                    <label for="exampleInputPassword1">Jemaat</label>
                    <input type="text" readonly class="form-control" value="{{ $anggota->no_anggota." - ".$anggota->nama_lengkap }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Tempat Pemakaman<label class="text-danger">*</label></label>
                    <input type="text" name="tempat_pemakaman" class="form-control" placeholder="Tempat Pemakaman" value="{{ $kematian->tempat_pemakaman }}">
                    <label class="text-danger">{{$errors->first("tempat_pemakaman") }}</label>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Kematian <label class="text-danger">*</label></label>
                    <input type="date" name="tgl_kematian" class="form-control" placeholder="Tanggal Kematian" value="{{ \App\Helpers\DateUtil::date_display($kematian->tgl_kematian) }}">
                    <label class="text-danger">{{$errors->first("tgl_kematian") }}</label>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Pemakaman <label class="text-danger">*</label></label>
                    <input type="date" name="tgl_pemakaman" class="form-control" placeholder="Tanggal Pemakaman" value="{{ \App\Helpers\DateUtil::date_display($kematian->tgl_pemakaman) }}">
                    <label class="text-danger">{{$errors->first("tgl_pemakaman") }}</label>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection