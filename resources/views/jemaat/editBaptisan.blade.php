@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Data Baptisan</h3>
        </div>

        <!-- /.box-header -->
        <!-- form start -->
        <form action="/edit-data-baptisan" method="post">

        {{ csrf_field() }}
        <input type="hidden" name="no_baptis" class="form-control" value="{{ $baptisan->no_baptis }}">
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputPassword1">No Anggota <label class="text-danger">*</label></label>
                <input type="text" readonly name="nama_lengkap" class="form-control" value="{{ $anggota->no_anggota }}">
                <label class="text-danger">{{$errors->first("nama_lengkap") }}</label>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">No Baptis <label class="text-danger">*</label></label>
                <input type="text" readonly name="nama_lengkap" class="form-control" value="{{ $baptisan->no_baptis }}">
                <label class="text-danger">{{$errors->first("nama_lengkap") }}</label>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nama Lengkap <label class="text-danger">*</label></label>
                <input type="text" readonly name="nama_lengkap" class="form-control" value="{{ $anggota->nama_lengkap }}">
                <label class="text-danger">{{$errors->first("nama_lengkap") }}</label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Tanggal Baptis <label class="text-danger">*</label></label>
                <input type="date" name="tanggal_baptis" class="form-control" value="{{ \App\Helpers\DateUtil::date_display($baptisan->tanggal_baptis) }}">
                <label class="text-danger">{{$errors->first("tanggal_baptis") }}</label>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
@endsection