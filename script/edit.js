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

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//                             request                                      //
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



//          delete image //

function reqDelete(id)
{
    var div = document.getElementById("base" + id)
    var form = new FormData;
    form.append('id', id);
    form.append('submit', "delete");

    fetch("http://127.0.0.1:8008/Server/edit_info_image.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
//        console.log(obj)
        remove_notify();
        create_notify(obj.body.msg, obj.body.status);
        if (document.getElementById('totalImage'))
            document.getElementById('totalImage').innerHTML = "Image " + parseInt(document.getElementById('totalImage').innerHTML.substr(5) - 1);
        div.remove();
    })
    .catch(function(error){
        remove_notify();
        console.log(error)
    });
    del.classList.remove("is-active")
}

//         update  home user //
function reqHome()
{
    var form = new FormData;
    form.append('submit', "home");
    form.append('sys', document.getElementById("newhomeSynopsis").value);
    fetch("http://127.0.0.1:8008/Server/edit_info_image.php", { body: form, method: "post"})
 //   .then(function(r) {console.log(r.text().then(data => console.log("ciucou" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        console.log(obj)
        remove_notify();
        create_notify(obj.body.msg, obj.body.status);
        document.getElementById("homeSynopsis5").innerText = document.getElementById("newhomeSynopsis").value;
    })
   .catch(function(error){
        remove_notify();
        console.log(error)
    });
    if (chanel)
        chanel.classList.remove("is-active");
}

//         update  image information //
function reqModify(id)
{
    var form = new FormData;
    form.append('submit', "image");
    form.append('id', id);
    form.append('sys', document.getElementById("sys" + id).value);
    form.append('title', document.getElementById("title" + id).value);
    fetch("http://127.0.0.1:8008/Server/edit_info_image.php", { body: form, method: "post"})
  //  .then(function(r) {console.log(r.text().then(data => console.log("ciucou" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        console.log(obj)
        remove_notify();
        create_notify(obj.body.msg, obj.body.status);
        document.getElementById("basesys" + id).innerText = document.getElementById("sys" + id).value.substr(0, 90);
        document.getElementById("basetitle" + id).innerText = document.getElementById("title" + id).value.substr(0, 20);
    })
   .catch(function(error){
        remove_notify();
        console.log(error)
    });
    modal.classList.remove("is-active");
}

cancel_modal();
close_modal();
cancel_chanel();
close_chanel();
window_event();