<?php

namespace App\Exports;

use App\Models\Asistance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

# formas de enviar los datos
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

# estilos para el documento
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AttendanceExport  implements FromCollection, WithMapping, WithHeadings, WithStyles, WithColumnWidths, WithColumnFormatting
{
    use Exportable;

    public $asistances;

    public function __construct($asistances)
    {
        $this->asistances = $asistances;
    }

    // FUNCION PARA CAMBIARLE EL TAMAÑO A LAS COLUMNAS
    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 20,
            'C' => 30,
            'D' => 10,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    // APLICO ESTILOS A LO PRIMERA FILA
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    // MAPEO LOS DATOS DE LA QUERY
    public function map($attendance): array
    {
        $total_hours = "NSP";

        if ($attendance->end_asistance != null) {

            $start_date = Carbon::create($attendance->start_asistance);
            $end_date = Carbon::create($attendance->end_asistance);
            $total_minutes = $start_date->diffInMinutes($end_date);
            $total_hours = $this->convertToHoursMins($total_minutes);
        }

        return [
            $attendance->full_name,
            $attendance->account_number,
            $attendance->email,
            $total_hours,
        ];
    }

    //AGREGO LA PRIMERA FILA CON LOS ENCABEZADOS DE CADA COLUMNA
    public function headings(): array
    {
        return [
            'Nombre',
            'NUMERO DE CUENTA',
            'CORREO INSTITUCIONAL',
            'HORAS'
        ];
    }

    // HAGO LA CONSULTA PARA TRAER LOS DATOS
    public function collection()
    {
        return $this->asistances;
    }

    // funcion para convertir los minutos a horas
    function convertToHoursMins($time, $format = '%d:%s')
    {
        settype($time, 'integer');
        if ($time < 0 || $time >= 1440) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = $time % 60;

        if ($minutes < 10) {
            $minutes = '0' . $minutes;
        }
        return sprintf($format, $hours, $minutes);
    }
}
