$(function()
{
    // Ajouter l'utilisateur dans la liste d'attente;

    let data = new FormData();
    data.append('control', 'lobby');
    data.append('action', 'addToWaitList');

    ajax('.', data, function(response)
    {
        if(response === 'false')
        {
            let div = $('<div></div>');
            div.id = 'erreur';
            div.text('Une erreur est survenue');
            $('body').appendChild(div);
        }

    });


   // Recherche d'un adversaire

    let i = 0;
    setInterval(function()
    {
        i = ++i % 4;
        $("#attente").html("En attente d'un adversaire" + new Array(i+1).join("."));

        let data = new FormData();
        data.append('control', 'lobby');
        data.append('action', 'checkWaitList');

        ajax('.', data, function(response)
        {
            let count = parseInt(response);
            if(count >= 2){
                url = './?control=plateau&action=display';
                window.location.replace(url);
            }
        });
    }, 500);
});
