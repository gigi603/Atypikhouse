<h1> Confirmation de la suppression de votre annonce </h1>
<p>Bonjour {{$houseUserPrenom}},</p><br>
<p>Vous avez bien supprimé une annonce <b>{{$houseTitle}}<b>, qui a pour type d'hebergement : <b>{{$houseCategory}}</b> du 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($houseStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($houseEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$houseAdresse}}
<p>pour maximum<b>{{$houseNbPersonnes}}</b> personne(s), prix de la nuit par personne(s) : <b>{{$housePrice}} euros </b>

<p>Notre équipe Atypikhouse vous remercie</p>
