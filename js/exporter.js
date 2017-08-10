$('.lien_exporter_donnees_vers_app_affectation').click(function(){
	var id=$(this).attr("alt");
	var url="json.php?id_consultation_instance_id="+id;
	//alert(url);
	
	$.ajax({
		       url : url,
		       type : 'GET',
		       dataType : 'html',
		       success : function(code_html, statut){ 

		       		//$.fileDownload("export/consultation"+id+".json").done(function () { alert('File download a success!'); })
    //.fail(function () { alert('File download failed!'); });
		       		//alert('fini');
		       		$('.lien_export').attr("href","export/consultation"+id+".json");
					$('.lien_export').attr("download","consultation"+id+".json");
					//alert($('.okok').html());
					$('.lien_export').click();
					window.location='';

		       },
		       error : function(resultat, statut, erreur){
		       		alert(resultat.responseText);
		       }


	});

	

});