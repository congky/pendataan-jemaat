<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Untitled Document</title>
</head>

<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="717" height="608" border="0" align="middle" style="margin-left:50px">
    <tr>
        <td height="58" colspan="3"><div align="center"><strong><center>SURAT TANDA BAPTIS</center></strong> </div></td>
    </tr>
    <tr>
        <td height="55" colspan="3"><p>Majelis  Gereja Injili di Tanah Jawa (GITJ) Puring </p>
            <p>menerangkan dengan sesungguhnya bahwa  Saudara yang tersebut di bawah ini :<br />
            </p></td>
    </tr>
    <tr>
        <td width="50" height="34">&nbsp;</td>
        <td width="159">Nomer baptis </td>
        <td width="543">:
            {{ $baptisan->no_baptis }}
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>No Anggota </td>
        <td>:
        {{ $anggota->no_anggota }}
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Nama</td>
        <td>:
        {{ $anggota->nama_lengkap }}
    </tr>
    <tr>
        <td height="40">&nbsp;</td>
        <td>Tempat, Tanggal Lahir </td>
        <td>:
        {{ $anggota->tempat_lahir }}, {{ \App\Helpers\DateUtil::date2_display($anggota->tgl_lahir) }}
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Alamat</td>
        <td>:
        {{ $anggota->alamat }}
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Tanggal </td>
        <td>:
        {{ \App\Helpers\DateUtil::date2_display($baptisan->tanggal_baptis) }}
    </tr>
    <tr>
        <td height="48" colspan="3">Telah  menyatakan imannya kepada Tuhan Yesus Kristus dan dibaptis dengan  disaksikan oleh Jemaat GITJ Puring.</td>
    </tr>
    <tr>
        <td height="27" colspan="3"><table width="760" height="52" border="0">
                <tr>
                    <td width="369"><p align="center">Sekretaris,</p>
                        <p align="center">&nbsp;</p><br><br>
                        <p align="center">Harnoto Badi</p></td>
                    <td width="381"><p align="center">Jepara,  {{ \App\Helpers\DateUtil::date2_display($baptisan->tanggal_baptis) }}<br />
                            Gembala Sidang,</p>
                        <p align="center">&nbsp;</p><br><br>
                        <p align="center">Pdt. Herlistyana S.th </p></td>
                </tr>
            </table>      <p align="center">&nbsp;</p>    </td>
    </tr>
</table>
</body>
</html>