<html>
<head>
    <title>LAPORAN NILAI TES</title>
    <style>
        h1 {
            text-align: center;
            font-size: 14pt;
        }

        p {
            margin: 0px;
        }

        table {
            width: 100%;
            /* table-layout: fixed; */
            width: 100%;
            border-collapse: collapse;
            border: 0.5px solid #333;
        }

        th,
        td {
            border: 0.5px solid #333;
        }

    </style>
</head>
<body>
    <h1>LAPORAN HASIL TES</h1>
    <p>TANGGAL : {{ $jawaban->tanggal }}</p>
    <p>JUDUL : {{ $jawaban->judul }}</p>
    <p style="margin-bottom: 10px">JUMLAH SOAL : {{ count($jawaban->soal) }}</p>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">#</th>
                <th>Nama Lengkap</th>
                <th>Soal di Jawab</th>
                <th>Soal Benar</th>
                <th>Nilai</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            @php
                    $no = 0;
                    @endphp
                    @foreach ($jawaban->jawaban as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $item->katekisan->nama_lengkap }}</td>
                        <td>{{ (count($item->detailJawabanBerganda) > 0) ? count($item->detailJawabanBerganda) : count($item->detailJawabanEssay) }}</td>
                        <td>
                            @if (count($item->detailJawabanBerganda) > 0)
                            @php
                            $sum = 0;
                            $sum = $item->detailJawabanBerganda->sum(function($val){
                                return $val->pilihanJawaban->jawaban;
                            });
                            @endphp
                            {{ $sum }}
                            @else
                            @php
                            $sum = $item->detailJawabanEssay->sum(function($val){
                                return $val->benar;
                            });
                            @endphp
                            {{ $sum }}
                            @endif
                        </td>
                        <td>
                            {{ (  ($sum*10) / (count($jawaban->soal)*10)  )*100 }}
                        </td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai ?? '-' }}</td>
                    </tr>
                    @endforeach
        </tbody>
    </table>
</body>

</html>
