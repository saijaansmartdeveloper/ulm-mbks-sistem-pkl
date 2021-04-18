<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Akhir Magang</label>
    <div class="col-md-5">
        {{ Form::date('akhir_magang', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Lama Magang</label>
    <div class="col-md-5">
        {{ Form::text('lama_magang', null, ['class' => 'form-control', 'placeholder' => 'Lama Magang']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">File SK Magang</label>

    <div class="col-md-6">
        {{ Form::text('file_sk_magang', null, ['class' => 'form-control', 'placeholder' => 'Link File SK Google Drive']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Status Magang</label>

    <div class="col-md-6">
        {{ Form::select('status_magang', ['1' => 'Masih Berjalan', '2'=>'Selesai'], null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Dosen</label>

    <div class="col-md-6">
        {{ Form::select('dosen_uuid', $dosen, null, ['placeholder' => '-- Pilih Dosen --' , 'class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Mahasiswa</label>

    <div class="col-md-6">
        {{ Form::select('mahasiswa_uuid', $mahasiswa, null, ['placeholder' => '-- Pilih Mahasiswa --' , 'class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Mitra</label>

    <div class="col-md-6">
        {{ Form::select('mitra_uuid', $mitra, null, ['placeholder' => '-- Pilih Mitra --' , 'class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Jenis Kegiatan</label>

    <div class="col-md-6">
        {{ Form::select('jenis_kegiatan_uuid', $jenis_kegiatan, null, ['placeholder' => '-- Pilih Jenis Kegiatan --' , 'class' => 'form-control']) }}
    </div>
</div>

