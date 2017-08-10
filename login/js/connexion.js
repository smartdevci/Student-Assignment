var login_message_erreur=$('.login_message_erreur');
	login_message_erreur.removeClass('hidden');
	login_message_erreur.hide();
	
$('#bouton_valider_connexion').click(function(){
	


//$nom,$prenom,$email,$password,$numero,$nom_compte

	var email=$('#email').val();
	var password=$('#password').val();
	var url="js/se_connecter.php?login="+email+"&password="+password;
	//alert(url);

	$.ajax({

	       url : url,
	       type : 'GET',
	       dataType : 'html',
	       success : function(code_html, statut){ 
	       		login_message_erreur.hide();
	       		code_html=code_html.trim();
	       		//alert("/"+code_html.trim()+"/"+(code_html==1));
	       		if(code_html!=-1)
	       		{
	       			var params=code_html.split('/');
	       			var type=params[0];
	       			var id=params[1];
	       			//var id=code_html;
	       			//alert(email+"/"+password+"/"+id);
					window.location="session_var.php?id="+id+"&token=false&type="+type;
	       			
	       		}
	       		else
	       		{
	       			login_message_erreur.hide();
	       			login_message_erreur.show(500);
	       		}

	       },
	       error : function(resultat, statut, erreur){

	       		alert(resultat.responseText);
	       }


    });


	
});
