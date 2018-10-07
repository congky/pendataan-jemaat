@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No Anggota</th>
                    <th>No Baptis</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Baptis</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggota as $key=>$value)
	                <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info">Aksi</button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/edit-baptisan/{{  $value->no_baptis }}">Ubah</a></li>
                                    <li><a href="/cetak-baptisan/{{ $value->no_baptis }}" target="_blank">Cetak</a></li>
                                </ul>
                            </div>
                        </td>
	                    <td>{{ $value->no_anggota}}</td>
	                    <td>{{ $value->no_baptis}}</td>
	                    <td>{{ $value->nama_lengkap}}</td>
                        <td>{{ \App\Helpers\DateUtil::date2_display($value->tanggal_baptis)}}</td>
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