
var old_arg1="";
var old_pref="";

var color_duplicate_error="#F6926a";
var color_number_bid_error="#D62A46";
var color_number_bid_consultation="#E768C8";
var color_number_bid_choice="#FD5D99";
var color_WARNING="#FFDC7C";

var default_text_warning=$('.message_warning_grand').html();
var default_text_error=$('.message_error_grand').html();

$('.message_error_grand').hide();
$('.message_error_grand').removeClass("hidden");

$('.message_success_grand').hide();
$('.message_success_grand').removeClass("hidden");

$('.message_warning_grand').hide();
$('.message_warning_grand').removeClass("hidden");



$('.bouton_valider_and_save').hide();
$('.bouton_valider_and_save').removeClass("hidden");



$('.modifier').click(function(){

	var choice=$(this).attr('data-choice');
	var student=$(this).attr('data-student');
	var option=$(this).attr('data-option');
	var vote=$(this).attr('alt');

	old_bid=$('.bid_choice_'+choice+'_student_'+student+'_option_'+option).text().trim();
	old_pref=$('.pref_choice_'+choice+'_student_'+student+'_option_'+option).text().trim();

	
	//alert(old_bid+"/"+old_pref);



	$('.bid_choice_'+choice+'_student_'+student+'_option_'+option).html('<input type="text" id="bid'+'_choice_'+choice+'_student_'+student+'_option_'+option+'" value="'+old_bid+'"/>');
	$('.pref_choice_'+choice+'_student_'+student+'_option_'+option).html('<input type="text" id="pref_choice_'+choice+'_student_'+student+'_option_'+option+'"  value="'+old_pref+'"/> ');

	$(this).addClass('hidden');
	$('.supprimer'+$(this).attr('alt')).addClass('hidden');
	
	$('.valider'+$(this).attr('alt')).removeClass('hidden');
	$('.annuler_modification'+$(this).attr('alt')).removeClass('hidden');


	$('#bid'+'_choice_'+choice+'_student_'+student+'_option_'+option,'#pref_choice_'+choice+'_student_'+student+'_option_'+option).keyup(function(event){
			//alert(event.type + ": " +  event.which);
		if(event.which==13)
		{
			$('.valider'+vote).click();
		}
	});



	
});

/*******************************DELETE A VOTE***************************************/
$('.supprimer').click(function(){

	var choice=$(this).attr('data-choice');
	var student=$(this).attr('data-student');
	
	var url="ajax/supprimer_vote.php?id_vote="+$(this).attr('alt');
	
	$('.choice_'+choice+'_student_'+student).hide(500);

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

});




/*********************VALIDATE MODIFICATION***************************/
$('.valider').click(function(){

	var choice=$(this).attr('data-choice');
	var student=$(this).attr('data-student');
	var option=$(this).attr('data-option');
	var vote=$(this).attr('alt');

	$('.valider'+$(this).attr('alt')).addClass('hidden');
	$('.annuler_modification'+$(this).attr('alt')).addClass('hidden');

	$('.modifier'+$(this).attr('alt')).removeClass('hidden');
	$('.supprimer'+$(this).attr('alt')).removeClass('hidden');


	var url="ajax/valider_modification.php?vote_id="+$(this).attr('alt')+"&bid="+$('#bid'+'_choice_'+choice+'_student_'+student+'_option_'+option).val()+"&pref="+$('#pref'+'_choice_'+choice+'_student_'+student+'_option_'+option).val();
	
	$('.bid'+'_choice_'+choice+'_student_'+student+'_option_'+option).html($('#bid'+'_choice_'+choice+'_student_'+student+'_option_'+option).val());
	$('.pref'+'_choice_'+choice+'_student_'+student+'_option_'+option).html($('#pref'+'_choice_'+choice+'_student_'+student+'_option_'+option).val());

	/******VALIDATE DATA IN DATABASE*************************************/
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

});






$('.annuler_modification').click(function(){

	var choice=$(this).attr('data-choice');
	var student=$(this).attr('data-student');
	var option=$(this).attr('data-option');
	var vote=$(this).attr('alt');

	$('.valider'+$(this).attr('alt')).addClass('hidden');
	$('.annuler_modification'+$(this).attr('alt')).addClass('hidden');

	$('.modifier'+$(this).attr('alt')).removeClass('hidden');
	$('.supprimer'+$(this).attr('alt')).removeClass('hidden');




	$('.bid_choice_'+choice+'_student_'+student+'_option_'+option).html(old_bid);
	$('.pref_choice_'+choice+'_student_'+student+'_option_'+option).html(old_pref);



});


/***************************ERROR MANAGEMENT********************************/
/***************************ERROR MANAGEMENT********************************/
/***************************ERROR MANAGEMENT********************************/

