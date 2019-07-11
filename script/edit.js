var edit_button = document.getElementById("edit_button");
var static = "1";
var modal = document.getElementById("modal" + static);
var back_image = document.getElementById("back_img" + static);
var close = document.getElementById("close" + static);
var cancel = document.getElementById("cancel" +static);
var back = document.getElementById("back");
var chanel = document.getElementById("chanel");
var but_close_chanel = document.getElementById("but_close_chanel");
var but_cancel_chanel = document.getElementById("but_cancel_chanel");

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
    }
}

function delete_image(id)
{
    console.log(id);
}

cancel_modal();
close_modal();
cancel_chanel();
close_chanel();
window_event();