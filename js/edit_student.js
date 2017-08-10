
$('.view_previous_assignment ,.view_utilisation_porte_monnaie').hide();
//$('.view_previous_assignment').hide();
$('.view_previous_assignment ,.view_utilisation_porte_monnaie').removeClass('hidden');




$('.edit_name').click(function(){

	//alert('edit name');

	$(this).hide();
	$('.nom_complet_etudiant').html('<input style="background:#777777" type="text" class="nouveau_nom" value="'+$(this).attr('alt')+'" /> <span  style="cursor:pointer" class="glyphicon glyphicon-ok valider_modification_nom"></span> ');
	//alert($('.nom_complet_etudiant').html());


	$('.valider_modification_nom').click(function(){

		var colonne='name';
		var id=$('.student_id').text();
		var value=$('.nouveau_nom').val();
		update(colonne, id, value);
	

	});

});



$('.edit_extra_case').click(function(){

	$(this).hide();
	$('.extra_case').html('<select style="background:#777777" class="nouvel_extra_case"> <option value="0">No</option> <option value="1" >Yes</option></select> <span style="cursor:pointer" class="glyphicon glyphicon-ok valider_modification_extra_case"></span> ');
	
	//alert($('.extra_case').html());

	$('.valider_modification_extra_case').click(function(){

		var colonne='extra_case';
		var id=$('.student_id').text();
		var value=$('.nouvel_extra_case').val();
		update(colonne, id, value);
	});

});




$('.previous_assignment').click(function(){
	if($(this).text().trim()=='Show the previous assignments')
	{
		$(this).text('Hide the previous assignments ');
	}
	else 
	{
		$(this).text('Show the previous assignments ');
	}
	
	$('.view_previous_assignment').toggle(500);
});





$('.use_of_wallet').click(function(){
	if($(this).text().trim()=='Show the use of wallet')
	{
		$(this).text('Hide the use of wallet');
	}
	else 
	{
		$(this).text('Show the use of wallet');
	}
	
	$('.view_utilisation_porte_monnaie').toggle(500);
});

















function update(colonne, id, value)
{
	var url="ajax/update_student.php?id="+id+"&colonne="+colonne+"&value="+value;
	//alert(url);
		
	$.ajax({
			       url : url,
			       type : 'GET',
			       dataType : 'html',
			       success : function(code_html, statut){ 
			       		window.location='';
			       		
						//alert('ahh  '+code_html);

			       },
			       error : function(resultat, statut, erreur){
			       		alert(resultat.responseText);
			       }


		});

		

	
}