$('.bouton_verifier_contraintes').click(function()
{
	//$('tr').css( "background", color_duplicate_error);



	var erreur_notification="";
	var url="ajax/error.php?consultation_instance_id="+$('#consultation_instance_id').val();

	$('.message_error_grand').hide(400);
	$('.message_success_grand').hide(400);
 	$('.message_warning_grand').hide(400);
	//$('.message_success_grand').hide(400);
		       		
	//alert(url);
	var msg_erreur="";
	//$('.ligne_vote'+$(this).attr('alt')+' .bid').html($('#bid').val());
	
	$.ajax({
		       url : url,
		       type : 'GET',
		       dataType : 'html',
		       success : function(texte, statut){ 

		       	

		       //	alert(texte);
		       	var type_error=texte.split("@");
		       	var erreur_doublon=type_error[0].trim();
		       	var erreur_nombre_jeton_etudiant=type_error[1].trim();
		       	var erreur_min_max_consultation=type_error[2].trim();
		       	var erreur_min_max_choix=type_error[3].trim();
		       	var erreur_same_pref=type_error[4].trim();
		       	
		       	var nombre_error=type_error[type_error.length-1];

		       		
		       	//alert(nombre_error);

		       	if(nombre_error!=0)
		       	{

		       		if(erreur_nombre_jeton_etudiant.length!=0)
		       		{
		       			//Il y a erreur quelque part du nombre de jeton de l'etudiant
		       			//Format : //Format : number_bid_use (text)/student_id/error_msg

		       			var decoupage_erreur_nombre_jeton_etudiant=erreur_nombre_jeton_etudiant.split("#");
		       			for(var i=0;i<decoupage_erreur_nombre_jeton_etudiant.length;i++)
		       			{
		       				
		       				erreur_en_cours=decoupage_erreur_nombre_jeton_etudiant[i].split("/");
		       				msg_erreur+=erreur_en_cours[  erreur_en_cours.length-1 ]+"<br/>";
		       			}
		       		}



		       		if(erreur_min_max_consultation.length!=0)
		       		{
		       			//Il y a erreur quelque part du nombre de jeton de l'etudiant
		       			//Format : //Format : number_bid_use (text)/student_id/error_msg

		       			var decoupage_erreur_min_max_consultation=erreur_min_max_consultation.split("#");
		       			for(var i=0;i<decoupage_erreur_min_max_consultation.length;i++)
		       			{
		       				
		       				erreur_en_cours=decoupage_erreur_min_max_consultation[i].split("/");
		       				msg_erreur+=erreur_en_cours[  erreur_en_cours.length-1 ]+"<br/>";
		       			}
		       		}





		       		if(erreur_min_max_choix.length!=0)
		       		{
		       			//Il y a erreur quelque part du nombre de jeton de l'etudiant
		       			//Format : //Format : number_bid_use (text)/student_id/error_msg

		       			var decoupage_erreur_min_max_choix=erreur_min_max_choix.split("#");
		       			for(var i=0;i<decoupage_erreur_min_max_choix.length;i++)
		       			{
		       				
		       				erreur_en_cours=decoupage_erreur_min_max_choix[i].split("/");
		       				msg_erreur+=erreur_en_cours[  erreur_en_cours.length-1 ]+"<br/>";
		       			}
		       		}




		       		if(erreur_same_pref.length!=0)
		       		{
		       			//Il y a erreur quelque part du nombre de jeton de l'etudiant
		       			//Format : //Format : number_bid_use (text)/student_id/error_msg

		       			var decoupage_erreur_same_pref=erreur_same_pref.split("#");
		       			//alert('err : '+decoupage_erreur_same_pref.length+'-------------'+erreur_same_pref);
		       			for(var i=0;i<decoupage_erreur_same_pref.length;i++)
		       			{
		       				
		       				erreur_en_cours=decoupage_erreur_same_pref[i].split("/");
		       				msg_erreur+=erreur_en_cours[  erreur_en_cours.length-1 ]+"<br/>";
		       				//alert(erreur_en_cours[  erreur_en_cours.length-1 ]);
		       			}
		       		}



		       		//alert(msg_erreur);

		       		//var decoupage_erreur_nombre_jeton_etudiant=erreur_nombre_jeton_etudiant.split("#");




		       		//alert(msg_erreur);
		       		$('.bouton_valider_and_save').hide(100);
		       		$('.error_message').html(default_text_error+ msg_erreur);
		       		$('.nombre_error').text(nombre_error);
		       		$('.message_error_grand').show(500);

		       	}
		       	else
		       	{
		       		$('.message_success_grand').show(500);
		       		//$('.bouton_verifier_contraintes').hide();
		       		$('.bouton_valider_and_save').show(300);
		       		
		       	}


		       	researchWarning();






		       	/*var tab_data=texte.split("/");
		       	var type_error=tab_data[0];
		       	//alert(type_error+"#"+texte);
		       	$('tr').css( "background", "white");

		       	

		       	if(type_error=="ok")
		       	{
		       		//the data are OK
		       		$('.message_success_grand').show(500);
		       		$('.bouton_verifier_contraintes').hide();
		       		$('.bouton_valider_and_save').show(300);
		       		researchWarning();
		       		
		       	}
		       	else
		       	{
		       		



		       		

		       		if(type_error=="duplicate")
			       	{
			       		//Dublons dans les votes, il y a un etudiant qui a voté 2 fois au moins

			       		var number_error=tab_data[1]; //le nombre de ligne concernée par l'erreur

			       		$('.error_message').html("Unchecked constraint : Duplicate of vote data");
			       		$('.message_error_grand').show(500);
			       		
			       		for(var i=1;i<=number_error;i++)
				       	{
				       		var id_vote=tab_data[1+i];
				       		//alert(id_vote);
				       		$('.ligne_vote'+id_vote).css( "background", color_duplicate_error);

				       	}

			       	}



			       	/***************************************************************************

			       	else if(type_error=="number_bid_use")
			       	{
			       		//Format message : Quand un etudiant ne respecte pas le nombre de bid qu'il possède, c'est à dire il a depassé son nombre de jeton qui lui reste
			       		//number_bid_use/student_id/student_name/msg_erreur
			       		var student_id_error_number_bid=tab_data[1]; //the student id , qui a utilisé plus de jeton
			       		$('.error_message').html("Unchecked constraint : "+tab_data[2]+" a depassé le nombre de jetons autorisés "+tab_data[3]);
			       		$('.message_error_grand').show(500);

			       		$('.ligne_student'+student_id_error_number_bid).css( "background", color_number_bid_error);
			       		//alert('encore un autre');
			       	}



			       	/****************************************************************************

			       	else if(type_error=="number_bid_consultation")
			       	{
			       		//Format message : Quand un etudiant ne respecte pas le nombre de la consultation
			       		//number_bid_consultation/student_id/student_name/msg_erreur
			       		var student_id_error_number_bid=tab_data[1]; //the student id , qui a utilisé plus de jeton
			       		//alert('ok');
			       		$('.error_message').html("Unchecked constraint : "+tab_data[2]+" "+tab_data[3]);
			       		$('.message_error_grand').show(500);

			       		$('.ligne_student'+student_id_error_number_bid).css( "background", color_number_bid_consultation);
			       		//alert('encore un autre');
			       	}


			       	/****************************************************************************

			       	else if(type_error=="number_bid_choice")
			       	{
			       		//Format message : Quand un etudiant ne respecte pas le nombre de bid demandé par un choix
			       		//number_bid_choice/student_id/student_name/choice_id/choice_name/msg_erreur

			       		var student_id=tab_data[1];  //the student id , qui a utilisé plus de jeton
			       		var student_name=tab_data[2];
			       		var choice_id=tab_data[3];;
			       		var choice_name=tab_data[4];
			       		var msg_erreur=tab_data[5];
			       		var msg = student_name+" "+msg_erreur;

			       		$('.error_message').html("Unchecked constraint : "+msg);
			       		$('.message_error_grand').show(500);

			       		$('.choice_'+choice_id+'_student_'+student_id).css( "background", color_number_bid_choice);
			       		//alert('encore un autre');
			       	}




		       	}
		       	*/
		       	
		       	

		       		
		       },
		       error : function(resultat, statut, erreur){
		       		alert(resultat.responseText);
		       }


	});
});


/*************************************************/

function researchWarning()
{
	//alert('Warning');
	var url="ajax/warning.php?consultation_instance_id="+$('#consultation_instance_id').val();
	//alert(url);


	$.ajax({
		       url : url,
		       type : 'GET',
		       dataType : 'html',
		       success : function(texte, statut){ 
		       	var tab=texte.split("\\");
		       	var longueur=tab[0];
		       	//alert(texte);
		       //	alert(tab.length);

		       	for(var i=1;i<=longueur;i++)
		       	{
		       		$('td.case'+tab[i]).attr( "style","background:"+color_WARNING);
		       		
		       	}

		      	if((tab[tab.length-2])!=0)
		      	{	
		      		//alert(tab[tab.length-2]);
	      			$('.warning_message').html(	default_text_warning+tab[tab.length-1]);
	      			$('.nombre_warning').html(tab[tab.length-2]);
			       	
			       	$('.message_warning_grand').hide(40);
			       	$('.message_warning_grand').show(300);
		      	}

		       		
		       },
		       error : function(resultat, statut, erreur){
		       		alert(resultat.responseText);
		       }

	})
}



//alert('fin chargement');*/