$(".delete-annonce").on("click", function(){
    return confirm("Voulez-vous vraiment supprimer cette annonce?");
});
$(".delete-reservation").on("click", function(){
    return confirm("Voulez-vous vraiment annuler cette reservation?");
});
$(".delete-user").on("click", function(){
    return confirm("Voulez-vous vraiment supprimer votre compte?");
});