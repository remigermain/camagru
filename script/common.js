function sendrequest(form, url)
{
    ret = false;
    fetch("http://127.0.0.1:8008/Server/" + url, { body: form, method: "post"})
    //.then(function(r) {console.log(r.text().then(data => console.log("ciucou" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
        console.log(obj)
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

function reverseLike(id)
{
    const div = document.getElementById("like" + id);
    var nbLike = 0;
    if (document.getElementById("totalLike"))
        nbLike = parseInt(document.getElementById("totalLike").innerHTML.substr(5));
    var heart = document.createElement('i');
    var check = document.createElement('i');
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

function reqFollow(id)
{
    var form = new FormData;
    form.append('submit', 'follow');
    form.append('id', id);
    fetch("http://127.0.0.1:8008/Server/follow_like.php", { body: form, method: "post"})
  //  .then(function(r) {console.log(r.text().then(data => console.log("ciucou" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
   //     console.log(obj.body)
        reverseFollow(id);
    })
   .catch(function(error){
        console.log(error)
    });
}

function reqLike(id)
{
    var form = new FormData;
    form.append('submit', 'like');
    form.append('id', id);
    fetch("http://127.0.0.1:8008/Server/follow_like.php", { body: form, method: "post"})
    //   .then(function(r) {console.log(r.text().then(data => console.log("ciucou" + data)))})
    .then(r =>  r.json().then(data => ({status: r.status, body: data})))
    .then(function(obj) {
    //    console.log(obj.body)
        reverseLike(id);
    })
   .catch(function(error){
        console.log(error)
    });
    //chanel.classList.remove("is-active");
}