"use strict";

var validate = false;

document.addEventListener("DOMContentLoaded", function() {
    console.log(" Mon fichier deck Html est bien chargé ");

    let myForm = document.getElementById('choix_deck_form');
    //console.log(myForm);

    let mySubmit = document.getElementById('choixsubmit');
    //console.log(mySubmit);

    //on cache le submit
    // $(".new_deck").hide();
    //$("#choixsubmit").attr('disabled', true);
    
    $(".new_deck").slideUp();
    $(".nomDeckClass").slideUp();

    $("#idNomDeck").css("color", "grey");
    var cptCreatures=0;
    var cptSorts=0;
    var cptBoucliers=0;

    $(".input_choix").prop('checked',false);
    $(".superHeros").prop('checked',true);


    $(".clickChoix").click(function() 
    {
        var borderValide = /borderValide/;
        var resulBorderV = borderValide.test( $(this).attr('class'));


        let monInput = $(this).children('input');
        $(this).removeClass('ValideBorderGreen');
        if (resulBorderV) 
            {
            $(this).removeClass('borderValide');
            monInput.prop('checked',false);
            }   
        else 
            {
            $(this).addClass('borderValide');

            monInput.prop('checked', true); 
            }
        //console.log(monInput);
       
        

        let data = new FormData(myForm);
        let forInput = $(this).attr("for") ;
        //console.log($("#"+forInput));

        let input = $("#" + forInput);
        var typeInput = input.attr("data-type");
       
   

    
                                
        if (input.is(':checked'))
            {
                //console.log(typeInput); 
                switch (typeInput) 
                {

                    case "1":
                        cptCreatures++;
                        break;
                    case "2":
                        cptSorts++;
                        break;
                    case "3":
                        cptBoucliers++;
                        break;
                }
            }
        else 
            {
                    //console.log(input + " " + " >< not checked ");
                    //data.append(input.attr("name"), input.attr("value"));
                    switch (typeInput) 
                    {

                    case "1":
                        cptCreatures--;
                        break;
                    case "2":
                        cptSorts--;
                        break;
                    case "3":
                        cptBoucliers--;
                        break;
                    }
                    //console.log(forInput + " n'est malheuresement pas checked" + $("#"+forInput).attr('class'));
            }

        //console.log(cptBoucliers+ " " + cptSorts +" "+ cptCreatures);
        if (cptCreatures != 12)
            {
                            document.getElementById("idCrea").innerText = " Vous devez choisir 12 creatures ";
                            $("#idCrea").slideDown();

                            document.getElementById("idCrea").className = "rouge";
                            $("#idSor").slideUp();
                            $("#idBou").slideUp();
                            $(".nomDeckClass").slideUp();
            }
        else if (cptBoucliers != 4) 
            {
                            $("#idCrea").slideDown();
                            document.getElementById("idCrea").innerText = " Vous avez choisi 12 creatures ";
                             
                            document.getElementById("idCrea").className = "bleue";
                        
                            document.getElementById("idBou").innerText = " Vous devez choisir 4 boucliers ";
                             $("#idBou").slideDown();
                            document.getElementById("idBou").className = "rouge";
                            $(".nomDeckClass").slideUp();
            }
        else if (cptSorts != 3) 
            {
                $("#idCrea").slideDown();
                document.getElementById("idCrea").innerText = " Vous avez choisi 12 creatures ";
                 
                 //$("#idCrea").slideDown();
                document.getElementById("idCrea").className = "bleue";

                document.getElementById("idBou").innerText = " Vous avez choisi 4 boucliers ";
                 $("#idBou").slideDown();
                document.getElementById("idBou").className = "bleue";

                //
                document.getElementById("idSor").innerText = cptSorts + " Vous devez choisir 3 sorts " ;
                 $("#idSor").slideDown();
                document.getElementById("idSor").className = "rouge";
                $(".nomDeckClass").slideUp();
            }
        else
            {

                    document.getElementById("idCrea").innerText = " Vous avez choisi 12 creatures ";
                    document.getElementById("idCrea").className = "bleue";

                    document.getElementById("idBou").innerText = " Vous avez choisi 4 boucliers ";
                    document.getElementById("idBou").className = "bleue";

                    document.getElementById("idSor").innerText = " Vous avez choisi 3 sorts ";
                    document.getElementById("idSor").className = "bleue";
                    console.log("je suis daccord");
                    
                    ajax('./index.php?control=deck&action=verifCreateTeam', data, function (e) 
                    {
                        console.log("dans ajax");
                        if (e !== "")
                        {

                            try{
                                var jsDec = JSON.parse(e);
                                console.log(jsDec);

                                    
                                if (jsDec['validateTeam'] == 1)
                                {   
                                    //si le json envoyé est correcte on peut ecrire le nom du deck 
                                    $(".nomDeckClass").slideDown();
                                    console.log("on va choisir le nom de son deck");

                                    //choix_deck_submit
                                    $("#idNomDeck").on("keyup", function(event){
                                        console.log("iput nom je tappe");

                                   // $("#choixsubmit").prop("type","button");
                                   
                                    ajaxNomDeck();
                                });


                                
                                    
                                    
                                }
                                else
                                {
                                    console.log ("erreur ");
                                    //document.location.href="?control=deck&action=create"; 
                                }
                                          
                                    
                                }
                            catch(e)  
                                {   
                                    console.log("dans le catch  " +e)
                                    //document.location.href="?control=deck&action=create"; 
                                } 

                        
                            
                        }
                    });
            }
        });
        
    });

    /*
    ajax('./index.php?control=deck&action=verifCreateTeam', data, function (e) {

        //myForm.style.border = '4px solid red';
        //console.log("premier appel ajax");
        console.log(e);
        if (e !== "")
        {

            try{
                var jsDec = JSON.parse(e);
            }
            catch(e){

        }

            console.log(jsDec);
           // console.log(jsDec["txtCreatures"]);

            if (jsDec['validateTeam'] == 0)
            {



                //document.getElementById("idNomCre").removeChild(divCrea);
                if (jsDec["txtCreatures"]) {
                    document.getElementById("idCrea").innerText = jsDec["txtCreatures"];
                    $("#idCrea").slideDown();

                    document.getElementById("idCrea").className = "rouge";
                    $("#idSor").slideUp();
                    $("#idBou").slideUp();
                }
                else if (jsDec["txtBoucliers"]) {
                    $("#idCrea").slideDown();
                    document.getElementById("idCrea").innerText = " Vous avez choisi 12 creatures ";
                     
                     //$("#idCrea").slideDown();
                    document.getElementById("idCrea").className = "bleue";
                    //
                    document.getElementById("idBou").innerText = jsDec["txtBoucliers"];
                     $("#idBou").slideDown();
                    document.getElementById("idBou").className = "rouge";
                }
                else 
                if (jsDec["txtSorts"]) {

                     $("#idCrea").slideDown();
                    document.getElementById("idCrea").innerText = " Vous avez choisi 12 creatures ";
                     
                     //$("#idCrea").slideDown();
                    document.getElementById("idCrea").className = "bleue";

                    document.getElementById("idBou").innerText = " Vous avez choisi 4 boucliers ";
                     $("#idBou").slideDown();
                    document.getElementById("idBou").className = "bleue";

                    //
                    document.getElementById("idSor").innerText = jsDec["txtSorts"];
                     $("#idSor").slideDown();
                    document.getElementById("idSor").className = "rouge";
                }
                else 
                if (jsDec["txtCreatures"] == "" && jsDec["txtBoucliers"] == "" && jsDec["txtSorts"] == "") {
                    
                    

                    let nomDeck = document.createElement("p");
                    nomDeck.innerText = " Veuillez saisir le nom de votre deck";
                    nomDeck.className = "bleue";
                    document.getElementById("choix_deck_form").appendChild(nomDeck);


                }
            }
            else
                {
                    if (jsDec['validateTeam'] == 1) {
                        $("#choixsubmit").attr('disabled', false);

                        document.getElementById("idCrea").innerText = " Vous avez choisi 12 creatures ";
                        document.getElementById("idCrea").className = "bleue";

                        document.getElementById("idBou").innerText = " Vous avez choisi 4 boucliers ";
                        document.getElementById("idBou").className = "bleue";

                        document.getElementById("idSor").innerText = " Vous avez choisi 3 sorts ";
                        document.getElementById("idSor").className = "bleue";


                        $("#idNommDeckform").slideDown();
                        $(".panel-body").slideDown();
                        // $('#choix_deck_form').submit()
                    }
                }

            }

        });
    */
      


