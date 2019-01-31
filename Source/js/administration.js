// fonctions Jquery et Ajax

$(document).ready(function(){

    // pour afficher la fenetre modale d'inscription
    $("#inscript").click(function(){
        // pour vider les champs
        $("#usrname").val(""); 
        $("#firstname").val("");  
        $("#email_inscrip").val("");  
        $("#password1").val("");  
        $("#password2").val("");  
        $("#error_msg1").val("");         
        $("#modalInscrip").modal();
    });

    // pour afficher la fenetre modale d'inscription
    $("#signUp").click(function(){
        $("#modalLogin").modal("hide");
        // pour vider les champs
        $("#usrname").val(""); 
        $("#firstname").val("");  
        $("#email_inscrip").val("");  
        $("#password1").val("");  
        $("#password2").val("");  
        $("#error_msg1").val(""); 
        $("#modalInscrip").modal();
    });

    // pour afficher la fenetre modale de login
    $("#login").click(function(){ 
        //pour vider les champs 
        $("#email_log").val(""); 
        $("#psw_log").val(""); 
        $("#error_msg").val("");            
        $("#modalLogin").modal();
    });

    // pour afficher la fenetre modale de mot de passe oublié
    $("#pass").click(function(){
        $("#modalLogin").modal("hide");
        // pour vider les champs
        $("#email_forgot").val(""); 
        $("#error_msg2").val("");   
        $("#modalPass").modal("show");
    });

    // pour gérer la deconnexion
    $(".deconnection").click(function(){
        $("#logout").modal("show");      
        $("#navbar_connect").css('display','none');
        $("#navbar_admin").css('display','none');
        $("#navbar_invite").css('display','block');
    });
   
    // pour gérer mot de passe oublié
    $("#submit_forgot").click(function(e){
        // alert("OK")
        e.preventDefault();
        $.post(
            'php/pwd_forgot.php',
        {
             email_forgot : $("#email_forgot").val(),
        },
        function(data){
            if(data == 'Invalid'){ 
                $("#error_msg2").css('color','red'); 
                $("#error_msg2").html("<p>Votre email n'est pas reconnu.</p>");
                $("#modalPass").modal("show");
            }  
            else{
                $("#modalPass").modal("hide"); 
                $("#mail_psw").modal("show");                 
            }   
        },
        'text'
        );  
         
    });

    // pour valider le login
    $("#submit_login").click(function(e){
        // alert("OK")
        e.preventDefault();
        $.post(
            'php/login.php',
        {
             email : $("#email_log").val(),
             psw : $("#psw_log").val()
        },
        function(data){
            if(data != 'Invalid_Email' && data != 'Invalid_Password'){ 
                // Login OK
                $("#modalLogin").modal("hide");
                $("#navbar_invite").css('display','none');
                // pour découper la réponse 
                tab = data.split("/");

                // affiche le role de l'utilisateur (1=Utilisateur, 2=Administrateur)
                if (tab[2] == "1")
                { 
                    // affiche le nom de l'utilisateur dans le menu
                    $("#user1").html(tab[0]+" "+tab[1]);
                    $("#role1").html("Utilisateur");  
                    $("#navbar_admin").css('display','none');
                    $("#navbar_connect").css('display','block');   
                }
                else if (tab[2] == "2")
                {
                    // affiche le nom de l'utilisateur dans le menu
                    $("#user2").html(tab[0]+" "+tab[1]);
                    $("#role2").html("Administrateur");
                    $("#navbar_connect").css('display','none');
                    $("#navbar_admin").css('display','block');
                }

            }else{ 
                if (data == 'Invalid_Email') {
                    $("#error_msg").css('color','red'); 
                    $("#error_msg").html("<p>Cet email n'existe pas dans l'application.</p>");
                    $("#modalLogin").modal("show");
                } else if (data == 'Invalid_Password') {
                    $("#error_msg").css('color','red'); 
                    $("#error_msg").html("<p>Votre mot de passe est incorrect.</p>");
                    $("#modalLogin").modal("show");
                }

            }       
        },
        'text'
        );   
    });

    // pour valider l'inscription  
    $("#submit_inscrip").click(function(e){
        // alert("OK")
        e.preventDefault();
        // verification de la longueur du mot de passe 
        // le mot de passe doit comporter au moins 6 caractères
        if (!$("#password1").val().match(/^[a-z0-9]{8,}$/i))
        {
            $("#password1").css('border-color','red');
            $("#error_msg1").css('color','red'); 
            $("#error_msg1").html("<p>Le mot de passe doit comporter au moins 8 caractères valides.</p>");
            $("#modalInscrip").modal("show");
        } else 
        {
            // verification que les deux champs mot de passe identiques      
            if ($("#password1").val() != $("#password2").val())
            {
                $("#password1").css('border-color','red');
                $("#password2").css('border-color','red');
                $("#error_msg1").css('color','red'); 
                $("#error_msg1").html("<p>Confirmation du mot de passe invalide.</p>");
                $("#modalInscrip").modal("show");
            }
            else
            {
                $.post(
                    'php/inscription.php',
                {
                        firstname : $("#firstname").val(),
                        usrname : $("#usrname").val(),
                        email_inscrip : $("#email_inscrip").val(),
                        psw1 : $("#password1").val(),
                },
                function(data){
                    if(data != 'Invalid'){ 
                        $("#modalInscrip").modal("hide");
                        $("#mail_inscrip").modal("show"); 

                    }else{  
                        $("#error_msg1").css('color','red'); 
                        $("#error_msg1").html("<p>Cette adresse mail est déjà utilisée.</p>");
                        $("#modalInscrip").modal("show");
                    }       
                },
                'text'
                );
            }; 
        };
    });

});

