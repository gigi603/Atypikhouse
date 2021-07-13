<h1> Confirmation de la demande de suppression de votre annonce </h1>
<p>Bonjour {{$houseUserPrenom}},</p><br>
<p>Vous avez bien demander la suppression de votre annonce <b>{{$houseTitle}}<b>, qui a pour type d'hebergement : <b>{{$houseCategory}}</b> du 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($houseStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($houseEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$houseAdresse}}
<p>pour maximum<b>{{$houseNbPersonnes}}</b> personne(s), prix de la nuit par personne(s) : <b>{{$housePrice}} euros </b>
<p>Notre équipe se mettra en ordre de supprimer votre annonce, par contre les réservations effectués seront maintenues, mais si vous tenez 
    absolument à tout à annuler de suite malgrès les reservations effectués par les clients sur votre annonce,
    il va falloir effectuer les remboursements vis à vis de ces clients</p>
<p>Notre équipe Atypikhouse vous remercie</p>
