@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    @if($data == null)
        <hr>
        <div class="card">
           <div class="card-body">
               <p><i>Anda Belum Didaftarkan untuk Kegiatan <br> Harap Hubungi Admin Prodi Anda</i></p>
           </div>
        </div>
    @else
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="h4">{{ ($data->typeofactivity()->first()->nama_jenis_kegiatan) }}</h4>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>Tempat Kegiatan</td>
                        <td>: <strong>{!! ($data->partner()->first()->partner_link_profile) !!}</strong></td>
                        <td>Mulai Kegiatan</td>
                        <td>: <strong>{{ (Carbon\Carbon::createFromDate($data->mulai_kegiatan)->format('d M Y')) }}</strong></td>
                        <td>Akhir Kegiatan</td>
                        <td>: <strong>{{ (Carbon\Carbon::createFromDate($data->akhir_kegiatan)->format('d M Y')) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Mitra Pendamping</td>
                        <td>: <strong>{{ ($data->partner()->first()->pamong_mitra) }}</strong></td>
                        <td>Lama Kegiatan</td>
                        <td>: <strong>{{ ($data->lama_kegiatan) }} Hari</strong></td>
                        <td>SK Kegiatan</td>
                        <td><a href="{{ url($data->file_sk_kegiatan ?? '/not_found') }}" target="__blank" class="btn btn-outline-info btn-sm">Download SK</a></td>
                    </tr>
                    <tr>
                        <td>Dosen Pendamping</td>
                        <td>: <strong>{!! ($data->lecturer()->first()->lecturer_link_profile) !!}</strong></td>
                        <td>Laporan Kegiatan</td>
                        <td>
                            @if($data->file_laporan_kegiatan == null)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadReport">
                                    Upload Laporan
                                </button>
                            @else
                                    <a href="{{ asset('storage/' . $data->file_laporan_kegiatan) }}" target="_blank">File Jurnal</a>
                                @endif
                        </td>
                        <td>Jurnal Kegiatan</td>
                        <td>
                        @if($data->file_jurnal_kegiatan == null)
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadJournal">
                                    Jurnal Sah
                                </button>
                            @else
                                <a href="{{ asset('storage/' . $data->file_jurnal_kegiatan) }}" target="_blank">File Jurnal</a>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="h4">Progres</h4>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Tanggal</th>
                        <th>Catatan</th>
                        <th width="10%">Status</th>
                        <th width="15%">Terakhir Update</th>

                    </tr>
                    </thead>
                    @forelse($data->journals as $key => $item)
                        <tr>
                            <td class="text-center">{{++$key}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_jurnal)->format('d M Y')}}</td>
                            <td><a href="{{ route('public.journal.show', ['prefix' => 'student', 'uuid' => $item->uuid]) }}">{!! substr(htmlspecialchars($item->catatan_jurnal), 0,100)  !!}</a></td>
                            <td>{!! $item->status_jurnal_with_label !!}</td>
                            <td>{!! $item->updated_at->format('d/m/y h:i:s') !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="uploadJournal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    {{ Form::model($data, ['route' => ['public.activity.report_file', ['id' => $data->uuid]], 'method' => 'put', 'files' => true]) }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Upload Jurnal</h5>
                        <a href="#" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="file_jurnal_kegiatan">File Upload Jurnal</label>
                                {{ Form::file('file_jurnal_kegiatan', ['class' => 'form-control-file']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="uploadReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    {{ Form::model($data, ['route' => ['public.activity.report_file', ['id' => $data->uuid]], 'method' => 'put', 'files' => true]) }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Upload Laporan Kegiatan <sup>*</sup></h5>
                        <a href="#" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="file_laporan_kegiatan">File Upload Jurnal (FINAL)</label>
                                {{ Form::file('file_laporan_kegiatan', ['class' => 'form-control-file']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

    @endif

@endsection
