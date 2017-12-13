"use strict"

var validate = false;
//var ajaxEnCours = false:
document.addEventListener("DOMContentLoaded", function() {
    


    
    $("#choixsubmit").on("click", function(event){

        $("#choixsubmit").prop("type","button");
       
        validNomDeck();
    });


    function submitMyForm(){
        console.log(" je vais soumettre mon formulaire");
        $("#idNommDeckform").submit();
    }

     function validNomDeck() {
    //$("#idNomDeck").trigger("change", function(fct){
        
        let myForm = document.getElementById('idNommDeckform');
        let data = new FormData(myForm);

        ajax('./index.php?control=deck&action=verifNomDeck', data, function (e) {
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
                            $("#idErreurNomDeck").html("Vos avez déjà un deck avec ce 'nom'");
                        }
                        validate =false;

                        
                    }
                    else if (jsDec["validateNomTeam"] == 2)
                    {

                       // if (  jsDec["nomDeck"].length >= 3 )
                        //{
                            validate = true;
                            // $("#idErreurNomDeck").slideDown();
                            // $("#idErreurNomDeck").attr("class","bleue");
                            // $("#idErreurNomDeck").html("Le nom de votre deck sera "+jsDec['nomDeck']);


                          // $("#choixsubmit").prop("type","submit");
                            setTimeout( submitMyForm(), 4000);
                            

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
        };
        
   // }




});


var query = new XMLHttpRequest();


function ajax(file, data, fct) {
    //ajaxEnCours = true;
    
    query.onreadystatechange = function(e) {
        validate = false;

        if(this.readyState == 4 && this.status == 200)
        {
            //ajaxEnCours = true;
            fct(query.responseText);
        }

        //ajaxEnCours = false;
    };
    query.open('POST', file, true);
    query.send(data);
}