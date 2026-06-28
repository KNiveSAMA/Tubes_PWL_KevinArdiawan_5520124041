<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>KRS - {{ $mahasiswa->nama }}</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; color: #222; padding: 30px; }
    .header { text-align: center; border-bottom: 3px double #333; padding-bottom: 12px; margin-bottom: 20px; }
    .header h1 { font-size: 18px; font-weight: bold; letter-spacing: 1px; }
    .header p { font-size: 11px; color: #555; margin-top: 3px; }
    .info { margin-bottom: 16px; }
    .info table { width: 100%; }
    .info td { padding: 3px 6px; font-size: 12px; }
    .info td:first-child { font-weight: bold; width: 140px; }
    table.krs { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table.krs th { background: #2d3748; color: white; padding: 8px 10px; text-align: left; font-size: 11px; }
    table.krs td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
    table.krs tr:nth-child(even) td { background: #f7fafc; }
    .total { margin-top: 12px; text-align: right; font-weight: bold; font-size: 12px; }
    .footer { margin-top: 40px; display: flex; justify-content: flex-end; text-align: center; }
    .sign-box { width: 180px; }
    .sign-box .date { margin-bottom: 60px; font-size: 11px; }
    .sign-box .line { border-top: 1px solid #333; padding-top: 4px; font-size: 11px; }
    .badge { display: inline-block; background: #ebf4ff; color: #3b82f6; border-radius: 4px; padding: 2px 6px; font-size: 10px; font-family: monospace; }
</style>
</head>
<body>
<div class="header">
    <h1>KARTU RENCANA STUDI (KRS)</h1>
    <p>Sistem Informasi Akademik - Universitas</p>
</div>
<div class="info">
    <table>
        <tr><td>NPM</td><td>: {{ $mahasiswa->npm }}</td></tr>
        <tr><td>Nama Mahasiswa</td><td>: {{ $mahasiswa->nama }}</td></tr>
        <tr><td>Dosen Wali</td><td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td></tr>
        <tr><td>Tanggal Cetak</td><td>: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td></tr>
    </table>
</div>
<table class="krs">
    <thead>
        <tr><th>No</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th style="text-align:center">SKS</th></tr>
    </thead>
    <tbody>
        @foreach($krs_list as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><span class="badge">{{ $k->kode_matakuliah }}</span></td>
            <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
            <td style="text-align:center">{{ $k->matakuliah->sks ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="total">Total SKS: {{ $total_sks }}</div>
<div class="footer">
    <div class="sign-box">
        <div class="date">Mengetahui,<br>Dosen Wali</div>
        <div class="line">{{ $mahasiswa->dosen->nama ?? '___________________' }}</div>
    </div>
</div>
</body>
</html>