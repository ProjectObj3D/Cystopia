$(function () {


    function highLightMana()
    {
        for (i = 1; i < 3; i++)
        {
            var mana = document.getElementById('hero' + i + 'ManaNum').textContent;

            for (j = 0; j < mana; j++)
            {
                //document.getElementById('manaHero' + i + 'Chev' + j + '').classList.add('Gchevron');
                $("#manaHero"+i+"Chev"+j+"").addClass("Gchevron");
                // document.getElementById('manaHero' + i + 'Chev' + j + '').classList.remove('Mchevron');
            }
        }
    }



    function emptyMana()
    {

        // Affichage Tour Num *************************

        var tourNum = document.getElementById('tourNum').textContent;
        if (tourNum > 9) {
            document.getElementById('tourNum').style.cssText = 'letter-spacing: -.75vmax; margin-left: -creatures.3vmax;';
        }

        // Append divs chevrons vides mana************************

        for (i = 1; i < 3; i++) {

            let tourMana = tourNum < 11 ? tourNum : 10;

            for (j = 0; j < tourMana; j++) {
                var pos2 = j * 1.2;
                var div2 = document.createElement('div');
                div2.setAttribute('class', 'Mchevron');
                div2.setAttribute('id', 'manaHero' + i + 'Chev' + j);
                div2.setAttribute('style', 'transform: translate(' + pos2 + 'vmax)');
                document.getElementById('manaChevWrap' + i).appendChild(div2);
            }
        }
    }

    function highLightPV() {
      for (i = 1; i < 3; i++)
        {
            var pv = document.getElementById('PvHero' + i).textContent;
            console.log('PV :'+pv);

            for(j=0; j<20; j++) {
                $('#hero' + i + 'Chev' + j + '').removeClass("chevron");
                $('#hero' + i + 'Chev' + j + '').removeClass("Bchevron");
            }

            for (j = 0; j < 20; j++)
            {
                // document.getElementById('hero' + i + 'Chev' + j + '').classList.add('Bchevron');
                // document.getElementById('hero' + i + 'Chev' + j + '').classList.remove('chevron');
                if(j < pv) {
                    $('#hero' + i + 'Chev' + j + '').addClass("Bchevron");
                }
                else {
                    $('#hero' + i + 'Chev' + j + '').addClass("chevron");
                }
            }
        }
    }



    

    // Affichage image hero en fonction de sa position (deux images différentes par héro)

    function displayHerosImages() {

        var getName1 = document.getElementById('heroName1').textContent;
        var heroName1 = getName1.toLowerCase();
        heroName1 = heroName1.replace(' ', '');
        document.getElementById('imgHero1').style.backgroundImage = 'url("assets/images/heros/' + heroName1 + '_1.png")';

        var getName2 = document.getElementById('heroName2').textContent;
        var heroName2 = getName2.toLowerCase();
        heroName2 = heroName2.replace(' ', '');
        document.getElementById('imgHero2').style.backgroundImage = 'url("assets/images/heros/' + heroName2 + '_2.png")';
    }



    var inDrag = false;
    var interval = setInterval(function()
    {
        var dataGlobal = '';
        console.log('Drag : '+inDrag);

        let data = new FormData();
        ajax('./index.php?control=plateau&action=getHerosData', data, function(response)
        {

            $('#imgHero1').css('border' , 'none');

            let data = JSON.parse(response);
            dataGlobal = data;
            console.log(data);

            console.log('JOUEUR :'+data.joueur.h_tmp_pv);
            console.log('ADV :'+data.adversaire.h_tmp_pv);
            if(data.joueur.h_tmp_pv <= 0) {
                alert('Vous avez perdu.');
                console.log('Vous avez perdu');
                clearInterval(interval);
            }
            else if(data.adversaire.h_tmp_pv <= 0) {
                alert('Vous avez gagné.');
                console.log('Vous avez gagné.');
                clearInterval(interval);
            }


            if ( data.joueur.h_tmp_initiative == 1 ) {
                    $("#innerButton").css({opacity: 1});
                    // console.log( " c'est mon tour de jouer");
            }
            else{
                    $("#innerButton").css({ opacity: 0.4 });
                    // console.log(" c'est pas mon tour de jouer");
                    $("#innerButton").removeClass("redBorder");
                }




            $('#PvHero2').text(data.joueur.h_tmp_pv);
            $('#PvHero1').text(data.adversaire.h_tmp_pv);
            


            // a ajuster si il y a plus de 2 héros :
            let nomJoueur = data.adversaire.h_tmp_team == 1 ? "SEIYA" : "NS5 SONNY";
            $('#heroName1').text(nomJoueur);

            let nomAdversaire = data.joueur.h_tmp_team == 1 ? "SEIYA" : "NS5 SONNY";
            $('#heroName2').text(nomAdversaire);

            let tour =  data.joueur.h_tmp_tour < data.adversaire.h_tmp_tour ? data.joueur.h_tmp_tour : data.adversaire.h_tmp_tour;

            let manaAdver = data.adversaire.h_tmp_mana >= tour && tour <= 10 ? tour : (data.adversaire.h_tmp_mana >= tour && tour > 10) ? 10 : data.adversaire.h_tmp_mana ;
            let manaJou = data.joueur.h_tmp_mana >= tour && tour <= 10 ? tour : (data.adversaire.h_tmp_mana >= tour && tour > 10) ? 10 : data.joueur.h_tmp_mana ;

            $('#hero1ManaNum').text(manaAdver);
            $('#hero2ManaNum').text(manaJou);


            $('#tourNum').html('<span>'+tour+'</span>');

            $('#manaChevWrap1').empty();
            $('#manaChevWrap2').empty();
            emptyMana();
            highLightMana();
            displayHerosImages();
            highLightPV();
        });



        if(inDrag == false) {         // Evenement drag & drop
        
            let dataCard = new FormData();
            dataCard.append('control', 'plateau');
            dataCard.append('action', 'getcards');
            ajax('./index.php', dataCard, function(response){
                var obj = JSON.parse(response);
                var player = obj[obj.length-1].h_tmp_id;
                var adversaire = obj[obj.length-2].h_tmp_id;
                var html1 = '';
                var html2 = '';
                var html3 = '';
                var html4 = '';
                console.log(obj);

                var deadPlayer=0;
                var deadAdversaire=0;
                for(var i=0; i<obj.length-1; i++)
                {
                    console.log(player+' == '+ obj[i].c_tmp_hero_tmp_fk);

                    if(player == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 1 )
                    {
                        html2 += generateCard(i, obj[i].c_tmp_nom, obj[i].c_type, obj[i].c_description, obj[i].c_mana, obj[i].c_attaque, obj[i].c_tmp_defense, obj[i].c_src, obj[i].c_tmp_id, 0);
                    }
                    if(adversaire == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 1 )
                    {
                        html1 += generateCardOpponent();
                    }
                    if(player == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 0 )
                    {
                        $("#deck2").addClass("carte");
                    }
                    if(adversaire == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 0 )
                    {
                        $("#deck1").addClass("carte");
                    }
                    if(adversaire == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 2 )
                    {
                        html3 += generateCard(i, obj[i].c_tmp_nom, obj[i].c_type, obj[i].c_description, obj[i].c_mana, obj[i].c_attaque, obj[i].c_tmp_defense, obj[i].c_src, obj[i].c_tmp_id, 1);
                    }
                    if(player == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 2 )
                    {
                        html4 += generateCard(i, obj[i].c_tmp_nom, obj[i].c_type, obj[i].c_description, obj[i].c_mana, obj[i].c_attaque, obj[i].c_tmp_defense, obj[i].c_src, obj[i].c_tmp_id, 0);
                    }

                    if(player == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 3 ) {
                        deadPlayer++;
                    }
                    if(adversaire == obj[i].c_tmp_hero_tmp_fk && obj[i].c_tmp_position == 2 ) {
                        deadAdversaire++;
                    }

                }

                if(deadPlayer >= 20) {
                    alert('Vous avez perdu.');
                    clearInterval(interval);
                }
                else if(deadAdversaire >= 20) {
                    alert('Vous avez gagné.');
                    clearInterval(interval);
                }


                // $('#dropper .carteFront').css('position', 'relative !important');
                document.getElementById('hand2').innerHTML = html2;
                document.getElementById('hand1').innerHTML = html1;
                $('#dropperAdversaire').html(html3);
                $('#dropper').html(html4);
                replaceCardMain(2);
                replaceCardMain(1);
                replaceCardPlateau();

                var d = new FormData();
                ajax('index.php?control=plateau&action=checkInitiative', d, function(r) {
                    if(r == '1') {
                        $('.handplayer').draggable({
                            revert: function(event, ui) {
                               if(event === false) {
                                   replaceCardMain(2);
                               }
                            }, 
                            start: function() {

                               
                            },
                            drag: function() {
                               $(this).css({'transform':'none', 'z-index':'10'});
                                inDrag=true;
                            },
                            stop: function(event, ui) {
                               $(this).css({'left':'0','top':'0', 'z-index':'0'});
                                var id = this.id;
                                inDrag=false;
                             }
                        }); 

                        $("#dropper").droppable({
                            drop:function(event, ui){
                              
                                var data = new FormData();
                                data.append('cardId', ui.helper.attr('id'));
                                ajax('./index.php?control=plateau&action=checkAllowPlateau', data, function(response) {
                                    console.log(response);
                                    if(response == 'true') {
                                        $('#dropper').append(ui.draggable);
                                        $(ui.draggable).css({'position':'relative', 'transform':'none', 'top':'0', 'left':'0', 'width':'7.5vmax', 'height':'10.5vmax', 'z-index':'100', 'margin' : '0 .5vmax 0'});
                                        replaceCardMain(2);
                                        replaceCardPlateau();
                                        $.getJSON("./index.php?control=plateau&action=displaceCard", "cardId=" + ui.draggable[0].id, function(data){
                                            console.log('>>'+data);
                                        });
                                    }
                                    replaceCardMain(2);
                                });
                                
                                // console.log(ui.draggable[0].id);

                               

                            }
                        });

                        $("#dropperAdversaire .carte").droppable({
                            drop:function(event, ui){

                                let data1 = new FormData();
                                data1.append('heroid', dataGlobal.adversaire.h_tmp_id);
                                data1.append('targetid', event.target.id);
                                ajax('index.php?control=plateau&action=checkBouclier', data1, function(response) {
                                    if(response == 'true') {
                                        let data2 = new FormData();
                                        data2.append('attackId', ui.helper[0].id);
                                        data2.append('targetId', event.target.id);
                                        ajax('index.php?control=plateau&action=attackCard', data2, function(response)
                                        {
                                            let res = JSON.parse(response);
                                            console.log(res);
                                            if(res = 'true')
                                            {
                                                $('#'+event.target.id).css('border' , '1px solid red');
                                            }
                                        });
                                    }
                                    else alert('Vous devez attaquer le boucliers avant les autres cartes.');
                                })
                            }
                        });

                        $("#imgHero1").droppable({
                            drop:function(event, ui){
                                let data1 = new FormData();
                                data1.append('heroid', dataGlobal.adversaire.h_tmp_id);
                                ajax('index.php?control=plateau&action=playerHasBouclier', data1, function(response) {
                                    if(response == 'false') {   // Si il y a pas de bouclier dans l'équipe adverse

                                        let data2 = new FormData();
                                        data2.append('heroid', dataGlobal.adversaire.h_tmp_id);
                                        data2.append('attackId', ui.helper[0].id);
                                        ajax('index.php?control=plateau&action=attackHero', data2, function(response)
                                        {
                                            console.log('HERO :'+response);
                                            if(response == 'true') {
                                                $('#imgHero1').css('border' , '1px solid red');
                                            }

                                        });
                                    }
                                    else alert('Vous devez attaquer le boucliers avant le héro.');
                                });
                            }
                        });
                    }

                    // MODAL CARDS
                    $('.carteFront, #dropperAdversaire .carte').each(function() {}).click(function() { 
                      //$.data(this, 'dialog').dialog('open');
                      var attaque = $(this).find('.carteAttaque').data('attaque');
                      var defense = $(this).find('.carteVie').data('vie');
                      var description = $(this).find('.carteText').data('description');
                      var mana = $(this).find('.carteMana').data('mana');
                      var name_card = $(this).find('.carteNom').data('name');
                      var img = $(this).css('background-image');
                      // console.log('attaque = '+ attaque +' ; defense = '+defense+'; description='+description+'; Mana = '+mana+' ; nom carte = '+name_card+' ; lien img =' + img );
                      $('.img_dialog').css('background-image',img);


                      if($('.dialog_card_description').length)
                      {
                        $('.dialog_card_description').html(description);
                      }
                      else
                      {
                       $('.dialog_content .cardData').last().append($("<div class='dialog_card_description'>"+description+"</div>"));
                      }

                      $('h5[name=nom_carte]').html(name_card);
                      $('div[name=mana]').html('<span>'+mana+'</span><p>INVOCATION</p>');
                      $('div[name=attaque]').html('<span>'+attaque+'</span><p>ATTAQUE</p>');
                 
                      if(defense !== undefined)
                      {
                        $('div[name=defense]').html('<span>'+defense+'</span><p>DEFENSE</p>');         
                      }
                      else
                      {
                        $('div[name=defense] span').replaceWith(" ");
                        $('div[name=defense] p').replaceWith(" ");
                      }

                      // $('#textCardDataA1').html('<span>'+mana+'</span><p>INVOCATION</p>');
                      // $('#textCardDataB2').html('<span>'+attaque+'</span><p>ATTAQUE</p>');
                      // $('#textCardDataC2').html('<span>'+defense+'</span><p>DEFENSE</p>');
                      
                      $('#dial').css("display", "block").dialog({
                    //        autoOpen: false,  
                            modal: true,
                            width : 800,
                            height : 557,  
                            closeText: 'X', 
                            draggable: false,
                        });  
                        return false;  
                    });

                });
               
            });
        }


    }, 2000);



});


























