<?php

namespace App\Mail;

use App\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reservation = $this->reservation;

        return $this->from('notre.equipe.atypikhouse@gmail.com')
            ->subject('Confirmation de votre reservation')
            ->view('email.reservation')
            ->with([
                'reservationUserPrenom' => $reservation->user->prenom,
                'reservationHouseTitle' => $reservation->house->title,
                'reservationHouseCategory' => $reservation->category->category,
                'reservationHouseAdresse' => $reservation->house->adresse,
                'reservationPrice' => $reservation->price,
                'reservationTotal' => $reservation->total,
                'reservationDays' => $reservation->days,
                'reservationStartDate' => $reservation->start_date,
                'reservationEndDate' => $reservation->end_date,
                'reservationNbPersonnes' => $reservation->nb_personnes,
                'reservationStatus' => $reservation->reserved,
                
            ]);
    }
}
