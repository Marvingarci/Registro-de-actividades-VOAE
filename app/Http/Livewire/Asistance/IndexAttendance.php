<?php

namespace App\Http\Livewire\Asistance;

use App\Exports\AttendanceExport;
use App\Models\Asistance;
use App\Notifications\AsistancesNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class IndexAttendance extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.asistance.index-attendance', [
            'asistances' =>  Asistance::paginate('5')
        ]);
    }

    public function exportExcell()
    {
        # para descargarlo

        // $excel = (new AttendanceExport)->download('Asistencia.xlsx', ExcelFormat::XLSX);
        // return $excel;

        # para guardarlo

        Excel::store(new AttendanceExport, 'Asistencia.xlsx');
        $path = Storage::path('Asistencia.xlsx');
        
        # envio el correo al usuario con el que se esté logueado
        Notification::route('mail', [
            auth()->user()->email => auth()->user()->name
        ])->notify(new AsistancesNotification($path));

        # lo elimino para que no ocupe espacio
        Storage::delete('Asistencia.xlsx');

    }
}
