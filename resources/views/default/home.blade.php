@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><b>Visi dan Misi GITJ Puring Jepara </b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
                      Visi : <br>
“Membangun Komunitas Damai Sejahtera”<br><br>
Misi :<br>
1.  Membangun Kerukunan dengan Allah, dengan Diri Sendiri, dengan Sesama, dan dengan Alam. <br>
2.  Mengupayakan Kesejahteraan secara Rohani dan Jasmani. <br>



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