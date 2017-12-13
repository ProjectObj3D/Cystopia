

function ajax(file, data, fct)
{
    let query = new XMLHttpRequest();

    query.onreadystatechange = function()
    {
        if(query.readyState === 4)
        {
            if (query.status === 200)
            {
                fct(query.responseText);
            }
        }
    };
    query.open('POST', file, true);
    query.send(data);
}

function ajaxSync(file, data, fct)
{
    let query = new XMLHttpRequest();

    query.onreadystatechange = function()
    {
        if(query.readyState === 4)
        {
            if (query.status === 200)
            {
                fct(query.responseText);
            }
        }
    };
    query.open('POST', file, false);
    query.send(data);
}


