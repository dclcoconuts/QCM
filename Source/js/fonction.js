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


});

