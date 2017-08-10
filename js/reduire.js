$('.choice_name').css('cursor','pointer');
//$('.contenu_a_cacher').hide();
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
});




/************************************************************/
$('#other_separator').hide();
$('#other_separator').removeClass('hidden');

$('#separator').change(function(){

	if($(this).val()=='Autre')
	{
		$('#other_separator').show(300);
	}
	else
	{
		$('#other_separator').hide(300);
	}
});