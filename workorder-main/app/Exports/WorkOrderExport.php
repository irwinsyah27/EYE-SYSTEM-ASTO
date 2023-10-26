<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WorkOrderExport implements FromView
{
    public function __construct($data = [], $periode = '')
    {
        $this->data = $data;
        $this->periode = $periode;
    }

    public function view(): View
    {
        return view('pages.report.export', [
            'periode' => $this->periode,
            'data' => $this->data,
        ]);
    }
}
