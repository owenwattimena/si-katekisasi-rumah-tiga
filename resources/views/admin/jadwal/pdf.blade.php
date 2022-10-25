<html>
<head>
    <title>LAPORAN ABSENSI</title>
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
    <h1>LAPORAN ABSENSI</h1>
    <p>TANGGAL : {{ $jadwal->tanggal }}</p>
    <p style="margin-bottom: 10px">TEMPAT : {{ $jadwal->tempat }}</p>
    <table>
        <thead>
            <tr>
                <th class="th-1" style="width: 35px">NO</th>
                <th>NAMA</th>
                <th style="width: 200px;">TANGGAL</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            @endphp
            @foreach ($absensi as $item)
            <tr>
                <td style="text-align: center">{{ ++$no }}</td>
                <td>{{ $item->katekisan->nama_lengkap }}</td>
                <td style="text-align: center">{{ $item->tanggal_absen }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
