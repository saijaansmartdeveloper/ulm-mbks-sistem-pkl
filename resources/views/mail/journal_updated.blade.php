@switch($user->guard_name)
    @case('lecturer')
    <div class="container">
        <h3>Yth, {{$user->nama_dosen ?? ''}}!</h3>
        <hr>
        <p>
            Mahasiswa Bimbingan Anda Telah Membuat Log Book. Silakan Cek di link dibawah ini. Terimakasih
        </p>
        <br>
        <a href="{{url('lecturer/journal/' . $uuid)}}" class="btn btn-info">Login MBKM FKIP ULM</a>
    </div>
    @break

    @case('student')
    <div class="container">
        <h1>Hai, {{$user->nama_mahasiswa ?? ''}}!</h1>
        <hr>
        <p>
            Dosen Pendamping Anda Telah Memeriksa Log Book Anda. Silakan Cek di link dibawah ini. Terimakasih
        </p>
        <br>
        <a href="{{url('student/journal/' . $uuid)}}" class="btn btn-info">Login MBKM FKIP ULM</a>    </div>
    @break

    @default
    Default case...
@endswitch
