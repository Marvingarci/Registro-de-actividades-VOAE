<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AsistancesNotification extends Notification
{
    use Queueable;

    public $excel;
    public $event;
    public $pdf;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($excel, $event, $pdf)
    {
        $this->excel = $excel;
        $this->event = $event;
        $this->pdf = $pdf;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Buen día, Estimado(a)')
            ->subject('Estudiantes que asistieron a ' . $this->event->event_name)
            ->line('Recibió este correo electrónico con los registros de los estudiantes que asistieron
                al evento de '. $this->event->event_name. ' la fecha de '. $this->event->release_date. '.')
            ->salutation('Saludos, ' . auth()->user()->name)
            ->attach($this->excel)
            ->attach($this->pdf);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