function ajax(file, data, fct) {
    var query = new XMLHttpRequest();
    query.onreadystatechange = function(e) {
        if(this.readyState == 4 && this.status == 200)
       {
       		//console.log("dans mon ajax");
       		//console.log(query.responseText);
            fct(query.responseText);
       } 
           
    };
    query.open('POST', file, true);
    query.send(data);
}

function submitMyForm(){
        console.log(" je vais soumettre mon formulaire");
        $("#choix_deck_form").submit();
    }


function ajaxNomDeck(){
    console.log("je suis dans ajax Nom Deck");
    $(".new_deck").slideDown();

    let myForm = document.getElementById('choix_deck_form');
    let data = new FormData(myForm);


    ajax('./index.php?control=deck&action=verifNomDeck', data, function (e) 
    {
        console.log(e);
        if (e !== "")
            {
                var jsDec = JSON.parse(e);

                    if ( jsDec["validateNomTeam"] == 1)
                    {
                        $("#idErreurNomDeck").slideDown();
                        $("#idErreurNomDeck").attr("class","rouge");
                        if ( jsDec["nomDeck"] == ""){
                            $("#idErreurNomDeck").html(" Veuillez choisir le nom de votre deck ");
                        }else{
                            $("#idErreurNomDeck").html(" Vous avez déjà un dech avec ce nom : " +jsDec['nomDeck']);
                        }
                        validate =false;

                        
                    }
                    else if (jsDec["validateNomTeam"] == 2)
                    {

                       // if (  jsDec["nomDeck"].length >= 3 )
                        //{
                            validate = true;
                             $("#idErreurNomDeck").slideDown();
                             $("#idErreurNomDeck").attr("class","bleue");
                             $("#idErreurNomDeck").html("Le nom de votre deck sera "+jsDec['nomDeck']);


                           $("#choixsubmit").prop("type","submit");
                           // setTimeout( submitMyForm(), 4000);
                            

                        }
                        else if (jsDec["validateNomTeam"] == 3){
                            validate = false;
                            $("#choixsubmit").prop("type","button");
                            $("#idErreurNomDeck").slideDown();
                            $("#idErreurNomDeck").attr("class","rouge");
                            $("#idErreurNomDeck").html("Le nom de votre deck doit comporter minimun 3 caractères");
                    }
                }
        });
    }

