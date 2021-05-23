@switch($guard)
    @case('lecturer')
    <div class="container">
        <h3>Yth, {{$activity['dosen']->nama_dosen ?? ''}}!</h3>
        <hr>
        <p>Pembimbingan MBKM anda telah ditentukan. Anda melakukan bimbingan pada {{$activity['mitra']->nama_mitra}}.</p>
        <p>Untuk daftar mahasiswa yang akan menjadi bimbingan anda adalah sebagai berikut:</p>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NIM</td>
                <td>Nama Mahasiswa</td>
                <td>Program Studi</td>
            </tr>
            @foreach($activity['mahasiswa'] as $key => $item)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->nim_mahasiswa ?? ''}}</td>
                    <td>{{$item->nama_mahasiswa ?? ''}}</td>
                    <td>{{$item->prodi()->first()->nama_prodi ?? ''}}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <a href="{{url('public/login')}}" class="btn btn-info">Login MBKM FKIP ULM</a>
    </div>
    @break

    @case('student')
    <div class="container">
        <h1>Hai, {{$activity->student()->first()->nama_mahasiswa ?? ''}}!</h1>
        <hr>
        <p>Penempatan MBKM anda telah ditentukan. Silakan Login pada <a href="{{url('public/login')}}">MBKM FKIP ULM</a> untuk memeriksanya.</p>
    </div>
    @break

    @default
    Default case...
@endswitch
