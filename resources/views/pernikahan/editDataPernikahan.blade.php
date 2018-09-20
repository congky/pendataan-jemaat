@extends("default.default")
@section("head")
    <title>Home</title>
@endsection

@section("content")

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Data Pernikahan</h3>
        </div>

        <div class="box-body">

            <form role="form" action="/do-simpan-data-usulan" method="post">

                {{ csrf_field() }}

                <input type="hidden" name="usul_anggota_menikah_id" class="form-control"  value="{{ $menikah->usul_anggota_menikah_id }}">
                <input type="hidden" name="action" class="form-control"  value="{{ $action }}">

                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Jemaat <label class="text-danger">*</label></label>
                                <input type="text" readonly class="form-control" value="{{ $anggota->no_anggota." - ".$anggota->nama_lengkap }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Daftar <label class="text-danger">*</label></label>
                                <input type="date" name="tgl_daftar" class="form-control" placeholder="Tanggal Daftar" value="{{ \App\Helpers\DateUtil::date_display($menikah->tgl_daftar) }}">
                                <label class="text-danger">{{$errors->first("tgl_daftar") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Lengkap Pasangan <label class="text-danger">*</label></label>
                                <input type="text" name="nama_lengkap_pasangan" class="form-control" placeholder="Nama Lengkap pasangan" value="{{ $menikah->nama_lengkap_pasangan }}">
                                <label class="text-danger">{{$errors->first("nama_lengkap_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Tempat Lahir pasangan <label class="text-danger">*</label></label>
                                <input type="text" name="tempat_lahir_pasangan" class="form-control" placeholder="Tempat Lahir pasangan" value="{{ $menikah->tempat_lahir_pasangan }}">
                                <label class="text-danger">{{$errors->first("tempat_lahir_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Lahir pasangan <label class="text-danger">*</label></label>
                                <input type="date" name="tgl_lahir_pasangan" class="form-control" placeholder="Tanggal Lahir pasangan" value="{{ \App\Helpers\DateUtil::date_display($menikah->tgl_lahir_pria) }}">
                                <label class="text-danger">{{$errors->first("tgl_lahir_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Alamat pasangan <label class="text-danger">*</label></label>
                                <input type="text" name="alamat_pasangan" class="form-control" placeholder="Alamat pasangan" value="{{ $menikah->alamat_pasangan }}">
                                <label class="text-danger">{{$errors->first("alamat_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">No telp pasangan <label class="text-danger">*</label></label>
                                <input type="text" name="no_tlp_pasangan" class="form-control" placeholder="No telp pasangan" value="{{ $menikah->no_tlp_pasangan}}">
                                <label class="text-danger">{{$errors->first("no_tlp_pasangan") }}</label>
                            </div>

                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pekerjaan pasangan<label class="text-danger">*</label></label>
                                <input type="text" name="pekerjaan_pasangan" class="form-control" placeholder="pekerjaan pasangan" value="{{ $menikah->pekerjaan_pasangan}}">
                                <label class="text-danger">{{$errors->first("pekerjaan_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Kewarganegaraan pasangan <label class="text-danger">*</label></label>
                                <select name="kewarganegaraan_pasangan" class="form-control">
                                    @if($menikah->kewarganegaraan_pasangan == "WNI")
                                        <option value="WNI" selected>WNI</option>
                                        <option value="WNA">WNA</option>
                                    @endif
                                    @if($menikah->kewarganegaraan_pasangan == "WNA")
                                        <option value="WNI">WNI</option>
                                        <option value="WNA" selected>WNA</option>
                                    @endif
                                </select>
                                <label class="text-danger">{{$errors->first("kewarganegaraan_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Ayah pasangan <label class="text-danger">*</label></label>
                                <input type="text" name="nama_ayah_pasangan" class="form-control" placeholder="Nama Ayah pasangan" value="{{ $menikah->nama_ayah_pasangan}}">
                                <label class="text-danger">{{$errors->first("nama_ayah_pasangan") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Ibu pasangan <label class="text-danger">*</label></label>
                                <input type="text" name="nama_ibu_pasangan" class="form-control" placeholder="Nama Ibu pasangan" value="{{ $menikah->nama_ibu_pasangan }}">
                                <label class="text-danger">{{$errors->first("nama_ibu_pasangan") }}</label>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Menikah <label class="text-danger">*</label></label>
                                <input type="date" name="tgl_menikah" class="form-control" placeholder="Tanggal Menikah" value="{{ \App\Helpers\DateUtil::date_display($menikah->tgl_menikah) }}">
                                <label class="text-danger">{{$errors->first("tgl_menikah") }}</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Gereja <label class="text-danger">*</label></label>
                                <input type="text" name="gereja" class="form-control" placeholder="Gereja" value="{{ $menikah->gereja }}">
                                <label class="text-danger">{{$errors->first("gereja") }}</label>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>


    </div>


@endsection