<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>

    <style>
        .text-center {
            text-align: center;
        }
        table {
            width: 100%;
            border-left: 0.01em solid #333;
            border-right: 0;
            border-top: 0.01em solid #333;
            border-bottom: 0;
            border-collapse: collapse;
        }
        table td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #333;
            border-top: 0;
            border-bottom: 0.01em solid #333;
        }
    </style>
</head>
<body>
    <h3 class="h3">Jurnal Mingguan</h3>
    <hr>
    <p>Jurnal Cetak Dari : {{$data['from']}} s.d {{$data['to']}}</p>
    <table class="table" cellpadding='1.4' cellspacing='2'>
        <tr class="text-center">
            <th width="5%">No</th>
            <th width="12%">Tanggal</th>
            <th>Catatan</th>
            <th width="12%">Status</th>
            <th width="20%">Verifikasi</th>
            <th width="10%">TTD Dosen</th>
            <th width="15%">TTD Pendamping</th>
        </tr>
        @foreach($data['journals'] as $key => $item)
            <tr>
                <td class="text-center">
                    {{++$key}}
                </td>
                <td class="text-center">
                    {!! Carbon\Carbon::createFromDate($item->tanggal_jurnal)->format('d M Y') !!}
                </td>
                <td>
                    {{$item->catatan_jurnal}}
                </td>
                <td class="text-center">
                    {{$item->status_jurnal}}
                </td>
                <td class="text-center">
                    {{$item->tanggal_verifikasi_jurnal}}
                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
