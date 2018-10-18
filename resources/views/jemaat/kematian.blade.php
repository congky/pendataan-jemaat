@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Kematian Anggota</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <!--
            <a href="/tambah-data-kematian/-99" class="btn btn-primary">Tambah Data Kematian</a><br><br>
-->
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    @if(authorized("ADMIN"))
                    <th>Aksi</th>
                    @endif
                    <th>No Anggota</th>
                    <th>Nama Lengkap</th>
                    <th>Tempat Pemakaman</th>
                    <th>Tanggal Kematian</th>
                    <th>Tanggal Pemakaman</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key=>$value)
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
                                    <li><a href="/edit-data-kematian/{{ $value->anggota_kematian_id }}">Ubah</a></li>
                                    <li><a href="/hapus-data-kematian/{{ $value->anggota_kematian_id }}">Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                        @endif
                        <td>{{ $value->no_anggota}}</td>
                        <td>{{ $value->nama_lengkap}}</td>
                        <td>{{ $value->tempat_pemakaman}}</td>
                        <td>{{ \App\Helpers\DateUtil::date2_display($value->tgl_kematian)}}</td>
                        <td>{{ \App\Helpers\DateUtil::date2_display($value->tgl_pemakaman)}}</td>
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