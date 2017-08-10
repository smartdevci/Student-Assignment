$('.bouton_add_token').click(function()
{	
	
	var student_id=$(this).attr('alt');
	var value=$('.token_value_edit').val();
//alert('ok');
	
	var url="ajax/add_token.php?student_id="+student_id+"&value="+value;
	//alert(url);
		
	$.ajax({
			       url : url,
			       type : 'GET',
			       dataType : 'html',
			       success : function(code_html, statut){ 
			       		
			       		$('.token_value').html( parseInt($('.token_value').html().trim())+parseInt(value) );

			       },
			       error : function(resultat, statut, erreur){
			       		alert(resultat.responseText);
			       }
		});

	
});





$('.bouton_reduce_token').click(function()
{	

	var token_actuel=parseInt($('.token_value').html().trim());
	var student_id=$(this).attr('alt');
	var value=parseInt($('.token_value_edit').val().trim());

	

	var url="ajax/deduct_token.php?student_id="+student_id+"&value="+value;
		
	if(value>token_actuel)
	{
		alert('Le nombre de token restant est inferieur au nombre que vous avez saisi');
	}
	else
	{

		$.ajax({
			       url : url,
			       type : 'GET',
			       dataType : 'html',
			       success : function(code_html, statut){ 
			       		
			       		$('.token_value').html( token_actuel -value );

			       },
			       error : function(resultat, statut, erreur){
			       		alert(resultat.responseText);
			       }
		});


	}
	

	
});
















$('.bouton_add_regret_point').click(function()
{	
	var student_id=$(this).attr('alt');
	var value=$('.regret_point_value_edit').val();
//alert('ok');
	
	var url="ajax/add_regret_point.php?student_id="+student_id+"&value="+value;
		
	$.ajax({
			       url : url,
			       type : 'GET',
			       dataType : 'html',
			       success : function(code_html, statut){ 
			       		
			       		$('.regret_point_value').html( parseInt($('.regret_point_value').html().trim())+parseInt(value) );

			       },
			       error : function(resultat, statut, erreur){
			       		alert(resultat.responseText);
			       }
		});

	
});









$('.bouton_reduce_regret_point').click(function()
{	

	var regret_point_actuel=parseInt($('.regret_point_value').html().trim());
	var student_id=$(this).attr('alt');
	var value=parseInt($('.regret_point_value_edit').val().trim());

	

	var url="ajax/deduct_regret_point.php?student_id="+student_id+"&value="+value;
		
	if(value>regret_point_actuel)
	{
		alert('Le nombre de point de regret restant est inferieur au nombre que vous avez saisi');
	}
	else
	{

		$.ajax({
			       url : url,
			       type : 'GET',
			       dataType : 'html',
			       success : function(code_html, statut){ 
			       		
			       		$('.regret_point_value').html( regret_point_actuel -value );

			       },
			       error : function(resultat, statut, erreur){
			       		alert(resultat.responseText);
			       }
		});


	}
	

	
});







