@extends("default.default")
@section("head")
    <title>Usulan pernikahan</title>
@endsection

@section("content")

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Usulan Pernikahan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             @if(authorized("ADMIN,JEMAAT"))
            <a href="/tambah-data-usulan-pernikahan" class="btn btn-primary">Tambah Usulan Pernikahan</a><br><br>
            @endif
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@if($role=="PENDETA")
                            Status
                        @else
                            Aksi
                        @endif
                    </th>
                    <th>No Jemaat</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Menikah</th>
                    <th>Nama Jemaat</th>
                    <th>Nama Pasangan</th>
                    <th>Gereja</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggota as $key=>$value)
                    <tr>
                        <td>
                            <div class="btn-group">
                                @if($role=="PENDETA")
                                    Menunggu konfirmasi
                                @else
                                    <button type="button" class="btn btn-info">Aksi</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/edit-data-usulan-pernikahan/{{  $value->usul_anggota_menikah_id }}/usul">Edit</a></li>
                                        <li><a href="/prepare-usulan-pernikahan/{{  $value->usul_anggota_menikah_id }}">Konfirmasi</a></li>
                                        <li><a href="/hapus-data-usulan-pernikahan/{{  $value->usul_anggota_menikah_id }}">Hapus</a></li>
                                    </ul>
                                @endif
                            </div>
                        </td>
                        <td>{{ $value->no_anggota}}</td>
                        <td>{{ \App\Helpers\DateUtil::date2_display($value->tgl_daftar) }}</td>
                        <td>{{ \App\Helpers\DateUtil::date2_display($value->tgl_menikah) }}</td>
                        <td>{{ $value->nama_lengkap}}</td>
                        <td>{{ $value->nama_lengkap_pasangan}}</td>
                        <td>{{ $value->gereja}}</td>
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