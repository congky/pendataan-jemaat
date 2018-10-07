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
            <strong>Danger!</strong> {{Session::get("err_msg")}}.
        </div>
        @endif
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/simpan-data-kematian" method="post">
            <div class="box-body">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="exampleInputFile">Jemaat <label class="text-danger">*</label></label>
                    <select name="jemaat" class="form-control">
                        <option value="" selected>-- Pilih Jemaat --</option>
                        @foreach($anggota as $key=>$value)
                            @if($selectedAnggotaId==$value->no_anggota)
                                <option value="{{ $value->no_anggota }}" selected>{{ $value->no_anggota }} - {{ $value->nama_lengkap }}</option>
                            @else
                                <option value="{{ $value->no_anggota }}">{{ $value->no_anggota }} - {{ $value->nama_lengkap }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label class="text-danger">{{$errors->first("jemaat") }}</label>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Tempat Pemakaman<label class="text-danger">*</label></label>
                    <input type="text" name="tempat_pemakaman" class="form-control" placeholder="Tempat Pemakaman">
                    <label class="text-danger">{{$errors->first("tempat_pemakaman") }}</label>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Kematian <label class="text-danger">*</label></label>
                    <input type="date" name="tgl_kematian" class="form-control" placeholder="Tanggal Kematian">
                    <label class="text-danger">{{$errors->first("tgl_kematian") }}</label>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Pemakaman <label class="text-danger">*</label></label>
                    <input type="date" name="tgl_pemakaman" class="form-control" placeholder="Tanggal Pemakaman">
                    <label class="text-danger">{{$errors->first("tgl_pemakaman") }}</label>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection