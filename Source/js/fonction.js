// fonctions Jquery et Ajax

$(document).ready(function(){
    // pour afficher la fenetre modale d'inscription
    $("#inscript").click(function(){
        $("#modalInscrip").modal();
    });

    // pour afficher la fenetre modale d'inscription
    $("#signUp").click(function(){
        $("#modalLogin").modal("hide");
        $("#modalInscrip").modal();
    });

    // pour afficher la fenetre modale de login
    $("#login").click(function(){
        $("#modalLogin").modal();
    });

    // pour afficher la fenetre modale de mot de passe oublié
    $("#pass").click(function(){
        $("#modalLogin").modal("hide");
        $("#modalPass").modal();
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
            if(data != 'Invalid'){ 
                $("#modalLogin").modal("hide");
                $("#navbar_connect").toggle();
                $("#navbar_invite").toggle();
                $("#user").html(data);

            }else{  
                $("#error_msg").css('color','red'); 
                $("#error_msg").html("<p>Votre email ou votre mot de passe est incorrect.</p>");
                $("#modalLogin").modal("show");
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

