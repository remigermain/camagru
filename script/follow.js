
function reqFollowLike(id, methode)
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
            {
               // document.location.reload(true);
               var xhr = new XMLHttpReuqest();
                xhr.open("GET", "http://127.0.0.1:8008/Public/index.php?p=user_home");
                xhr.onreadystatechange = handler; // do something here...
                xhr.send()
            }
            else
                alert("Error: returned status code " + req.status + " " + req.statusText);
        }
    }     
    req.send(form); 
}