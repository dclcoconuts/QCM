<!-- Gestion du header de l'application et des connexions -->

<header>
<nav id="navbar_invite" class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">QCM</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><button type="button" class="glyphicon glyphicon-user" id="inscript"> S'INSCRIRE</button></li>
        <li><button type="button" class="glyphicon glyphicon-log-in" id="login"> SE CONNECTER</button></li>
    </ul>
    </div>
  </div>
</nav>

<nav id="navbar_connect" class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu_connect">
        <span class="glyphicon glyphicon-user"></span>  
      </button>
      <a class="navbar-brand" href="#">QCM</a>
    </div>
    <div class="collapse navbar-collapse" id="menu_connect">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">          
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-user"></span>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li id="user"></li>
            <li><a href="#">Créer un QCM</a></li>
            <li><a href="#">Modifier un QCM</a></li>
            <li><a href="#">Gérer mes QCMs</a></li>
            <li><a href="#">Déconnexion</a></li>           
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<nav id="navbar_admin" class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu_connect">
        <span class="glyphicon glyphicon-user"></span>  
      </button>
      <a class="navbar-brand" href="#">QCM</a>
    </div>
    <div class="collapse navbar-collapse" id="menu_connect">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">          
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-user"></span>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li id="user"></li>
            <li><a href="#">Créer un QCM</a></li>
            <li><a href="#">Modifier un QCM</a></li>
            <li><a href="#">Gérer mes QCMs</a></li>
            <li><a href="#">Administration des QCMs</a></li>           
            <li><a href="#">Déconnexion</a></li>           
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

       <!--  fenetre modale de connexion -->
       <div class="connexion">
        <!-- Modal -->
        <div class="modal fade" id="modalLogin" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
                </div>
                <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
                    <input type="email" class="form-control" name="email_log" id="email_log" placeholder="Entrer votre email" required>
                    </div>
                    <div class="form-group">
                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                    <input type="password" class="form-control" name="psw_log" id="psw_log" placeholder="Enter password" required>
                    </div>
                    <div id="error_msg">
                        <p></p>
                    </div>
                    <button type="submit" id="submit_login" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                </form>

                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <p>Pas encore inscrit ? <a href="#" id="signUp"> S'Inscrire</a></p>
                <p>Mot de passe oublié ? <a href="#" id="pass"> Réinitialiser</a></p>
                </div>
            </div>
            </div>
        </div>
        </div> 

        <!--  fenetre modale d'inscription -->
        <div class="inscription">
        <!-- Modal -->
        <div class="modal fade" id="modalInscrip" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Inscription</h4>
                </div>
                <div class="modal-body">
                <form role="form">
                <div class="form-group">
                    <label for="name"><span class="glyphicon glyphicon-user"></span> Prénom</label>
                    <input type="text" class="form-control" id="firstname" placeholder="Entrer votre prénom" required>
                    </div>
                    <div class="form-group">
                    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Nom</label>
                    <input type="text" class="form-control" id="usrname" placeholder="Entrer votre nom" required>
                    </div>
                    <div class="form-group">
                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Adresse mail</label>
                    <input type="email" class="form-control" id="email_inscrip" placeholder="Entrer votre adresse email" required>
                    </div>
                    <div class="form-group">
                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Mot de passe</label>
                    <input type="password" class="form-control" id="password1" placeholder="Entrer votre mot de passe" required>
                    </div>
                    <div class="form-group">
                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Confirmer votre mot de passe</label>
                    <input type="password" class="form-control" id="password2" placeholder="Confirmer votre mot de passe" required>
                    </div>
                    <div id="error_msg1">
                        <p></p>
                    </div>
                    <button type="submit" id="submit_inscrip" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> S'inscrire</button>
                </form>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <p>Vous aller recevoir un email pour</p>
                <p>confirmer votre inscription</p>
                </div>
            </div>
            </div>
        </div>
        </div> 

       <!--  fenetre modale de mot de passe oublié -->
       <div class="password">
        <!-- Modal -->
        <div class="modal fade" id="modalPass" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Mot de passe oublié</h4>
                </div>
                <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                    <label for="email"><span class="glyphicon glyphicon-user"></span> Entrer votre mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Entrer votre mail" required>
                    </div>
                    <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Envoyer votre demande</button>
                </form>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <p>Vous aller recevoir un email pour</p>
                <p>retrouver votre mot de passe</p>
                </div>
            </div>
            </div>
        </div>
        </div> 


<script>


</script> 
</header>

