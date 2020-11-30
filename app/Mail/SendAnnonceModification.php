<?php

namespace App\Mail;

use App\House;
use App\Valuecatpropriete;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAnnonceModification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $house;

    public function __construct(House $house, $proprieteshouse)
    {
        $this->house = $house;
        $this->proprieteshouse = $proprieteshouse;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $house = $this->house;
        $proprieteshouse = $this->proprieteshouse;

        return $this->from('notre.equipe.atypikhouse@gmail.com')
            ->subject('Confirmation de la modification de votre annonce')
            ->view('email.annonceModificationConfirmation')
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
                'housePropriete' => $proprieteshouse
            ]);
    }
}
