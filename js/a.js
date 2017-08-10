
	var alert_format_incorrect=$('.alert_format_incorrect');
	var alert_message_erreur=$('.alert_message_erreur');
	var alert_message_password_modifie=$('.alert_message_password_modifie');

	alert_format_incorrect.hide();
	alert_message_erreur.hide();
	alert_message_password_modifie.hide();
	alert_format_incorrect.removeClass('hidden');
	alert_message_erreur.removeClass('hidden');
	alert_message_password_modifie.removeClass('hidden');


	/*$('.alert_message_erreur').hide();
	$('.alert_format_incorrect').hide();*/

	$('#fichier_vote').change(function(){
		var tab=$('#fichier_vote').val().split(".");
		var extension=tab[tab.length-1];
		//alert($('#fichier_vote').val()+"/"+extension);

		if(extension.toLowerCase()!='csv')
		{
			alert_format_incorrect.show(250);
			$('#fichier_vote').val("");

		}
		else 
		{
			$('.alert').hide(400);
		}
	});



	$('.bouton_valider_modification_password').click(function(){


		var ancien=$('#old_password').val();
		//alert(ancien);
		var nouveau=$('#new_password').val();
		var retaper=$('#retaper_new_password').val();

		var ancien_mot_de_passe=$('.ancien_mot_de_passe');
		ancien_mot_de_passe.hide();
		alert_message_erreur.hide(10);
			
		ancien_mot_de_passe.removeClass('hidden');

		if(nouveau==retaper)
		{
			alert_message_erreur.hide();
			
			var url="ajax/update_password.php?old="+ancien+"&nouveau="+nouveau;
			//alert(url);
			$.ajax({

		       url : url,
		       type : 'GET',
		       dataType : 'html',
		       success : function(code_html, statut){ 
		       		
		       		//alert(code_html);
		       		if(code_html==0)
		       		{
		       			alert_message_erreur.hide();
			   			ancien_mot_de_passe.hide(10);
		       			alert_message_password_modifie.hide();
		    			//ancien_mot_de_passe.text("L'ancien mot de passe saisi est incorrecte");
		       			ancien_mot_de_passe.show(300);
		       		}
		       		else if(code_html==1)
		       		{
		       			ancien_mot_de_passe.hide();
						alert_message_erreur.hide();
			   			alert_message_password_modifie.hide(10);
		       			alert_message_password_modifie.show(300);
		       			$('.mot_de_passe_genere').hide(500);
		       		}

		       },
		       error : function(resultat, statut, erreur){

		       		alert(resultat.responseText);
		       }


		    });

		}
		else
		{
			alert_message_password_modifie.hide();
		    ancien_mot_de_passe.hide();
			alert_message_erreur.hide(10);
			alert_message_erreur.text("Les deux nouveaux mots de passe sont pas conformes !!!");
			alert_message_erreur.show(250);
		}

		

	});

