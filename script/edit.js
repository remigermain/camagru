var edit_button = document.getElementById("edit_button");
var static = "1";
var static_del = "1";
var modal = document.getElementById("modal" + static);
var back_image = document.getElementById("back_img" + static);
var close = document.getElementById("but_close_chanel");
var cancel = document.getElementById("but_cancel_chanel");
var back = document.getElementById("back");
var chanel = document.getElementById("chanel");
var but_close_chanel = document.getElementById("but_close_chanel");
var but_cancel_chanel = document.getElementById("but_cancel_chanel");

var del = document.getElementById("del_modal" + static_del);
var del_close = document.getElementById("del_close" + static_del);
var del_cancel = document.getElementById("del_cancel" + static_del);
var del_back = document.getElementById("del_back" + static_del);



// ////////////////////////////////////////////////////////

function display_modal_del(id)
{
    del = document.getElementById("modal_del" + arguments[0]);
    del.classList.add("is-active");
    static_del = arguments[0];
    del_close = document.getElementById("del_close" + static_del);
    del_cancel = document.getElementById("del_cancel" + static_del);
    back_del = document.getElementById("del_back" + static_del);
    cancel_modal_del();
    close_modal_del();
    window_event();
}

function close_modal_del()
{
    del_close.onclick = function() {
    del.classList.remove("is-active");
    }
}

function cancel_modal_del()
{
    del_cancel.onclick = function() {
    del.classList.remove("is-active");
    }
}

// ////////////////////////////////////////////////////////

function display_modal(id)
{
    modal = document.getElementById("modal" + arguments[0]);
    modal.classList.add("is-active");
    static = arguments[0];
    close = document.getElementById("close" + static);
    cancel = document.getElementById("cancel" + static);
    back_image = document.getElementById("back_img" + static);
    cancel_modal();
    close_modal();
    window_event();
}

function close_modal()
{
    close.onclick = function() {
    modal.classList.remove("is-active");
    }
}

function cancel_modal()
{
    cancel.onclick = function() {
    modal.classList.remove("is-active");
    }
}

// ////////////////////////////////////////////////////////
function close_chanel()
{
    but_close_chanel.onclick = function() {
    chanel.classList.remove("is-active");
    }
}

function cancel_chanel()
{
    but_cancel_chanel.onclick = function() {
    chanel.classList.remove("is-active");
    }
}

function display_modal_chanel()
{
    chanel.classList.add("is-active");
}
// ////////////////////////////////////////////////////////

function window_event()
{
    window.onclick = function(event)
    {
        if (event.target == back) {
            chanel.classList.remove("is-active");
        }
        else if (event.target == back_image) {
            modal.classList.remove("is-active");
        }
        else if (event.target == del_back) {
            del.classList.remove("is-active");
        }
    }
}

function showHint(id, methode)
{
    const req = new XMLHttpRequest();
    req.open("POST", "http://127.0.0.1:8008/Server/edit_info_image.php", true);
    var form = new FormData;

    console.log(methode);
    if (methode == "home")
    {
        var homeSys = document.getElementById("homeSynopsis").value;
        form.append('sys', homeSys);
    }
    else if (methode == "image")
    {
        var sys = document.getElementById("sys" + id).value;
        var title = document.getElementById("title" + id).value;
        form.append('sys', sys);
        form.append('title', title);
    }
    form.append('id', id);
    form.append('methode', methode);
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

cancel_modal();
close_modal();
cancel_chanel();
close_chanel();
window_event();