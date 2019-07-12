
function reqFollow(id, methode)
{
    const req = new XMLHttpRequest();
    req.open("POST", "http://127.0.0.1:8008/Server/follow_like.php", true);
    var form = new FormData;

    form.append('id', id);
    form.append('methode', methode);
    req.onreadystatechange = function()
    { 
        if(req.readyState == 4)
        {
            if(req.status >= 200 && req.status < 300)
                console.log("Status de la réponse: %d (%s)", req.status, req.statusText, req.responseText);
            else	
                alert("Error: returned status code " + req.status + " " + req.statusText);
        }
    }     
    req.send(form); 
}