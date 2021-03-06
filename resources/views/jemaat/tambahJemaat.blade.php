@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Jemaat</h3>
    </div>
  <div class="box-body">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/simpan-daftar-jemaat" method="post">

        {{ csrf_field() }}

     <div class="row">
     <div class="col-md-15">

    <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">No KK <label class="text-danger">*</label></label>
          <input type="text" name="no_kk" class="form-control"  placeholder="nomer kk">
          <label class="text-danger">{{$errors->first("no_kk") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputNamaLengkap">Nama Lengkap <label class="text-danger">*</label></label>
          <input type="text" name="nama_lengkap" class="form-control" placeholder="nama lengkap">
          <label class="text-danger">{{$errors->first("nama_lengkap") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Alamat <label class="text-danger">*</label></label>
          <input type="text" name="alamat"  class="form-control" placeholder="alamat" >
          <label class="text-danger">{{$errors->first("alamat") }}</label>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Email <label class="text-danger">*</label></label>
          <input type="email" name="email" class="form-control" placeholder="email" >
            <label class="text-danger">{{$errors->first("email") }}</label>
        </div>

          <div class="form-group">
              <label for="exampleInputUsername">Username <label class="text-danger">*</label></label>
              <input type="text" name="username" class="form-control" placeholder="username">
              <label class="text-danger">{{$errors->first("username") }}</label>
          </div>

          <div class="form-group">
              <label for="exampleInputUsername">Password <label class="text-danger">*</label></label>
              <input type="password" name="password" class="form-control" placeholder="password">
              <label class="text-danger">{{$errors->first("password") }}</label>
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Jenis Kelamin <label class="text-danger">*</label></label> <br>
          <label>
            <input type="radio" name="jenis_kelamin" value="P"> Perempuan
        </label>

          <label>
            <input type="radio" name="jenis_kelamin" value="L"> Laki-Laki
        </label><br>
        <label class="text-danger">{{$errors->first("jenis_kelamin") }}</label>
        </div>
        <div class="form-group">
              <label for="exampleInputUsername">Status<label class="text-danger">*</label></label>
              <input type="text" name="status" class="form-control" placeholder="status">
              <label class="text-danger">{{$errors->first("status") }}</label>
          </div>
        <div class="form-group">
          <label for="exampleInputFile">No Telepon</label>
          <input type="text" name="no_telp"  class="form-control" placeholder="nomer telepon" >
        </div>

          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

          <div class="col-md-6">
        
        <div class="form-group">
          <label for="exampleInputFile">Tempat Lahir <label class="text-danger">*</label></label>
          <input type="text" name="tempat_lahir"  class="form-control" placeholder="tempat lahir" >
          <label class="text-danger">{{$errors->first("tempat_lahir") }}</label>
        </div>       
       
        <div class="form-group">
          <label for="exampleInputFile">Tanggal Lahir <label class="text-danger">*</label></label>
          <input type="date" name="tgl_lahir"  class="form-control" placeholder="tanggal lahir" >
        <label class="text-danger">{{$errors->first("tgl_lahir") }}</label>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Pekerjaan <label class="text-danger">*</label></label>
          <input type="text" name="pekerjaan"  class="form-control" placeholder="pekerjaan" >
        <label class="text-danger">{{$errors->first("pekerjaan") }}</label>
        </div>

     <div class="form-group">
       <label for="exampleInputFile">Kewarganegaraan <label class="text-danger">*</label></label>
         <select name="kewarganegaraan" class="form-control">
        <option value="WNI" selected>WNI</option>
             <option value="WNA" selected>WNA</option>
       </select>
        <label class="text-danger">{{$errors->first("kewarganegaraan") }}</label>
       </div>
      <div class="form-group">
      <label for="exampleInputFile">Nama Ayah <label class="text-danger">*</label></label>
       <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah ">
      <label class="text-danger">{{$errors->first("nama_ayah") }}</label>
        </div>

         <div class="form-group">
         <label for="exampleInputFile">Nama Ibu <label class="text-danger">*</label></label>
          <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu">
          <label class="text-danger">{{$errors->first("nama_ibu") }}</label>
          </div>     

       <!--- {{--<div class="form-group">--}}
          {{--<label for="exampleInputFile">Tanggal Menikah</label>--}}
          {{--<input type="date" name="tanggal_menikah"  class="form-control" placeholder="tanggal menikah" >--}}
        {{--</div>--}} -->
        <div class="checkbox">
          <label>
            <input type="checkbox" name="flg_baptis"> Sudah dibaptis
          </label>
        </div>
       <!--- <div class="form-group">
          <label for="exampleInputFile">Periode Baptis <label class="text-danger">*</label></label>
          <select name="period_baptis" class="form-control">
                    <option value="1">Minggu 1</option>
                    <option value="2">Minggu 2</option>
                    <option value="3">Minggu 3</option>
                    <option value="4">Minggu 4</option>
                    <option value="5">Minggu 5</option>
                  </select>
        </div> -->
        <div class="form-group">
          <label for="exampleInputFile">Nomer Baptis <label class="text-danger">*</label></label>
          <input type="text" name="no_baptis"  class="form-control" placeholder="Nomer Baptis" >
          <label class="text-danger">{{$errors->first("no_baptis") }}</label>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Tanggal Baptis <label class="text-danger">*</label></label>
          <input type="date" name="tanggal_baptis"  class="form-control" placeholder="tanggal baptis" >
        <label class="text-danger">{{$errors->first("tanggal_baptis") }}</label>
        </div>



      </div>

      </div>
        
      </div>
    </form>
    </div>
  </div>
  @endsection