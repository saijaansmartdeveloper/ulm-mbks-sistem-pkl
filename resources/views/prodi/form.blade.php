<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Nama Prodi</label>
    <div class="col-md-5">
        {{ Form::text('nama_prodi', null, ['class' => 'form-control', 'placeholder' => 'Nama Prodi']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Jurusan</label>

    <div class="col-md-6">
        {{ Form::select('jurusan_uuid', $jurusan, null, ['placeholder' => '-- Pilih Jurusan --', 'id' => 'jurusan', 'class' => 'form-control']) }}
    </div>
</div>