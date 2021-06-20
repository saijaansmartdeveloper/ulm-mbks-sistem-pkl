@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    @include('alert')

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                    <img src="{{ $data->foto_mahasiswa == null ? asset('img/person.png') : asset('storage/' . $data->foto_mahasiswa) }}" class="img-thumbnail" alt="">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th width='24%'>NIM Mahasiswa</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->nim_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Nama Mahasiswa</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Program Studi</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->prodi()->first()->nama_prodi ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Jurusan</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->jurusan()->first()->nama_jurusan ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Email</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>No. Telpon</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>
    </div>



    @if ($guard != 'student')

        @if ($data->activities()->first() != null)

        <div class="card mb-3">
            <div class="card-body">
                <h3 class="h3">Daftar Jurnal Kegiatan</h3>
                <hr>
                <div class="mb-3 text-right">
                    @if ($guard == 'lecturer')
                        {{ Form::open(['url' => route('public.journal.update_status_any', ['prefix' => $guard]), 'method' => 'put']) }}

                        <button type="submit" class="btn btn-success btn-sm">Ubah Status Terima (Accept)</button>
                    @elseif ($guard == 'partner')
                        <button type="submit" class="btn btn-primary btn-sm">Verifikasi Banyak Jurnal</button>
                    @endif
                </div>
                <table class="table table-hover table-striped">
                    <tr>
                        <th class="text-center" width='5%'></th>
                        <th class="text-center" width='5%'>No</th>
                        <th class="text-center" width='15%'>Tanggal</th>
                        <th class="text-center">Catatan</th>
                        <th class="text-center" width='15%'>Status</th>
                        <th class="text-center" width='15%'>Verifikasi Mitra</th>
                        <th class="text-center" width='15%'>Aksi</th>
                    </tr>
                        @forelse ($data->activities()->first()->journals()->orderBy('tanggal_jurnal', 'desc')->paginate(5) as $key => $item)
                        <tr>
                            <td class="text-center">
                                {!! Form::checkbox('ids[]', $item->uuid) !!}
                            </td>
                            <td class="text-center">
                                {{ $data->activities()->first()->journals()->orderBy('created_at', 'desc')->paginate(4)->firstItem() + $key }}
                            </td>
                            <td class="text-center">
                                {{Carbon\Carbon::createFromDate($item->tanggal_jurnal)->format('d M Y')}}
                            </td>
                            <td>
                                {{$item->catatan_jurnal}}
                            </td>
                            <td class="text-center">
                                {!! $item->status_jurnal_with_label !!}
                            </td>
                            <td class="text-center">
                                {!! $item->tanggal_verifikasi_jurnal !!}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('public.journal.show', ['prefix' => $guard ?? 'web', 'uuid' => $item->uuid]) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="7"><i>jurnal belum ada dibuat</i></td>
                        </tr>
                        @endforelse
                </table>
                <div>
                    {!! $data->activities()->first()->journals()->orderBy('tanggal_jurnal', 'desc')->paginate(4)->links() !!}
                </div>
            </div>
        </div>
        {{-- {!! Form::close() !!} --}}

        @endif

    @endif

@endsection
