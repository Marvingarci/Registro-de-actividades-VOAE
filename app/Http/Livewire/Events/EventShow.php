<?php

namespace App\Http\Livewire\Events;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\Asistance;
use App\Exports\AttendanceExport;
use App\Notifications\AsistancesNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class EventShow extends Component
{

    use WithPagination;

    public $event;

    public $asistances;

    public function render()
    {
        return view('livewire.events.event-show', [
            'asistances' => $this->asistances,
        ]);
    }

    public function mount($id)
    {
        $this->event = Event::where('id', $id)->first();
        $this->asistances = Asistance::where('event_id', $this->event->id)->get();
    }

    public function closeEvent()
    {

        $this->verified_asistances_status($this->asistances);
        # para descargarlo

        // $excel = (new AttendanceExport)->download('Asistencia.xlsx', ExcelFormat::XLSX);
        // return $excel;

        # genero y guardo en storage el excel y el pdf
        Excel::store(new AttendanceExport($this->asistances), 'Asistencia.xlsx');
        $excel_path = Storage::path('Asistencia.xlsx');

        PDF::loadView('pdfs.comprobantePdf', ['asistances' => $this->asistances])->save(storage_path('app/public/'). 'comprobante_'.$this->event->id.'.pdf');
        $pdf_path = Storage::path('/public/comprobante_'.$this->event->id.'.pdf');

        # envio el correo al usuario con el que se esté logueado
        Notification::route('mail', [
            auth()->user()->email => auth()->user()->name
        ])->notify(new AsistancesNotification($excel_path, $this->event, $pdf_path));

        # lo elimino para que no ocupe espacio
        Storage::delete('Asistencia.xlsx');
        Storage::delete('public/pdfs');

        // cambio el estado del evento a cerrado
        $this->event->status = 'Cerrado';
        $this->event->save();

        return redirect()->route('event.index');
    }

    public function verified_asistances_status($asistances){
        foreach ($asistances as $attendance) {
            if ($attendance->status == "entrada") {
                $attendance->status = "indefinido";
                $attendance->end_asistance = 0;
                $attendance->save();
            }
        }
    }
}
