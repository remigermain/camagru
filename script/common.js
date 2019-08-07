
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//                             request                                      //
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



//.then(function(r) {console.log(r.text().then(data => console.log("ciucou" + data)))})
//      connection ( login , logout , register, forgot password)  ///

function reqForgotpassword()
{
    var form = new FormData;

    form.append('submit', "forgot");
    form.append('email', document.getElementById("email_forgot").value);
    reqConnection(form);
    forgot.classList.remove("is-active");
}

function reqLogin()
{
    var form = new FormData;

    form.append('submit', "login");
    form.append('email', document.getElementById("email").value);
    form.append('password', document.getElementById("password").value);
    reqConnection(form);
}

function reqRegister()
{
    var form = new FormData;

    form.append('submit', "register");
    form.append('username', document.getElementById("username").value);
    form.append('email', document.getElementById("regemail").value);
    form.append('password', document.getElementById("regpassword").value);
    form.append('confpassword', document.getElementById("confpassword").value);
    reqConnection(form);
}

function reqLogout()
{
    var form = new FormData;

    form.append('submit', "logout");
    reqConnection(form);
    console.log("dfdfdfdffd");
}

function reqConnection(form)
{
    fetch(window.location.origin + "/Server/connection.php", { body: form, method: "post"})
   // .then(function(r) {console.log(r.text().then(data => console.log("json print : \n" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        remove_notify();
        if (obj.body.redirect)
            window.location.href = obj.body.url;
        else
            create_notify(obj.body.msg, obj.body.status);
    })
    .catch(function(error){
        remove_notify();
        console.log(error)
    });
}

//      like image or un-like  ///
function reverseLike(id)
{
    const div = document.getElementById("like" + id);
    var heart = document.createElement('i');
    var check = document.createElement('i');
    var nbLike = 0;

    if (document.getElementById("totalLike"))
        nbLike = parseInt(document.getElementById("totalLike").innerHTML.substr(5));
    heart.classList.add('material-icons');
    check.classList.add('material-icons');
    if (div.firstElementChild.innerHTML === "add")
    {
        heart.innerHTML = "favorite";
        check.innerHTML = "check";
        nbLike++;
    }
    else
    {
        heart.innerHTML = "favorite_border";
        check.innerHTML = "add";
        nbLike--;
    }
    while (div.firstChild)
        div.removeChild(div.firstChild);
    if (document.getElementById("totalLike"))
        document.getElementById("totalLike").innerHTML = "Like " + nbLike;
    div.append(check);
    div.append(heart);
}

//      like follow or un-follow  ///
function reverseFollow(id)
{
    const div = document.getElementById("follow");
    var check = document.createElement('i');
    var nbFollow = 0;

    if (document.getElementById("totalFollow"))
        nbFollow = parseInt(document.getElementById("totalFollow").innerHTML.substr(9));
    check.classList.add('material-icons');
    if (div.firstElementChild.innerHTML === "add")
    {
        check.innerHTML = "check";
        div.classList.add("is-outlined");
        nbFollow++;
    }
    else
    {
        nbFollow--;
        check.innerHTML = "add";
        div.classList.remove("is-outlined");
    }
    while (div.firstChild)
        div.removeChild(div.firstChild);
    if (document.getElementById("totalFollow"))
        document.getElementById("totalFollow").innerHTML = "Follower " + nbFollow;
    div.append(check);
    div.append(" Follow");
}

//     follow   ///
function reqFollow(id)
{
    var form = new FormData;

    form.append('submit', 'follow');
    form.append('id', id);

    fetch(window.location.origin + "/Server/follow_like.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        remove_notify();
        if (!obj.body.status)
            create_notify(obj.body.msg, obj.body.status);
        else
            reverseFollow(id);
    })
    .catch(function(error){
        console.log(error)
    });
}

//      like inage ///
function reqLike(id)
{
    var form = new FormData;

    form.append('submit', 'like');
    form.append('id', id);

    fetch(window.location.origin + "/Server/follow_like.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        remove_notify();
        if (!obj.body.status)
            create_notify(obj.body.msg, obj.body.status);
        else
            reverseLike(id);
    })
    .catch(function(error){
        console.log(error)
    });
}

