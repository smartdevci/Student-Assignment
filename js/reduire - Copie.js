$('.contenu_a_cacher').hide();
$('.contenu_a_cacher').removeClass('hidden');

$('.choice_name').click(function(){
	var id=$(this).attr('alt');
	$('.tableau_contenu'+id).toggle(500);
});




$('.lien_telechargement').click(function(){
	//alert('ok');
	$('.lien_telechargement').attr("href","csv/vote.csv");
});


$('.lien_telechargement').click(function(){
	alert($(this).attr('href'));
})