<h1> Confirmation de votre réservation </h1>
<p>Bonjour {{$reservationUserPrenom}},</p><br>
<p>Vous avez bien réservé pour l'annonce <b>{{$reservationHouseTitle}}<b>, qui a pour type d'hebergement : <b>{{$reservationHouseCategory}}</b> du 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($reservationStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($reservationEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$reservationHouseAdresse}}
<p>pour <b>{{$reservationNbPersonnes}}</b> personne(s) au prix total de <b>{{$reservationTotal}} euros</b>.</p>
<p>Nombre de jours par personne(s) : <b>{{$reservationDays}} jours</b>, prix de la nuit par personne(s) : <b>{{$reservationPrice}} euros </b>
<p>Total payée : <b>{{$reservationTotal}} euros</b></p>
<p>Notre équipe Atypikhouse vous remercie</p>
