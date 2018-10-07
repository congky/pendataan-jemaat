@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Jemaat</h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No Anggota</th>
                    <th>Nama Lengkap</th>
                    <th>Jk</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggota as $key=>$value)
                    <tr>
                        <td>
                            <a href="/penyerahan-anak/{{ $value->no_anggota }}">Jadikan Pasangan</a>
                        </td>
                        <td>{{ $value->no_anggota}}</td>
                        <td>{{ $value->nama_lengkap}}</td>
                        <td>{{ $value->jenis_kelamin}}</td>
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