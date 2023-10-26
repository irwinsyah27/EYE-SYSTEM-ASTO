<?php

namespace App\Helpers;

use App\Models\Employee;
use App\Models\WorkOrder;

class Helper {
    public static function generateEmployeeNumber()
    {
        $lastEmployee = Employee::orderBy('id', 'desc')->first();
        if ($lastEmployee) {
            $lastNumber = intval(substr($lastEmployee->nrp, 3)); // Mengambil bagian angka dari nomor karyawan terakhir
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 6, '0', STR_PAD_LEFT); // Mengubah nomor menjadi format yang diinginkan (contoh: "00000002")
        $employeeNumber = 'ID.' . $formattedNumber;

        return $employeeNumber;
    }

    public static function generateWONumber()
    {
        // Mendapatkan nomor terakhir dari work order dalam database
        $lastWorkOrder = WorkOrder::orderBy('id', 'desc')->first();

        // Menentukan nomor work order berikutnya
        $nextNumber = $lastWorkOrder ? self::getNumericPart($lastWorkOrder->wo_number) + 1 : 1;

        // Format WO Number
        $year = date('Y');
        $formattedNumber = sprintf('%03d', $nextNumber);
        $woNumber = $formattedNumber.'/WO-KPP/VI/'.$year;

        return $woNumber;
    }

    private static function getNumericPart($woNumber)
    {
        $numericPart = explode('/', $woNumber)[0];
        return (int) $numericPart;
    }
}
