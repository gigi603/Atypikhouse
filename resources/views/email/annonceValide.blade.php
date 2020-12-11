<h1> Confirmation de la validation de votre annonce </h1>
<p>Bonjour {{$houseUserPrenom}},</p><br>
<p>Notre equipe a bien validé votre annonce <b>{{$houseTitle}}<b>, qui a pour type d'hebergement : <b>{{$houseCategory}}</b> du 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($houseStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($houseEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$houseAdresse}}
<p>pour maximum<b>{{$houseNbPersonnes}}</b> personne(s), prix de la nuit par personne(s) : <b>{{$housePrice}} euros </b>
<p>Votre annonce est dorénavent en ligne et visible à tous les visiteurs de notre site.</p>

<p>Notre équipe Atypikhouse vous remercie</p>
