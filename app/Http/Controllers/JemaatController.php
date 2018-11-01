<?php

namespace App\Http\Controllers;

use App\Helpers\DateUtil;
use App\User;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Anggota;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Baptisan;
use App\Kematian;
use DB;
use App\PenyerahanAnak;
use PDF;
use App\AnggotaMenikah;

class JemaatController extends Controller
{

    private $mailTo;
    private $nameMailTo;

    public function viewIndex() {

    	$data_anggota = Anggota::all();

        return view("jemaat.index", [
        	"anggota" => $data_anggota
        ]);
    }

    public function viewLihatDataDiri() {

        $no_anggota = \Session::get("HAS_SESSION")["no_anggota"];
        $data_anggota = Anggota::find($no_anggota);

        $baptisan = collect(\DB::Select(" SELECT * FROM t_baptisan WHERE no_anggota = '$no_anggota' "))->first();
        $is_exists = false;
        if(!is_null($baptisan)) {
            $is_exists = true;
        }

        return view("jemaat.lihatDataDiri", [
            "anggota" => $data_anggota,
            "exists" => $is_exists,
            "baptisan" => $baptisan
        ]);
    }

    public function viewBaptisan() {

    	$data_anggota = Anggota::where("flg_baptis", "Y")
            ->join("t_baptisan", "t_anggota.no_anggota","=","t_baptisan.no_anggota")
            ->get();

        return view("jemaat.baptisan", [
        	"anggota" => $data_anggota
        ]);
    }

    public function viewUsulanBaptisan() {

        $data_anggota = Anggota::whereIn("flg_baptis", ["I", "W"])->get();

        return view("jemaat.usulanBaptisan", [
        	"anggota" => $data_anggota,
            "role" => Session::get("HAS_SESSION")["role"]
        ]);
    }

    public function usulanBaptisanJemaat($no_anggota) {

    	$data_anggota = Anggota::find($no_anggota);

        return view("jemaat.usulanBaptisanJemaat", [
            "anggota" => $data_anggota
        ]);

    }

    public function usulanBaptisan($no_anggota, $action) {

        $data_anggota = Anggota::find($no_anggota);
        $data_anggota->flg_baptis = "W";
        $data_anggota->save();

        return redirect('/data-jemaat');

    }

    public function simpanUsulanBaptisanJemaat(Request $request) {
        $data_anggota = Anggota::find(Session::get("HAS_SESSION")["no_anggota"]);
        $data_anggota->flg_baptis = "W";
        $data_anggota->tgl_request_baptis = DateUtil::date2string($request->get("tanggal_baptis"), "Ymd");;
    	$data_anggota->save();

        return redirect("/usul-baptis/".$data_anggota->no_anggota);
    }

     public function viewkonfirmasiUsulan() {

        $data_anggota = Anggota::where("flg_baptis", "I")->get();

        return view("jemaat.usulanBaptisan", [
            "anggota" => $data_anggota
        ]);
    }


    public function konfirmasiUsulan($no_anggota) {

        $data_anggota = Anggota::find($no_anggota);

        return view("jemaat.konfirmasiUsulan")->with("anggota", $data_anggota);

    }

    
    public function tambahJemaat() {
    	return view("jemaat.tambahJemaat");
    }

