<h1> Suppression de l'annonce <b>{{$houseTitle}}<b></h1>

<p>Notre équipe a supprimé l'annonce <b>{{$houseTitle}}<b>, qui a pour type d'hebergement : <b>{{$houseCategory}}</b><br>
    <p>Disponibilité </p> 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($houseStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($houseEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$houseAdresse}}
<p>pour maximum<b>{{$houseNbPersonnes}}</b> personne(s), prix de la nuit par personne(s) : <b>{{$housePrice}} euros </b><br>
<p> Il se peut que l'adresse ou autres informations fournies soit incorrecte et n'ayant pas de réponse de votre part<br>
notre équipe se voit dans l'obligation de retirer votre annonce de notre site afin de ne pas nuire à l'expérience de nos clients
<p>Notre équipe Atypikhouse espère vous revoir très bientot</p>
