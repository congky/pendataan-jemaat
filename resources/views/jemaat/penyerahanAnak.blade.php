@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Penyerahan Anak: {{ $anggota->nama_lengkap }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">

                <form role="form" action="/simpan-penyerahan-anak" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="anggota_id" class="form-control" value="{{ $anggota->anggota_id }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Nama Anak <label class="text-danger">*</label></label>
                            <input type="text" name="nama_anak" class="form-control" placeholder="Nama Anak">
                            <label class="text-danger">{{$errors->first("nama_anak") }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Tempat Lahir <label class="text-danger">*</label></label>
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                            <label class="text-danger">{{$errors->first("tempat_lahir") }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Tanggal Lahir <label class="text-danger">*</label></label>
                            <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir">
                            <label class="text-danger">{{$errors->first("tgl_lahir") }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Tanggal Penyerahan <label class="text-danger">*</label></label>
                            <input type="date" name="tgl_penyerahan" class="form-control" placeholder="Tanggal Penyerahan">
                            <label class="text-danger">{{$errors->first("tgl_penyerahan") }}</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    <div class="col-md-6">
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
                            <label for="exampleInputFile">Nama Ayah <label class="text-danger">*</label></label>
                            <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah">
                            <label class="text-danger">{{$errors->first("nama_ayah") }}</label>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Nama Ibu <label class="text-danger">*</label></label>
                            <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu">
                            <label class="text-danger">{{$errors->first("nama_ibu") }}</label>
                        </div>

                    </div>
                </form>

                <div class="col-md-12"><br><br>
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama Anak</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Tgl Penyerahan</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($penyerahanAnak as $key=>$value)
                            <tr>
                                <td><a href="/hapus-penyerahan-anak/{{ $value->penyerahan_anak_id }}">Hapus</a></td>
                                <td>{{ $value->nama_anak }}</td>
                                <td>{{ $value->tempat_lahir }}</td>
                                <td>{{ $value->tgl_lahir }}</td>
                                <td>{{ $value->tgl_penyerahan }}</td>
                                <td>{{ ($value->jenis_kelamin == "L")? "Laki-Laki" : "Perempuan" }}</td>
                                <td>{{ $value->nama_ayah }}</td>
                                <td>{{ $value->nama_ibu }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection
@section("before_end_body")
    <script>
        $(function () {
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>
@endsection