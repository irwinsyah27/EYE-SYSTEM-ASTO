<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $data['title'] }}</title>
    </head>
    <body>
        <p>Pengajuan Work Order Sudah <span style="font-weight: bold;">{{ $data['status'] }}</span>, Silahkan dicek.</p>
        <p>deskripsi: {{ $data['description'] }}.</p>
        <br>
        <p>Terima Kasih</p>
    </body>
</html>
