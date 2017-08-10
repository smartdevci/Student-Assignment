/**
 * Created by Melaine on 03/08/2017.
 */

$('.bouton_reset_password_yes').click(function(){
    var url="ajax/reset_password.php?student_id="+$(this).attr('data-id');
    $.ajax({
        url : url,
        type : 'GET',
        dataType : 'html',
        success : function(new_password, statut){

            alert('New password : '+new_password);

        },
        error : function(resultat, statut, erreur){
            alert(resultat.responseText);
        }


    });



});