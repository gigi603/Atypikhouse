<?php

namespace App\Mail;

use App\House;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAnnonceSuppressionFromAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $house;

    public function __construct(House $house)
    {
        $this->house = $house;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $house = $this->house;

        return $this->from('notre.equipe.atypikhouse@gmail.com')
            ->subject('Atypikhouse :  Notre équipe a supprimé votre annonce')
            ->view('email.annonceSuppressionFromAdmin')
            ->with([
                'houseUserPrenom' => $house->user->prenom,
                'houseTitle' => $house->title,
                'houseCategory' => $house->category->category,
                'houseAdresse' => $house->adresse,
                'housePrice' => $house->price,
                'houseStartDate' => $house->start_date,
                'houseEndDate' => $house->end_date,
                'houseNbPersonnes' => $house->nb_personnes,
                'houseStatus' => $house->statut,
            ]);
    }
}
