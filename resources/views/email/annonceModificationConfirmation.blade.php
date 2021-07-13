<h1> Confirmation de la modification de votre annonce </h1>
<p>Bonjour {{$houseUserPrenom}},</p><br>
<p>Vous avez bien modifié une annonce <b>{{$houseTitle}}</b>, qui a pour type d'hebergement : <b>{{$houseCategory}}</b> du 
    <?php \Date::setLocale('fr'); $startdate = Date::parse($houseStartDate)->format('l j F Y'); echo($startdate);?> au
    <?php \Date::setLocale('fr'); $enddate = Date::parse($houseEndDate)->format('l j F Y'); echo($enddate);?><br>
     à l'adresse {{$houseAdresse}}
<p>pour maximum <b>{{$houseNbPersonnes}}</b> personne(s), prix de la nuit par personne(s) : <b>{{$housePrice}} euros </b>
@if(count($housePropriete) > 0)
    <p>Voici les équipements associés à l'annonce <b>{{$houseTitle}}<b>:<br><br>

    @foreach($housePropriete as $propriete)
        <p>{{$propriete->propriete->propriete}}</p>
    @endforeach
@endif
<br>
<p><b>Ces informations prendront effet pour les prochaines réservations, les réservations déjà en cours elles ne verront pas de changement</b></p>
<p>Notre équipe Atypikhouse vous remercie</p>
