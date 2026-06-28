<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; margin: 30px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 15px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header h2 { margin: 4px 0; font-size: 14px; color: #555; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .info td { padding: 3px 8px; }
        .info .label { font-weight: bold; width: 30%; }
        table.main { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.main th { background: #4f46e5; color: white; padding: 8px; text-align: left; }
        table.main td { border: 1px solid #ddd; padding: 7px 8px; }
        table.main tr:nth-child(even) { background: #f9f9ff; }
        .total { margin-top: 15px; text-align: right; font-weight: bold; font-size: 13px; }
        .footer { margin-top: 40px; text-align: right; font-size: 11px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <h2>Sistem Informasi Akademik (SIAKAD)</h2>
    </div>
    <div class="info">
        <table>
            <tr><td class="label">NPM</td><td>: {{ $mahasiswa->npm }}</td></tr>
            <tr><td class="label">Nama</td><td>: {{ $mahasiswa->nama }}</td></tr>
            <tr><td class="label">Dosen PA</td><td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td></tr>
        </table>
    </div>
    <table class="main">
        <thead>
            <tr><th width="5%">No</th><th width="15%">Kode MK</th><th>Nama Mata Kuliah</th><th width="10%" style="text-align:center">SKS</th></tr>
        </thead>
        <tbody>
            @foreach($krs_list as $i => $k)
            <tr>
                <td style="text-align:center">{{ $i + 1 }}</td>
                <td>{{ $k->kode_matakuliah }}</td>
                <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td style="text-align:center">{{ $k->matakuliah->sks ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">Total SKS: {{ $total_sks }} SKS</div>
    <div class="footer">Dicetak pada: {{ date('d F Y H:i') }} WIB</div>
</body>
</html>