//          delete image   //
function reqDelete(id)
{
    var div = document.getElementById("base" + id)
    var form = new FormData;

    form.append('id', id);
    form.append('submit', "delete");
    
    fetch(window.location.origin + "/Server/edit_info_image.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        remove_notify();
        create_notify(obj.body.msg, obj.body.status);
        if (document.getElementById('totalImage'))
            document.getElementById('totalImage').innerHTML = "Image " + parseInt(document.getElementById('totalImage').innerHTML.substr(5) - 1);
        if (div)
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

    fetch(window.location.origin + "/Server/edit_info_image.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
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
    if (document.getElementById("sys" + id))
        form.append('sys', document.getElementById("sys" + id).value);
    if (document.getElementById("title" + id))
        form.append('title', document.getElementById("title" + id).value);

    fetch(window.location.origin + "/Server/edit_info_image.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
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

//        create   new comment  //
function create_comment(obj, id, pagi, username)
{
    const div_base = document.getElementById('allComment');
    const div = document.createElement('div');
    div.classList.add('media');
    
    const fig = document.createElement('figure');
    fig.setAttribute('class', 'image is-48x48');
    fig.append(document.getElementById('userComment').cloneNode(true));
    const div2 = document.createElement('div');
    div2.classList.add('media-left');
    div2.append(fig);
    div.append(div2);
    
    const text = document.createElement('p');
    text.setAttribute('class', 'title is-6');
    text.innerHTML = "@" + username;
    div.append(text);
    
    const time = document.createElement('time');
    time.setAttribute('datetime', 'fdfdf');
    const date = new Date();
    time.innerHTML = date.getFullYear() + "-" + date.getMonth() + "-" + date.getDay();
    
    const br = document.createElement('br');
    const div3 = document.createElement('div')
    div3.classList.add('content');
    div3.append(time);
    div3.prepend(br);
    div3.prepend(document.getElementById('comment').value);
    
    const div4 = document.createElement('div');
    div4.setAttribute('class', 'card-content box');
    div4.append(div);
    div4.append(div3);
    if (pagi == 1)
    {
        if (div_base.childElementCount == 5)
            div_base.removeChild(div_base.lastElementChild);
        div_base.prepend(div4);
    }
    document.getElementById("comment").value = "";
}

function reqComment(id, pagi)
{
    var form = new FormData;

    form.append('submit', "comment");
    form.append('id', id);
    form.append('comment', document.getElementById("comment").value);

    fetch(window.location.origin + "/Server/follow_like.php", { body: form, method: "post"})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        remove_notify();
        create_comment(obj, id, pagi, obj.body.user_name);
    })
    .catch(function(error){
        remove_notify();
        console.log(error)
    });
}

//       Account   user //
function reqAccount(form)
{
    fetch(window.location.origin + "/Server/account.php", { body: form, method: "post"})
  //  .then(function(r) {console.log(r.text().then(data => console.log("json print : \n" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        remove_notify();
        if (obj.body.status != -1)
            create_notify(obj.body.msg, obj.body.status);
    })
   .catch(function(error){
        remove_notify();
        console.log(error)
    });
}

function reqUserNotif()
{
    var form = new FormData;
    
    form.append('submit', 'notif');
    form.append('follow', Number(document.getElementById("NotifFollow").checked));
    form.append('comment', Number(document.getElementById("NotifComment").checked));
    form.append('like', Number(document.getElementById("NotifLike").checked));
    form.append('image', Number(document.getElementById("NotifImage").checked));
    reqAccount(form);
}

function reqUserProfil()
{
    var form = new FormData;
    const file = document.getElementById('fileToUpload').files[0];
    
    form.append('submit', 'profil');
    form.append('fileToUpload', file);
    if (file)
        form.append('logo', file.name);
    form.append('email', document.getElementById('email').value);
    form.append('username', document.getElementById('username').value);
    reqAccount(form);
}

function reqUserPass()
{
    var form = new FormData;
    
    form.append('submit', 'changepass');
    form.append('oldpassword', document.getElementById('oldpassword').value);
    form.append('newpassword', document.getElementById('newpassword').value);
    form.append('confpassword', document.getElementById('confpassword').value);
    reqAccount(form);
}