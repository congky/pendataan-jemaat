<h2 style="text-align:center;">DATA JEMAAT GITJ PURING JEPARA TAHUN 2018</h2><br>
<br>
<br>
<table border="1" align="center">
    <tr>
        <td><b>No</td>
        <td><b>No Anggota</td>
        <td><b>No KK</td>
        <td><b>Nama Lengkap</td>
        <td><b>Alamat</td>
        <td><b>JK</td>
        <td><b>No Telp</td>
        <td><b>Tanggal Lahir</td>
    </tr>
    <?php $no=1; ?>
    @foreach($jemaat as $value)
        <tr>
            <td><?php echo $no++; ?></td>
            <td>{{ $value->no_anggota }}</td>
            <td>{{ $value->no_kk }}</td>
            <td>{{ $value->nama_lengkap }}</td>
            <td>{{ $value->alamat }}</td>
            <td>{{ $value->jenis_kelamin }}</td>
            <td>{{ $value->no_telp }}</td>
            <td>{{ \App\Helpers\DateUtil::date2_display($value->tgl_lahir) }}</td>
        
        </tr>
    @endforeach
</table>