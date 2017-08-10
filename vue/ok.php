public static function getLogTable($logs){

    return \TableView::collection($logs)
        ->column('Couleur', function($log){ return "<div class='col-md-2'><label style='font-size: 20px font-weight: bold;padding-right: 10px'>".$log->type_log->couleur."</label></div>"; })
        ->column('Ref_user', function($log){ return "<div class='col-md-2'><label style='font-size: 20px font-weight: bold;padding-right: 10px;'>".$log->user->ref_user."</label></div>"; })
        ->column('Nom_classe', function($log){ return "<div class='col-md-2'><label style='font-size: 20px font-weight: bold;padding-right: 10px'>".$log->nom_classe."</label></div>"; })
        ->column('Nom_methode', function($log){ return "<div class='col-md-2'><label style='font-size: 20px font-weight: bold;padding-right: 10px'>".$log->nom_methode."</label></div>"; })
        ->column('Code', function($log){ return "<div class='col-md-12'><label style='font-size: 20px font-weight: bold;padding-right: 10px'>".$log->code."</label></div>"; })
        ->column('Actions', function($log){
            $details = "<button data-toggle= 'modal' style='padding: 5px ;text-align: center'; class='btn btn-success btn-block' data-target='#details_des_logs.$log->ref_dossier' aria-hidden='true' style='cursor:pointer'> <i class='fa fa-search'></i> Détails </button>";
            $masquer = "<form id='form_delete_template' name='form_create_template'method='POST'class='form-parametres'action=\"/mes_parametres/delete_template/$log->id\"onsubmit=\"return confirm('Voulez vous vraiment supprimer ce modèle ?');\"role='form' enctype='multipart/form-data'><input type='hidden' name='_method' value='DELETE'><button id='button_modele_delete' type='submit'class='btn btn-s btn-block'><i class='fa fa-trash' style='padding-right: 5px;'></i> Supprimer</button></form>";
            return "<div class='row'><div class='col-md-6'>$details</div><div class='col-md-6'>$masquer</div></div>";})
        ->build();
}