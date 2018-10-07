@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Jemaat</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
   <form action="/edit-daftar-jemaat01" method="post">

  {{ csrf_field() }}
  <input type="hidden" name="no_anggota" class="form-control" value="{{ $anggota->no_anggota }}">
  <input type="hidden" name="action" class="form-control" value="{{ $action }}">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">No KK <label class="text-danger">*</label></label>
          <input type="text" name="no_kk" class="form-control" value="{{ $anggota->no_kk }}">
          <label class="text-danger">{{$errors->first("no_kk") }}</label>
        </div>
        

        <div class="form-group">
          <label for="exampleInputPassword1">Nama Lengkap <label class="text-danger">*</label></label>
          <input type="text" name="nama_lengkap" class="form-control" value="{{ $anggota->nama_lengkap }}">
          <label class="text-danger">{{$errors->first("nama_lengkap") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Alamat <label class="text-danger">*</label></label>
          <input type="text" name="alamat"  class="form-control" value="{{ $anggota->alamat }}" >
          <label class="text-danger">{{$errors->first("alamat") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Email</label>
          <input type="email" name="email" class="form-control" value="{{ $anggota->email }}" >
          <label class="text-danger">{{$errors->first("email") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Username <label class="text-danger">*</label></label>
          <input type="text" name="username"  class="form-control" value="{{ $username}}" >
          <label class="text-danger">{{$errors->first("username") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Password</label>
          <input type="password" name="password" class="form-control" value="{{ $anggota->password }}" >
          <label class="text-danger">{{$errors->first("password") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Jenis Kelamin <label class="text-danger">*</label></label> <br>
          <label>

          @if($anggota->jenis_kelamin == "P")
            <input type="radio" name="jenis_kelamin" value="P" checked> Perempuan

          @else
            <input type="radio" name="jenis_kelamin" value="P"> Perempuan
          @endif

      	</label>

          <label>
         @if($anggota->jenis_kelamin == "L")
            <input type="radio" name="jenis_kelamin" value="L" checked> Laki-Laki

          @else
            <input type="radio" name="jenis_kelamin" value="L"> Laki-Laki
          @endif
      	</label><br>
          <label class="text-danger">{{$errors->first("jenis_kelamin") }}</label>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">No Telepon</label>
          <input type="text" name="no_telp"  class="form-control" value="{{ $anggota->no_telp}}" >
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Tempat Lahir <label class="text-danger">*</label></label>
          <input type="text" name="tempat_lahir"  class="form-control" value="{{ $anggota->tempat_lahir }}" >
       <label class="text-danger">{{$errors->first("tempat_lahir") }}</label>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Tanggal Lahir <label class="text-danger">*</label></label>
          <input type="date" name="tgl_lahir"  class="form-control" value="{{ \App\Helpers\DateUtil::date_display($anggota->tgl_lahir) }}" >
       <label class="text-danger">{{$errors->first("tgl_lahir") }}</label>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Pekerjaan <label class="text-danger">*</label></label>
          <input type="text" name="pekerjaan"  class="form-control" value="{{ $anggota->pekerjaan }}" }}" >
       <label class="text-danger">{{$errors->first("pekerjaan") }}</label>
        </div>
<div class="form-group">
      <label for="exampleInputFile">Kewarganegaraan <label class="text-danger">*</label></label>
      <select name="kewarganegaraan" class="form-control">
          @if($anggota->kewarganegaraan == "WNI")
              <option value="WNI" selected>WNI</option>
              <option value="WNA">WNA</option>
          @endif
          @if($anggota->kewarganegaraan == "WNA")
              <option value="WNI">WNI</option>
              <option value="WNA" selected>WNA</option>
          @endif
      </select>
      <label class="text-danger">{{$errors->first("kewarganegaraan") }}</label>
  </div>

  <div class="form-group">
      <label for="exampleInputFile">Nama Ayah  <label class="text-danger">*</label></label>
      <input type="text" name="nama_ayah_pria" class="form-control" placeholder="Nama Ayah" value="{{ $anggota->nama_ayah }}">
      <label class="text-danger">{{$errors->first("nama_ayah") }}</label>
  </div>

  <div class="form-group">
      <label for="exampleInputFile">Nama Ibu <label class="text-danger">*</label></label>
      <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="{{ $anggota->nama_ibu }}">
      <label class="text-danger">{{$errors->first("nama_ibu") }}</label>
  </div>

        
       <!--- {{--<div class="form-group">--}}
          {{--<label for="exampleInputFile">tanggal Menikah</label>--}}
          {{--<input type="text" name="tanggal_menikah"  class="form-control" value="{{ $anggota->tgl_menikah }}" >--}}
        {{--</div>--}} -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
  @endsection