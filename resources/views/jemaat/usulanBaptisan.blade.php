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
                    <th>Nama Lengkap</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggota as $key=>$value)
	                <tr>
                        <td>
                            @if($value->flg_baptis == "N")
                                <a href="/konfirmasi-usul-baptis/{{ $value->anggota_id }}">Konfirmasi</a>
                            @endif
                            @if($value->flg_baptis == "I")
                                <a href="/proses-usul-baptis/{{ $value->anggota_id }}">Proses</a>
                            @endif
                        </td>
	                    <td>{{ $value->no_anggota}}</td>
	                    <td>{{ $value->nama_lengkap}}</td>
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