@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <i class="fas fa-users fa-fw" style="font-size: 200px;"></i>
                </div>
                <div class="col-md-9">
                    <table>
                        <tr>
                            <th>
                                NIM Mahasiswa
                            </th>
                            <td>:</td>
                            <td>
                                1710131310013
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Nama Mahasiswa
                            </th>
                            <td>:</td>
                            <td>
                                Fauzan Harada
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Program Studi
                            </th>
                            <td>:</td>
                            <td>
                                Pendidikan Ilmu Komputer
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Jurusan
                            </th>
                            <td>:</td>
                            <td>
                                PMIPA
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email Mahasiswa
                            </th>
                            <td>:</td>
                            <td>
                                fauzanhrd@gmail.com
                            </td>
                        </tr>
                        
                    </table>
                    <hr>
                    <a href="" class="btn btn-warning">Download Berkas Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4>Komentar Jurnal</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    {{ Form::textarea('', null, ['class' => 'form-control','rows' => '4', 'placeholder' => 'Isi Komentar']) }}
                </div>
            </div>
            <div class="form-group row pt-2">
                <div class="col-md-3">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
@endsection
