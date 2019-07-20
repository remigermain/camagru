const Prof = document.getElementById("UserEditProf");
const Pass= document.getElementById("UserEditPass");
const Notif = document.getElementById("UserEditNotif");
//  is-active //
const AcProf = document.getElementById("AcProf");
const AcPass= document.getElementById("AcPass");
const AcNotif = document.getElementById("AcNotif");

function UserProf()
{
    document.title = "Account profils";
    AcProf.classList.add("is-active");
    AcPass.classList.remove("is-active");
    AcNotif.classList.remove("is-active");
    Prof.style.display = "block";
    Pass.style.display = "none";
    Notif.style.display = "none";
}

function UserPass()
{
    document.title = "Account password";
    AcProf.classList.remove("is-active");
    AcPass.classList.add("is-active");
    AcNotif.classList.remove("is-active");
    Prof.style.display = "none";
    Pass.style.display = "block";
    Notif.style.display = "none";
}

function UserNotif()
{
    document.title = "Account notification";
    AcProf.classList.remove("is-active");
    AcPass.classList.remove("is-active");
    AcNotif.classList.add("is-active");
    Prof.style.display = "none";
    Pass.style.display = "none";
    Notif.style.display = "block";
}
