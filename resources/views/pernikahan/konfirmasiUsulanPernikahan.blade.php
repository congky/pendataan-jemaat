@extends("default.default")
@section("head")
    <title>Konfirmasi Pernikahan</title>
@endsection

@section("content")

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
          Konfirmasi Pernikahan
      </h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/proses-data-usulan-pernikahan/{{$nikahId}}" method="post">
      <div class="box-body">

        <div class="form-group">
            {{ csrf_field() }}

            <input type="hidden" readonly name="no_anggota" class="form-control" value="{{ $anggota->no_anggota }}">

            <label for="exampleInputPassword1">Nama Anggota</label>
            <input type="text" readonly class="form-control"
                   placeholder="Nama Anggota" value="{{ $anggota->nama_lengkap }}">
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