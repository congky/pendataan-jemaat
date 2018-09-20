@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Konfirmasi Usulan</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/simpan-konfirmasi-usulan" method="post">
      <div class="box-body">

        <div class="form-group">
            {{ csrf_field() }}

            <input type="hidden" readonly name="anggota_id" class="form-control" value="{{ $anggota->anggota_id }}">

            <label for="exampleInputPassword1">Nama Anggota</label>
            <input type="text" readonly class="form-control"
                   placeholder="Nama Anggota" value="{{ $anggota->nama_lengkap }}">
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Periode Baptis <label class="text-danger">*</label></label>
          <select name="period_baptis" class="form-control">
                    <option value="1">Minggu 1</option>
                    <option value="2">Minggu 2</option>
                    <option value="3">Minggu 3</option>
                    <option value="4">Minggu 4</option>
                    <option value="5">Minggu 5</option>
                  </select>
         <label class="text-danger">{{$errors->first("period_baptis") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Tanggal Baptis <label class="text-danger">*</label></label>
          <input type="date" name="tanggal_baptis" class="form-control" placeholder="Tanggal Baptis">
          <label class="text-danger">{{$errors->first("tanggal_baptis") }}</label>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Keterangan</label>
          <textarea rows="4" cols="50" name="pesan" class="form-control"></textarea>
        </div>

      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
  @endsection