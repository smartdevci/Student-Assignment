/**
 * Created by Melaine on 03/08/2017.
 */

var texte;

var valeur;
var id_user;
var name;
var login;

$('.block_action_effectue').hide();
$('.block_action_effectue').removeClass('hidden');

$('.boutons_delete_edit').hide();
$('.boutons_delete_edit').removeClass('hidden');

$('.boutons_valider_annuler').hide();
$('.boutons_valider_annuler').removeClass('hidden');

$('#users_list').focus(function(){
    $('.boutons_delete_edit').show(500);
});


$('#users_list').blur(function(){

    $('.boutons_delete_edit').hide(500);
});




$('.bouton_edit_user').click(function () {
    //alert($('#users_list').val());
    texte=$('#users_list').val()+'';
    valeur=texte.split('/');
    id_user=valeur[0];
    name=valeur[1];
    login=valeur[2];

    $('#name').val(name);
    $('#login').val(login);
    $('#password').attr('disabled',true);
    $('.boutons_pour_ajouter').hide();
    $('.boutons_valider_annuler').show();

});





$('.bouton_delete_user').click(function () {
    //alert($('#users_list').val());
    var texte=$('#users_list').val()+'';
    var valeur=texte.split('/');
    var id_user=valeur[0];
     var name=valeur[1];
    var login=valeur[2];

    /*$('#name').val(name);
    $('#login').val(login);*/
    $('.boutons_pour_ajouter').hide();
    $('.boutons_valider_annuler').show();



     var url="ajax/delete_user.php?user_id="+id_user;
     //alert(url);
     $.ajax({
     url : url,
     type : 'GET',
     dataType : 'html',
     success : function(code_html, statut){
         $('#users_list > option[value="'+id_user+'/'+name+'/'+login+'"]').remove();

     },
     error : function(resultat, statut, erreur){
     alert(resultat.responseText);
     }


     });
});



$('.bouton_cancel').click(function () {
    $('.boutons_valider_annuler').hide();
    $('.boutons_pour_ajouter').show();
    $('#password').attr('disabled',false);

});





$('.bouton_edit_user_ok').click(function () {

    $('.boutons_pour_ajouter').hide();
    $('.boutons_valider_annuler').show();



    var url="ajax/edit_user.php?user_id="+id_user+"&name="+$('#name').val()+"&login="+$('#login').val();
    //alert(url);
    $.ajax({
        url : url,
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            //alert('ok');
            //alert($('#users_list > option[value="'+id_user+'/'+name+'/'+login+'"]').html());
            $('#users_list > option[value="'+id_user+'/'+name+'/'+login+'"]').html($('#name').val());
            $('#users_list > option[value="'+id_user+'/'+name+'/'+login+'"]').attr('value',id_user+'/'+$('#name').val()+'/'+$('#login').val());

            $('.block_action_effectue').hide(100);
            $('.block_action_effectue').show(500);

            $('#name').html('');
            $('#login').html('');


            $('.texte_action').html('The user has beeen updated ')
        },
        error : function(resultat, statut, erreur){
            alert(resultat.responseText);
        }


    });
});



$('.bouton_add_user').click(function () {

    var url="ajax/add_user.php?name="+$('#name').val()+"&login="+$('#login').val()+"&password="+$('#password').val();
    //alert(url);
    $.ajax({
        url : url,
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            //alert(code_html);
            $('#users_list').html( $('#users_list').html()+'<option value="'+code_html+'/'+$('#name').val()+'/'+$('#login').val()+'">'+$('#name').val() + '</option>');
            //$('#users_list > option[value="'+id_user+'/'+name+'/'+login+'"]').attr('value',id_user+'/'+$('#name').val()+'/'+$('#login').val());

            $('.block_action_effectue').hide(100);
            $('.block_action_effectue').show(500);

            $('#name').val('');
            $('#login').val('');
            $('#password').val('');


            $('.texte_action').html('User added successfully ')
        },
        error : function(resultat, statut, erreur){
            alert(resultat.responseText);
        }


    });
});