    public function SimpandaftarJemaat(Request $request) {


        $vaidate = [
            "no_kk"         => "required",
            "nama_lengkap"  => "required",
            "alamat"        => "required",
            "email"         => "required",
            "tempat_lahir"  => "required",
            "tgl_lahir"     => "required",
            "jenis_kelamin" => "required",
            "status"        => "required",
            "pekerjaan"     => "required",
            "kewarganegaraan" => "required",
            "nama_ayah" => "required",
            "nama_ibu" => "required",
            "username" => "required",
            "password" => "required"
            
            
        ];


        if(!is_null($request->get("flg_baptis"))){
          //  $vaidate["period_baptis"] = "required";
            $vaidate["no_baptis"] = "required";
            $vaidate["tanggal_baptis"] = "required";
        }

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $max_no_anggota = collect(DB::Select("SELECT COUNT(1) as count FROM t_anggota"))->first();

        $jemaat = new Anggota();
        $jemaat->no_anggota    = 'A'.substr(date('Y'), -2).sprintf("%04d", $max_no_anggota->count+1);
        $jemaat->no_kk         = $request->get("no_kk");
        $jemaat->nama_lengkap  = $request->get("nama_lengkap");
        $jemaat->alamat        = $request->get("alamat");
        $jemaat->email         = $request->get("email");
        $jemaat->jenis_kelamin = $request->get("jenis_kelamin");
        $jemaat->status        = $request->get("status");
        $jemaat->no_telp       = $request->get("no_telp");
        $jemaat->tempat_lahir  = $request->get("tempat_lahir");
        $jemaat->tgl_lahir     = DateUtil::date2string($request->get("tgl_lahir"), "Ymd");
        $jemaat->pekerjaan     = $request->get("pekerjaan");
        $jemaat->kewarganegaraan = $request->get("kewarganegaraan");
        $jemaat->nama_ayah       = $request->get("nama_ayah");
        $jemaat->nama_ibu        = $request->get("nama_ibu");

        if(is_null($request->get("flg_baptis"))){
            $jemaat->flg_baptis = "N";
        } else {
            $jemaat->flg_baptis = "Y";
        }

        $jemaat->flg_active    = "Y";
        $jemaat->save();

        if(!is_null($request->get("flg_baptis"))){
            $baptisan = new Baptisan();
            $baptisan->no_anggota       = $jemaat->no_anggota;
            $baptisan->no_baptis        = $request->get("no_baptis");
            $baptisan->periode_baptis    = '0';
            $baptisan->tanggal_baptis   = DateUtil::date2string($request->get($request->get("tanggal_baptis"), "Ymd"));
            $baptisan->save();
        }

        $user = new Users();
        $user->no_anggota = $jemaat->no_anggota;
        $user->username = $request->get("username");
        $user->password = md5($request->get("password"));
        $user->role = "JEMAAT";
        $user->flg_active = "Y";
        $user->save();

        return redirect("/data-jemaat");

    }


    public function editJemaat ($no_anggota, $action) {

        $jemaat = Anggota::find($no_anggota);
        $user = Users::where('no_anggota',$no_anggota)->first();

        return view("jemaat.editJemaat", [
            "anggota" => $jemaat,
            "username"=> ($user!=null)?$user->username:"",
            "action" => $action
            ]);

    }

    public function EditdaftarJemaat(Request $request) {

        $vaidate = [
            "no_kk"         => "required",
            "nama_lengkap"  => "required",
            "alamat"        => "required",
            "tempat_lahir"  => "required",
            "tgl_lahir"     => "required",
            "status"        => "required",
            "jenis_kelamin" => "required",
            "username"      => "required"
        ];

        $validator = validator:: make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }
        
        $jemaat = Anggota:: find($request->get("no_anggota"));
        $jemaat->no_kk         = $request->get("no_kk");
        $jemaat->nama_lengkap  = $request->get("nama_lengkap");
        $jemaat->alamat        = $request->get("alamat");
        $jemaat->email         = $request->get("email");
        $jemaat->jenis_kelamin = $request->get("jenis_kelamin");
        $jemaat->status        = $request->get("status");
        $jemaat->no_telp       = $request->get("no_telp");
        $jemaat->tempat_lahir  = $request->get("tempat_lahir");
        $jemaat->tgl_lahir     = DateUtil::date2string($request->get("tgl_lahir"), "Ymd");
     
//        $jemaat->tgl_menikah = DateUtil::date2string($request->get("tanggal_menikah"), "Ymd");
        $jemaat->save();

        $user = Users::where('no_anggota',$request->get("no_anggota"))->first();

        if($user==null){

            $vaidate = [
                "username"      => "required",
                "password"      => "required"
            ];
            $validator = validator:: make($request->all(), $vaidate);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput($request->all())
                    ->withErrors($validator->errors());
            }

