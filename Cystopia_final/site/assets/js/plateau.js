$(function()
{
    
    // Append divs chevrons vides PV**********************

    for (i = 1; i < 3; i++)
    {
        for (j = 0; j < 20; j++)
        {
            var pos = j / 1.4;
            var div = document.createElement('div');
            div.setAttribute('class', 'chevron');
            div.setAttribute('id', 'hero' + i + 'Chev' + j);
            div.setAttribute('style', 'transform: translate(' + pos + 'vmax)');
            document.getElementById('dataHero' + i).appendChild(div);
        }
    }

// Evenements AJAX

    // Evenement click sur le bouton fin de tour

    btnTour = document.getElementById('innerButton');
    btnTour.addEventListener("click", function(){
        data = new FormData();
        data.append('control', 'plateau');
        data.append('action', 'fintour');
        ajax('.', data, function(e) {
            //btnTour.style.border = '1px solid red';
            let data = JSON.parse(e);
            console.log(data);
            if ( data.initiative == 1 ){
                if ( $("#innerButton").hasClass("redBorder"))
                {
                    $("#innerButton").removeClass("redBorder");
                }
                else{
                    $("#innerButton").addClass("redBorder");
                }
            }

            //console.log(e);
        });
    });


    // Retire l'utilisateur en session de la table "liste attente"
    let data = new FormData();
    data.append('control', 'lobby');
    data.append('action', 'initGame');
    ajax('.', data, function (response) {});

});


    function replaceCardMain(hand) {

        // var elm = $( hand === 1 ? '#hand1' : '#hand2');

        if(hand === 1) elm = $('#hand1').find(".carte");
        else if(hand === 2) elm = $('#hand2').find(".carteFront");

        var nbCartes = elm.length;
        var tailleMain = 22; // (en vmax)
        var tailleCarte = tailleMain / 3.5;
        var reste = tailleMain / nbCartes;
        var decal = (tailleMain - (tailleCarte - reste)) / nbCartes;

        for (i = 0; i < nbCartes; i++)
        {
            left = decal * i;

            var div3 = elm[i];
            var h = hand === 1 ? -4.3 : 0;
            div3.style.transform = 'translate(' + left + 'vmax, '+h+'vmax)';
        }
    }

    function replaceCardPlateau() {
        var elm = $('#dropperAdversaire .carte');
        var countCards = elm.length;
        if(countCards > 8) {
            var margin = (countCards*7.5) / 30 ;
            for(var i = 0; i<countCards; i++) {
                elm[i].style.marginRight = '-'+margin+'vmax';
            }
        }
        elm = $('#dropper .carteFront');
        countCards = elm.length;
        if(countCards > 8) {
            var margin = (countCards*7.5) / 30 ;
            for(var i = 0; i<countCards; i++) {
                elm[i].style.marginRight = '-'+margin+'vmax';
            }
        }
    }

    function generateCard(index, name, type, description, mana, attack, defense, src, carteId, adversaire) {
        let classResult = adversaire == 0 ? 'carteFront handplayer' : 'carte';
        let html = '<div style="background-image: url(\'assets/'+src+'\')" class="'+classResult+'" id="carteId_' + carteId + '"><div data-mana="'+mana+'" class="carteNum carteMana">'+mana+'</div><div data-attaque="'+attack+'" class="carteNum carteAttaque">'+attack+'</div>';
        if (type != 2) html += '<div data-vie="'+defense+'" class="carteNum carteVie">'+defense+'</div>';
        html += '<div data-name="'+name+'" class="carteData carteNom">'+name+'</div><div data-description="'+description+'" class="carteData carteText">'+description+'</div></div>';
        return html;
    }

    function generateCardOpponent() {
       let html = '<div style="background-image: url(\'assets/images/carte_dos.png\')" class="carte"> </div>';
       return html;
    }
























