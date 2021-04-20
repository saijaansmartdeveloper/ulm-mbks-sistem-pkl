<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Nama Mahasiswa</label>
    <div class="col-md-5">
        {{ Form::text('nama_mahasiswa', null, ['class' => 'form-control', 'placeholder' => 'Nama Mahasiswa']) }}
    </div>
</div>
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
    <label class="col-md-2 col-form-label text-md-right">Phone</label>
    <div class="col-md-5">
        {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone']) }}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Foto Mahasiswa</label>
    <div class="col-md-5">
        {{ Form::file('foto_mahasiswa', ['class' => '', 'placeholder' => 'Foto Mahasiswa']) }}
    </div>
</div>
