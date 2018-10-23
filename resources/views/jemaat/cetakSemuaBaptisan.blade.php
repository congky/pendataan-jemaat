<h2 style="text-align:center;">DATA BAPTISAN GITJ PURING JEPARA TAHUN 2018</h2><br>
<br>
<br>
<table border="1" align="center" >
    <tr >
        <td><b>No Anggota</td>
        <td><b>No Baptis</td>
        <td><b>Nama Lengkap</td>
        <td><b>Tanggal Baptis</td>
    </tr>
    <?php $no=1; ?>
    @foreach($baptisan as $value)
        <tr>
            <td><?php echo $no++; ?></td>
            <td>{{ $value->no_anggota }}</td>
            <td>{{ $value->no_baptis }}</td>
            <td>{{ $anggota->nama_lengkap }}</td>
            <td>{{ $value->tanggal_baptis }}</td>        
        </tr>
    @endforeach
</table>