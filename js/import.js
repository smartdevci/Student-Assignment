$('#nouveau_semestre').hide();
$('#nouveau_semestre').removeClass('hidden');



$('#semester').change(function(){

	if($(this).val()=='Autre')
	{
		$('#nouveau_semestre').show(400);
	}
	else
	{
		$('#nouveau_semestre').hide(400);
	}

});



/**************************MIN BID ********************************************/


$('.modifier_min_bid_choix').click(function(){
	$('.valeur_min_bid_en_modification'+$(this).attr('alt')).val($('.min_bid_value_'+$(this).attr('alt')).text().trim());
});



$('.bouton_valider_modification_min_bid').click(function(){
	if(   parseInt($('.max_bid_value_'+$(this).attr('alt')).text()) <  parseInt($('.valeur_min_bid_en_modification'+$(this).attr('alt')).val().trim()) )
	{
		alert('Attention : la valeur du min bid est superieur à la valeur du max bid');
	}
	else
	{
		//MODIFICATION SUR L'INTERFACE ET DANS LA BASE DE DONNEES
		$('.min_bid_value_'+$(this).attr('alt')).text( parseInt($('.valeur_min_bid_en_modification'+$(this).attr('alt')).val().trim()) );

		var url="ajax/modifier_min_bid.php?consultation_instance_id="+$('#consultation_instance_id').val()+"&choice_id="+$(this).attr('alt')+"&value="+parseInt($('.valeur_min_bid_en_modification'+$(this).attr('alt')).val().trim());
		//alert(url);
		$.ajax({
		       url : url,
		       type : 'GET',
		       dataType : 'html',
		       success : function(code_html, statut){ 
		       		
		       },
		       error : function(resultat, statut, erreur){
		       		alert(resultat.responseText);
		       }


		});
	}
	
});



/*******************************MAX BID**********************************************/



$('.modifier_max_bid_choix').click(function(){
	$('.valeur_max_bid_en_modification'+$(this).attr('alt')).val($('.max_bid_value_'+$(this).attr('alt')).text().trim());
});



$('.bouton_valider_modification_max_bid').click(function(){
	if(   parseInt($('.min_bid_value_'+$(this).attr('alt')).text()) >   parseInt($('.valeur_max_bid_en_modification'+$(this).attr('alt')).val().trim()) )
	{
		alert('Attention : la valeur du max bid est inferieur à la valeur du min bid');
	}
	else
	{
		//MODIFICATION SUR L'INTERFACE ET DANS LA BASE DE DONNEES
		$('.max_bid_value_'+$(this).attr('alt')).text( parseInt($('.valeur_max_bid_en_modification'+$(this).attr('alt')).val().trim()) );

		//$('.min_bid_value_'+$(this).attr('alt')).text( parseInt($('.valeur_min_bid_en_modification'+$(this).attr('alt')).val().trim()) );

		var url="ajax/modifier_max_bid.php?consultation_instance_id="+$('#consultation_instance_id').val()+"&choice_id="+$(this).attr('alt')+"&value="+parseInt($('.valeur_max_bid_en_modification'+$(this).attr('alt')).val().trim());
		//alert(url);
		$.ajax({
		       url : url,
		       type : 'GET',
		       dataType : 'html',
		       success : function(code_html, statut){ 
		       		
		       },
		       error : function(resultat, statut, erreur){
		       		alert(resultat.responseText);
		       }


		});
	}
	
});


