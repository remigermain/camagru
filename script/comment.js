
function reqComment(id)
{
    const req = new XMLHttpRequest();
    req.open("POST", "http://127.0.0.1:8008/Server/follow_like.php", true);
    var form = new FormData;
    const com = document.getElementById("comment").value

    form.append('id', id);
    form.append('comment', com);
    form.append('methode', "comment");
    req.onreadystatechange = function()
    { 
        if(req.readyState == 4)
        {
            if(req.status >= 200 && req.status < 300)
                document.location.reload(true);
            else
                alert("Error: returned status code " + req.status + " " + req.statusText);
        }
    }     
    req.send(form); 
}