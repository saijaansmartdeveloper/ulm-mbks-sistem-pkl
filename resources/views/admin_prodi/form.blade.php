<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Email</label>
    <div class="col-md-5">
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Password</label>
    <div class="col-md-5">
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Jurusan</label>

    <div class="col-md-6">
        {{ Form::select('jurusan_uuid', $jurusan, null, ['placeholder' => '-- Pilih Jurusan --', 'id' => 'jurusan', 'class' => 'form-control']) }}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Prodi</label>

    <div class="col-md-6">
        {{ Form::select('prodi_uuid', $prodi, null, ['placeholder' => '-- Pilih Prodi --', 'id' => 'prodi', 'class' => 'form-control']) }}
    </div>
</div>
