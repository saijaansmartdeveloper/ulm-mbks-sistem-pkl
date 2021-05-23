@switch($guard)
    @case('lecturer')
    <div class="container">
        <h3>Yth, {{$journal->activity()->first()->lecturer()->first()->nama_dosen ?? ''}}!</h3>
        <hr>
        <p>{{$message}}</p>
        <br>
        <a href="{{url('public/journal/' . $journal->uuid)}}" class="btn btn-info">Login MBKM FKIP ULM</a>
    </div>
    @break

    @case('student')
    <div class="container">
        <h1>Hai, {{$journal->activity()->first()->student()->first()->nama_mahasiswa ?? ''}}!</h1>
        <hr>
        <p>{{$message}}</p>
        <br>
        <a href="{{url('public/journal/' . $journal->uuid)}}" class="btn btn-info">Login MBKM FKIP ULM</a>    </div>
    @break

    @default
    Default case...
@endswitch
