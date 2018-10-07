<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\AnggotaMenikah;
use App\Helpers\DateUtil;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Validator;

class PernikahanController extends Controller
{

    private $mailTo;
    private $nameMailTo;

    public function lihatDataUsulPernikahan() {
        $anggota = DB::Select("
                    SELECT *
                    FROM t_anggota A
                    INNER JOIN t_anggota_menikah B ON A.no_anggota = B.no_anggota
                    WHERE flg_menikah IN ('I', 'N')
                ");

        return view("pernikahan.lihatDataUsulPernikahan",
                    [
                        "anggota" => $anggota,
                        "role" => Session::get("HAS_SESSION")["role"]
                    ]);
    }

    public function lihatDataPernikahan() {
        $anggota = DB::Select("
                    SELECT *
                    FROM t_anggota A
                    INNER JOIN t_anggota_menikah B ON A.no_anggota = B.no_anggota
                    WHERE flg_menikah IN ('Y')
                ");

        return view("pernikahan.lihatDataPernikahan", ["anggota" => $anggota]);
    }

    public function tambahDataUsulanPernikahan() {

        $anggota = DB::Select("
                    SELECT *
                    FROM t_anggota A
                    WHERE NOT EXISTS (SELECT 1 FROM t_anggota_menikah B WHERE A.no_anggota = B.no_anggota)
                      AND A.flg_active = 'Y'
                    ORDER BY nama_lengkap
                ");


        return view("pernikahan.tambahDataUsulanPernikahan", ["anggota" => $anggota]);
    }

    public function doTambahDataUsulanPernikahan(Request $request) {

        $vaidate = [
            "jemaat" => "required",
            "tgl_daftar" => "required",
            "nama_lengkap_pasangan" => "required",
            "tempat_lahir_pasangan" => "required",
            "alamat_pasangan" => "required",
            "no_tlp_pasangan" => "required",
            "pekerjaan_pasangan" => "required",
            "kewarganegaraan_pasangan" => "required",
            "nama_ayah_pasangan" => "required",
            "nama_ibu_pasangan" => "required",
            "tgl_menikah" => "required",
            "tgl_lahir_pasangan" => "required",
            "gereja" => "required"
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $menikah = new AnggotaMenikah();
        $menikah->no_anggota = $request->get("jemaat");
        $menikah->tgl_daftar = DateUtil::date2string($request->get('tgl_daftar'), 'Ymd');
        $menikah->nama_lengkap_pasangan = $request->get("nama_lengkap_pasangan");
        $menikah->tempat_lahir_pasangan = $request->get("tempat_lahir_pasangan");
        $menikah->tgl_lahir_pasangan = DateUtil::date2string($request->get("tgl_lahir_pasangan"), 'Ymd');
        $menikah->alamat_pasangan = $request->get("alamat_pasangan");
        $menikah->no_tlp_pasangan = $request->get("no_tlp_pasangan");
        $menikah->pekerjaan_pasangan = $request->get("pekerjaan_pasangan");
        $menikah->kewarganegaraan_pasangan = $request->get("kewarganegaraan_pasangan");
        $menikah->nama_ayah_pasangan = $request->get("nama_ayah_pasangan");
        $menikah->nama_ibu_pasangan = $request->get("nama_ibu_pasangan");
        $menikah->tgl_menikah = DateUtil::date2string($request->get("tgl_menikah"), 'Ymd');
        $menikah->gereja = $request->get("gereja");
        $menikah->flg_menikah = "N";
        $menikah->save();

        return redirect("/lihat-data-usulan-pernikahan");

    }

    public function doHapusDataUsulanPernikahan($usulan_menikah_anggota_id) {

        AnggotaMenikah::find($usulan_menikah_anggota_id)->delete();

        return redirect()->back();

    }

    public function prepareProsesDataUsulanPernikahan($usulan_menikah_anggota_id) {

        $anggota_menikah = AnggotaMenikah::find($usulan_menikah_anggota_id);

        $anggota = Anggota::find($anggota_menikah->no_anggota);
        return view("pernikahan.konfirmasiUsulanPernikahan", ["anggota" => $anggota, "nikahId"=>$usulan_menikah_anggota_id]);
    }

    public function doProsesDataUsulanPernikahan(Request $request, $usulan_menikah_anggota_id) {

        $anggota_menikah = AnggotaMenikah::find($usulan_menikah_anggota_id);
        $anggota_menikah->flg_menikah = "Y";
        $anggota_menikah->save();

        $anggota = Anggota::find($anggota_menikah->no_anggota);

        $this->mailTo = $anggota->email;
        $this->nameMailTo = $anggota->nama_lengkap;

        $data = array('pesan'=> $request->get("pesan"),
            'name'=> $anggota->nama_lengkap);
        Mail::send('mail', $data, function($message) {
            $message->to($this->mailTo, $this->nameMailTo)->subject
            ('Pemberitahuan Pernikahan');
            $message->from('admin@gmail.com','Admin');
        });

        return redirect('/lihat-data-usulan-pernikahan');

    }

    public function editDataPernikahan($id, $action) {

        $menikah = AnggotaMenikah::find($id);

        $anggota = Anggota::find($menikah->no_anggota);

        return view("pernikahan.editDataPernikahan", [
            "menikah" => $menikah,
            "anggota" => $anggota,
            "action" => $action
        ]);

    }

    public function doEditDataPernikahan(Request $request) {

        $vaidate = [
            "tgl_daftar" => "required",
            "nama_lengkap_pasangan" => "required",
            "tempat_lahir_pasangan" => "required",
            "alamat_pasangan" => "required",
            "no_tlp_pasangan" => "required",
            "pekerjaan_pasangan" => "required",
            "kewarganegaraan_pasangan" => "required",
            "nama_ayah_pasangan" => "required",
            "nama_ibu_pasangan" => "required",
            "tgl_menikah" => "required",
            "tgl_lahir_pasangan" => "required",
            "gereja" => "required"
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $menikah = AnggotaMenikah::find($request->get("usul_anggota_menikah_id"));
        $menikah->tgl_daftar = DateUtil::date2string($request->get('tgl_daftar'), 'Ymd');
        $menikah->nama_lengkap_pasangan = $request->get("nama_lengkap_pasangan");
        $menikah->tempat_lahir_pasangan = $request->get("tempat_lahir_pasangan");
        $menikah->tgl_lahir_pasangan = DateUtil::date2string($request->get("tgl_lahir_pasangan"), 'Ymd');
        $menikah->alamat_pasangan = $request->get("alamat_pasangan");
        $menikah->no_tlp_pasangan = $request->get("no_tlp_pasangan");
        $menikah->pekerjaan_pasangan = $request->get("pekerjaan_pasangan");
        $menikah->kewarganegaraan_pasangan = $request->get("kewarganegaraan_pasangan");
        $menikah->nama_ayah_pasangan = $request->get("nama_ayah_pasangan");
        $menikah->nama_ibu_pasangan = $request->get("nama_ibu_pasangan");
        $menikah->tgl_menikah = DateUtil::date2string($request->get("tgl_menikah"), 'Ymd');
        $menikah->gereja = $request->get("gereja");
        $menikah->save();

        if($request->get("action") == "usul") {
            return redirect("/lihat-data-usulan-pernikahan");
        } else {
            return redirect("/lihat-data-pernikahan");
        }


    }

}