            $user = new Users();
            $user->no_anggota = $jemaat->no_anggota;
            $user->username = $request->get("username");
            $user->password = md5($request->get("password"));
            $user->role = "JEMAAT";
            $user->flg_active = "Y";
            $user->save();

        } else {
            $user->username = $request->get("username");
            if ($request->get("password") != null && $request->get("password") != "") {
                $user->password = md5($request->get("password"));
            }
            $user->save();
        }
        if($request->get("action") == "Y") {
            return redirect("/data-jemaat");
        } else {
            return redirect("/lihat-data-diri");
        }


    }

    public function konfirmasiDataUsulan(Request $request) {
        $vaidate = [
            "tanggal_baptis" => "required",
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $anggota = Anggota::find($request->get("no_anggota"));
        $anggota->flg_baptis = "I";
        $anggota->save();

        $this->mailTo = $anggota->email;
        $this->nameMailTo = $anggota->nama_lengkap;

        $max_no_baptis = collect(DB::Select("SELECT COUNT(1) as count FROM t_baptisan"))->first();

        $baptis = new Baptisan();
        $baptis->no_anggota = $anggota->no_anggota;
        $baptis->no_baptis = 'B'.substr(date('Y'), -2).sprintf("%04d", $max_no_baptis->count+1);
//        $baptis->periode_baptis = $request->get("period_baptis");
        $baptis->tanggal_baptis = DateUtil::date2string($request->get("tanggal_baptis"), "Ymd");
        $baptis->save();


        $data = array('pesan'=> $request->get("pesan"),
                        'name'=> $anggota->nama_lengkap);
        Mail::send('mail', $data, function($message) {
            $message->to($this->mailTo, $this->nameMailTo)->subject
            ('Pemberitahuan Baptis');
            $message->from('admin@gmail.com','Admin');
        });

        return redirect("/data-usulan-baptisan");

    }

    public function prosesDataUsulan($no_anggota) {

        $anggota = Anggota::find($no_anggota);
        $anggota->flg_baptis = "Y";
        $anggota->save();

        return redirect("/data-usulan-baptisan");

    }

    public function dataKematian() {

        $kematian = DB::Select("
            SELECT *
            FROM t_anggota A
            INNER JOIN t_kematian B ON A.no_anggota = B.no_anggota");

        return view("jemaat.kematian", ["data" => $kematian]);

    }

    public function tambahDataKematian($id) {

        $anggota = DB::Select("
                    SELECT *
                    FROM t_anggota A
                    WHERE NOT EXISTS (SELECT 1 FROM t_kematian B WHERE A.no_anggota = B.no_anggota)
                    ORDER BY nama_lengkap
                ");

        $selectedAnggotaId = -99;
        if(!is_null($id) && $id!=-99){
            $selectedAnggota = Anggota::find($id);
            $selectedAnggotaId = $selectedAnggota->no_anggota;
        }

        return view("jemaat.tambahDataKematian", ["anggota" => $anggota, "selectedAnggotaId"=>$selectedAnggotaId]);
    }

    public function doTambahDataKematian(Request $request) {

        $vaidate = [
            "jemaat" => "required",
            "tempat_pemakaman" => "required",
            "tgl_pemakaman" => "required",
            "tgl_kematian" => "required"
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        if(DateUtil::date2string($request->get('tgl_pemakaman'), 'Ymd') < DateUtil::date2string($request->get('tgl_kematian'), 'Ymd')) {
            Session::flash('err_msg', 'Tanggal kematian harus lebih kecil atau sama dengan tanggal pemakaman');
            return redirect()->back();
        }

        $kematian = new Kematian();
        $kematian->no_anggota = $request->get("jemaat");
        $kematian->tempat_pemakaman = $request->get("tempat_pemakaman");
        $kematian->tgl_pemakaman = DateUtil::date2string($request->get('tgl_pemakaman'), 'Ymd');
        $kematian->tgl_kematian = DateUtil::date2string($request->get('tgl_kematian'), 'Ymd');
        $kematian->save();

        $anggota = Anggota::find($request->get("jemaat"));
        $anggota->flg_active = "N";
        $anggota->save();

        return redirect("/data-kematian");

    }

    public function hapusDataKematian($id) {

        $kematian = Kematian::find($id);

        $anggota = Anggota::find($kematian->no_anggota);
        $anggota->flg_active = "Y";
        $anggota->save();

        $kematian->delete();

        return redirect("/data-kematian");

    }

    public function penyerahanAnak($no_anggota) {

        $anggota = Anggota::find($no_anggota);

        $penyerahan_anak = PenyerahanAnak::where("no_anggota", $no_anggota)->get();

        \Log::debug(json_encode($penyerahan_anak));

        return view("jemaat.penyerahanAnak", ["penyerahanAnak" => $penyerahan_anak, "anggota" => $anggota]);

    }

    public function doSimapnPenyerahanAnak(Request $request) {

        $vaidate = [
            "no_anggota"           => "required",
            "nama_anak"            => "required",
            "tempat_lahir"         => "required",
            "tgl_lahir"            => "required",
            "tanggal_penyerahan"   => "required",
            "jenis_kelamin"        => "required",
            "nama_ayah"            => "required",
            "nama_ibu"             => "required",
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $penyerahan_anak = new PenyerahanAnak();
        $penyerahan_anak->no_anggota = $request->get("no_anggota");
        $penyerahan_anak->nama_anak = $request->get("nama_anak");
        $penyerahan_anak->tempat_lahir = $request->get("tempat_lahir");
        $penyerahan_anak->tgl_lahir = DateUtil::date2string($request->get("tgl_lahir"), 'Ymd');
        $penyerahan_anak->tanggal_penyerahan = DateUtil::date2string($request->get("tanggal_penyerahan"), 'Ymd');
        $penyerahan_anak->jenis_kelamin = $request->get("jenis_kelamin");
        $penyerahan_anak->nama_ayah = $request->get("nama_ayah");
        $penyerahan_anak->nama_ibu = $request->get("nama_ibu");
        $penyerahan_anak->save();

        return redirect()->back();

    }

    public function  hapusSimapnPenyerahanAnak($penyerahan_anak_id) {

        $penyerahan_anak = PenyerahanAnak::find($penyerahan_anak_id);
        $penyerahan_anak->delete();

        return redirect()->back();

    }

    public function editDataKematin($id) {

        $kematin = Kematian::find($id);

        $anggota = Anggota::find($kematin->no_anggota);

        return view('jemaat.editDataKematian', [
            "kematian" => $kematin,
            "anggota" => $anggota
        ]);

    }

    public function doEditDataKematin(Request $request) {

        $vaidate = [
            "tempat_pemakaman" => "required",
            "tgl_pemakaman" => "required",
            "tgl_kematian" => "required"
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if(DateUtil::date2string($request->get('tgl_pemakaman'), 'Ymd') < DateUtil::date2string($request->get('tgl_kematian'), 'Ymd')) {
            Session::flash('err_msg', 'Tanggal kematian harus lebih kecil atau sama dengan tanggal pemakaman');
            return redirect()->back();
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $kematian = Kematian::find($request->get("anggota_kematian_id"));
        $kematian->tempat_pemakaman = $request->get("tempat_pemakaman");
        $kematian->tgl_pemakaman = DateUtil::date2string($request->get('tgl_pemakaman'), 'Ymd');
        $kematian->tgl_kematian = DateUtil::date2string($request->get('tgl_kematian'), 'Ymd');
        $kematian->save();

        return redirect("/data-kematian");

    }
    public function cetak($id) {

        $baptisan = Baptisan::find($id);
        $anggota = Anggota::find($baptisan->no_anggota);

        $pdf = PDF::loadView('jemaat.cetak', ["baptisan" => $baptisan, "anggota" => $anggota], []);
        return $pdf->stream("Cetak".'.pdf');
    }

    public function editBaptisan($id) {

        $baptisan = Baptisan::find($id);
        $anggota = Anggota::find($baptisan->no_anggota);

        return view('jemaat.editBaptisan', ["baptisan" => $baptisan, "anggota" => $anggota]);


    }

    public function doEditBaptisan(Request $request) {
        $vaidate = [
            "tanggal_baptis" => "required"
        ];

        $validator = Validator::make($request->all(), $vaidate);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $baptisan = Baptisan::find($request->get("no_baptis"));
        $baptisan->tanggal_baptis = DateUtil::date2string($request->get("tanggal_baptis"), "Ymd");
        $baptisan->save();

        return redirect("/data-baptisan");

    }

    public function cetakAll() {

        $anggota = Anggota::where("flg_active", "Y")->get();

        $pdf = PDF::loadView('jemaat.cetakSemuaJemaat', ["jemaat" => $anggota], []);
        return $pdf->stream("CetakSemuaJemaat".'.pdf');

    }

     public function cetakBaptis() {

    $baptisan = Baptisan::find($request->get("no_baptis"));
     $pdf = PDF::loadView('baptisan.cetakSemuaBaptisan', ["baptisan" => $anggota], []);
     return $pdf->stream("CetakSemuaBaptisan".'.pdf');

    }
   

    public function cariPasangan() {

        $anggota = Anggota::where("flg_active", "Y")->get();

        return view("jemaat.cariPasangan", [
            "anggota" => $anggota
        ]);

    }

    public function usulMenikahJemaat($id) {
        $anggota = Anggota::find($id);
        $anggotaMenikah = AnggotaMenikah::where("no_anggota", $anggota->no_anggota)->first();

        $statusMenikah = false;

        if(!is_null($anggotaMenikah)) {
            $statusMenikah = true;
        }

        return view("jemaat.jemaatUsulMenikah", [
                        "anggota" => $anggota,
                        "currentDate" => date('Y-m-d'),
                        "statusMenikah" => $statusMenikah
                    ]);

    }

    public function simpanUsulanJemaat(Request $request) {

        $vaidate = [
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
        $menikah->no_anggota = $request->get("no_anggota");
        $menikah->tgl_daftar = DateUtil::dateNow();
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

        return redirect("/lihat-data-diri");

    }
}