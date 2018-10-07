@extends("default.default")
@section("head")
    <title>Usulan baptisan</title>
@endsection

@section("content")

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
          @if($anggota->flg_baptis!='N')
              Anda sudah mengusulkan baptisan
          @else
              Usulkan baptisan
          @endif
      </h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    @if($anggota->flg_baptis=='N')
    <form role="form" action="/simpan-usulan-baptisan-jemaat" method="post">
      <div class="box-body">

        <div class="form-group">
            {{ csrf_field() }}

            <input type="hidden" readonly name="no_anggota" class="form-control" value="{{ $anggota->no_anggota }}">

            <label for="exampleInputPassword1">Nama Anggota</label>
            <input type="text" readonly class="form-control"
                   placeholder="Nama Anggota" value="{{ $anggota->nama_lengkap }}">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Tanggal Baptis <label class="text-danger">*</label></label>
          <input type="date" name="tanggal_baptis" class="form-control" placeholder="Tanggal Baptis">
          <label class="text-danger">{{$errors->first("tanggal_baptis") }}</label>
        </div>

      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    @endif
  </div>
  @endsection