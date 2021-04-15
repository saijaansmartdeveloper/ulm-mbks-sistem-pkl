<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">Nama</label>
    <div class="col-md-5">
        {{ Form::text('nama_dosen', null, ['class' => 'form-control', 'placeholder' => 'Nama']) }}
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
