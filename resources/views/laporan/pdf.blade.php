<!DOCTYPE html>
<html>
<head>
    <title>Laporan {{ $projek->name }}</title>
    <style>
           body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan {{ $projek->name }}</h1>
    {{-- <p>{{ $content }}</p> --}}
    <table >
        <thead>
            <tr>
                <th>No</th>
                <th>Tugas</th>
                <th>Penanggung Jawab</th>
                <th>estimasi waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody  >
            @foreach ($tugas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->anggota->name }}</td>
                <td>
                    {{Carbon\Carbon::parse($item->target_awal)->diffInDays(Carbon\Carbon::parse($item->target_akhir))}}</p>

                </td>
                <td> @if ($item->status_progres == 'selesai')
                    <span class="badge bg-gradient-success">Selesai</span>
                        
                    @elseif ($item->status_progres == 'testing')
                    <span class="badge bg-gradient-warning">Testing</span>

                    @elseif ($item->status_progres == 'proses')
                    <span class="badge bg-gradient-secondary">Proses</span>

                    @elseif ($item->status_progres == 'baru')
                    <span class="badge bg-gradient-primary">Baru</span>
                        
                    @endif</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <h3>Total Tugas : {{ $tugas->count() }}</h3>
    <h3>Persentase Progres :                     
     
        {{$tugas->count() ? ($tugas_selesai->count()/$tugas->count())* 100 : 0}}%
    </h3>
    <h3>Estimasi Waktu : {{$daysDifference}} Hari</h3>
</body>
</html>
