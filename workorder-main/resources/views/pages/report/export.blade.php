<table>
    <thead>
        <tr>
            <td colspan="10" style="text-align: center">PT. KALIMANTAN PRIMA PERSADA</td>
        </tr>
        <tr>
            <td colspan="10" style="text-align: center">{{ 'PERIODE REPORT : '.$periode }}</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <th rowspan="2" width="30px" style="vertical-align: middle; text-align: center">No</th>
            <th rowspan="2" width="150px" style="vertical-align: middle; text-align: center">No. Work Order</th>
            <th rowspan="2" width="180px" style="vertical-align: middle; text-align: center">Nama Perusahaan</th>
            <th rowspan="2" width="100px" style="vertical-align: middle; text-align: center">NRP Pemohon</th>
            <th rowspan="2" width="120px" style="vertical-align: middle; text-align: center">Nama Pemohon</th>
            <th rowspan="2" width="200px" style="vertical-align: middle; text-align: center">Deskripsi Work Order</th>
            <th rowspan="2" width="50px" style="vertical-align: middle; text-align: center">Jumlah</th>
            <th colspan="2" width="150px" style="text-align: center">Tanggal</th>
            <th rowspan="2" width="120px" style="vertical-align: middle; text-align: center">Total Rata-Rata <br> Penggunaan Unit</th>
        </tr>
        <tr>
            <th width="75px" style="text-align: center">Mulai</th>
            <th width="75px" style="text-align: center">Selesai</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $item)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $item->wo_number }}</td>
                <td>{{ $item->company->name }}</td>
                <td>{{ $item->employee->nrp }}</td>
                <td>{{ $item->employee->name }}</td>
                <td>{{ $item->request_description }}</td>
                <td style="text-align: center">{{ $item->details()->sum('qty') }}</td>
                <td>{{ Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>
                <td style="text-align: center">{{ $item->details()->sum('hours_use') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
