<section class="container" style="margin-top: 60px;">

    <div class="row">
        <div class="col-sm-12 col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" >
            <div class="panel panel-primary" style="box-shadow: 0 0 15px #c7c7c7;">
                <div class="panel-heading" style="background-color: #222222">
                    <h4>Connectez-vous !</h4>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-group">
                        <div>
                            <label style="text-align: left; position: relative; color: #777">Login</label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                <input type="text" class="form-control input-lg" name="login" placeholder="Nom Utilisateur / Email" id="email" value="">
                            </div>
                            <p class="text-danger text-right" style="margin-top: -8px; text-blink: 2;"><?php //echo $loginErr;?></p>
                        </div>



                        <div style="position: relative; top: 20px;">
                            <label style="text-align: left; position: relative; color: #777;">Mot de passe</label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                <input class="form-control input-lg" type="password" id="password" name="mot-de-passe" placeholder="Mot de passe" value="">
                            </div>
                            <p class="text-danger text-right" style="margin-top: -8px"><?php //echo $passwdErr;?></p>
                            <br>
                        </div>

                        

                        

                        <div class="alert alert-danger login_message_erreur hidden">
                          <strong>Email/Login ou mot de passe incorrect</strong> 
                        </div>

                        <hr>
                        <div class="form-group">
                            <input class="btn btn-primary btn-lg pull-left" type="button" id="bouton_valider_connexion" style="width: 160px;" value="Entrer" />
                            <button class="btn btn-default btn-lg pull-right" type="reset">Annuler</button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-footer text-center">
                    <div style="height: 25px; font-size: 1.2em;">
                        <p>
                            <a href="#" class="text-danger">Mot de passe oublié ?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>

<section class="text-center">
    <h3 style="font-size: medium">
        <!--Pour ouvrir un compte <a href="../#inscription">inscrivez-vous</a> ici !-->
    </h3>
</section>
