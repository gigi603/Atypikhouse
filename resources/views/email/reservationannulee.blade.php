<h1> Annulation de votre réservation </h1>
<p>Bonjour {{$reservationUserPrenom}},</p><br>
<p>Vous avez bien annulé votre reservation pour l'annonce <b>{{$reservationHouseTitle}}<b>, qui a pour type d'hebergement : <b>{{$reservationHouseCategory}}</b> du 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($reservationStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($reservationEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$reservationHouseAdresse}}
<p>pour <b>{{$reservationNbPersonnes}}</b> personne(s)</p>

<p>Notre équipe Atypikhouse vous remercie</p>
