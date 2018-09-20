@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Jemaat</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        @if(authorized("ADMIN"))
            <a href="/tambah-jemaat" class="btn btn-primary"> Tambah Jemaat </a>
        @endif

        @if(authorized("ADMIN"))
            <a href="/cetak-all" class="btn btn-primary"> Cetak </a><br><br>
        @endif
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    @if(authorized("ADMIN"))
                    <th>Aksi</th>
                    @endif
                    <th>No Anggota</th>
                    <th>No KK</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>JK</th>>
                    <th>No telepon</th>
                    <th>Tanggal Lahir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggota as $key=>$value)
	                <tr>
                    @if(authorized("ADMIN"))
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info">Aksi</button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/edit-jemaat/{{  $value->anggota_id }}/Y">Ubah</a></li>
                                    @if($value->flg_baptis == "W")
                                        <li><a href="/usul-baptis/{{ $value->anggota_id }}/Y">Usul Baptisan</a></li>
                                    @endif
                                    @if($value->flg_baptis == "Y" && $value->flg_active != "N")
                                        <li><a href="/penyerahan-anak/{{ $value->anggota_id }}">Penyerahan Anak</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                        @endif
	                    <td>{{ $value->no_anggota}}</td>
	                    <td>{{ $value->no_kk}}</td>
                        <td>{{ $value->nama_lengkap}}</td>
                        <td>{{ $value->alamat}}</td>
                        <td>{{ $value->jenis_kelamin}}</td>
                        <td>{{ $value->no_telp}}</td>
                        <td>{{ \App\Helpers\DateUtil::date2_display($value->tgl_lahir) }}</td>
	                </tr>
	            @endforeach
                </tbody>
                </table>

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