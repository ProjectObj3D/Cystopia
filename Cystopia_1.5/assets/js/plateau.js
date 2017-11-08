window.onload = function()
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

    // Affichage Tour Num *************************

    var tourNum = document.getElementById('tourNum').textContent;
    if (tourNum > 9)
    {
        document.getElementById('tourNum').style.cssText = 'letter-spacing: -.75vmax; margin-left: -1.3vmax;';
    }

    // Append divs chevrons vides mana************************

    for (i = 1; i < 3; i++)
    {
        for (j = 0; j < tourNum; j++)
        {
            var pos2 = j * 1.2;
            var div2= document.createElement('div');
            div2.setAttribute('class', 'Mchevron');
            div2.setAttribute('id', 'manaHero' + i + 'Chev' + j);
            div2.setAttribute('style', 'transform: translate(' + pos2 + 'vmax)');
            document.getElementById('manaChevWrap' + i).appendChild(div2);
        }
    }

    //  Affichage chevrons PV pleins *************************


    for (i = 1; i < 3; i++)
    {
        var pv = document.getElementById('PvHero' + i).textContent;

        for (j = 0; j < pv; j++)
        {
            document.getElementById('hero' + i + 'Chev' + j + '').classList.add('Bchevron');
            document.getElementById('hero' + i + 'Chev' + j + '').classList.remove('chevron');
        }
    }

    // Affichage chevrons mana pleins *************************

    for (i = 1; i < 3; i++)
    {
        var mana = document.getElementById('hero' + i + 'ManaNum').textContent;

        for (j = 0; j < mana; j++)
        {
            document.getElementById('manaHero' + i + 'Chev' + j + '').classList.add('Gchevron');
            document.getElementById('manaHero' + i + 'Chev' + j + '').classList.remove('Mchevron');
        }
    }

    //  Main 1 - Position des cartes selon leur nombre ************************


    var tailleMain = 22; // (en vmax)

    var tailleCarte = tailleMain / 3.5;

    var nbCartes = document.getElementById('hand1').childElementCount;

    var reste = tailleMain / nbCartes;

    var decal = (tailleMain - (tailleCarte - reste)) / nbCartes;

    for (i = 0; i < nbCartes; i++)
    {
        left = decal * i;

        var div3 = document.getElementById('hero1carte' + i);
        div3.style.transform = 'translate(' + left + 'vmax, -4.3vmax)';
    }


    var nbCartes2 = document.getElementById('hand2').childElementCount;

    var reste2 = tailleMain / nbCartes2;

    var decal2 = (tailleMain - (tailleCarte - reste2)) / nbCartes2;

    for (i = 0; i < nbCartes2; i++)
    {
        left = decal2 * i;

        var div4 = document.getElementById('hero2carte' + i);
        div4.style.transform = 'translate(' + left + 'vmax, 0vmax)';
    }

    //  Creation des 20 divs du deck 1 **********************


     for (j = 0; j < 20; j++)
     {
         var div4 = document.createElement('div');
         div4.setAttribute('class', 'cartePioche');
         div4.setAttribute('id', 'carte' + j);
         document.getElementById('deck1').appendChild(div4);
     }


     // Affichage image hero en fonction de sa position (deux images différentes par héro)

     var getName1 = document.getElementById('heroName1').textContent;
     var heroName1 = getName1.toLowerCase();
     heroName1 = heroName1.replace(' ', '');
     document.getElementById('imgHero1').style.backgroundImage = 'url("assets/images/heros/' + heroName1 + '_1.png")';

     var getName2 = document.getElementById('heroName2').textContent;
     var heroName2 = getName2.toLowerCase();
     heroName2 = heroName2.replace(' ', '');
     document.getElementById('imgHero2').style.backgroundImage = 'url("assets/images/heros/' + heroName2 + '_2.png")';


    var carte = document.getElementById("hero2carte1");
    document.getElementById("hand2").appendChild(carte);



    btnTour = document.getElementById('innerButton');
    btnTour.addEventListener("click", function(event){
        data = new FormData();
        data.append('control', 'plateau');
        data.append('action', 'fintour');
        ajax('./index.php', data, function(e) {
            btnTour.style.border = '1px solid red';
            console.log(e);
        });
    });

};


function ajax(file, data, fct) {
    var query = new XMLHttpRequest();
    query.onreadystatechange = function(e) {
        switch (query.readyState) {
            case 4:
                if (query.status == 200) {
                    
                    fct(query.responseText);
                }
                break;
        }
    };
    query.open('POST', file, true);
    query.send(data);
}




















