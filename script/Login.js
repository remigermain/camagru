const login = document.getElementById("formLogin");
const logout = document.getElementById("formLogout");
const register = document.getElementById("formRegister");
const login_li = document.getElementById("login_active");
const register_li = document.getElementById("register_active");
const forgot = document.getElementById("modal_forgot");
const cancel_forgot = document.getElementById("cancel_forgot");
const close_forgot = document.getElementById("close_forgot");
const back_forgot = document.getElementById("back_forgot");

function  displayIsactive()
{
  if (register.style.display == "none")
  {
    login_li.classList.add("is-active");
    register_li.classList.remove("is-active");
  }
  else
  {
    login_li.classList.remove("is-active");
    register_li.classList.add("is-active");
  }
}

function displayRegister () 
{
  login.style.display = "none";
  register.style.display = "block";
  displayIsactive();
}

function displayLogin()
{
  login.style.display = "block";
  register.style.display = "none";
  displayIsactive();
}

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//                             display moal  forgot password                //
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

function display_modal_forgot()
{
  forgot.classList.add("is-active");
}

function cancel_forgot_funct()
{
  cancel_forgot.onclick = function (){
    forgot.classList.remove("is-active");
  };
}

function close_forgot_funct()
{
  close_forgot.onclick = function () {
    forgot.classList.remove("is-active");
  };
}

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//                             request                                      //
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

function reqForgotpassword()
{
  var form = new FormData;
  form.append('submit', "forgot");
  form.append('email', document.getElementById("email_forgot").value);
  sendrequest(form, "connection.php");
  forgot.classList.remove("is-active");
}

function reqLogin()
{
  console.log("fdffdd");
  var form = new FormData;
  form.append('submit', "login");
  form.append('email', document.getElementById("email").value);
  form.append('password', document.getElementById("password").value);
  error = sendrequest(form, "connection.php");
}

function reqRegister()
{
  var form = new FormData;
  form.append('submit', "register");
  form.append('username', document.getElementById("username").value);
  form.append('email', document.getElementById("regemail").value);
  form.append('password', document.getElementById("regpassword").value);
  form.append('confpassword', document.getElementById("confpassword").value);
  sendrequest(form, "connection.php");
}

function reqLogout()
{
  var form = new FormData;
  form.append('submit', "logout");
  sendrequest(form, "connection.php");
}

//////////////////////////////////////////////////////////////////////////////

function window_event()
{
  window.onclick = function(event)
  {
    if (event.target == back_forgot) {
      forgot.classList.remove("is-active");
    }
  }
}

logout.style.display = "none";
displayIsactive();
window_event();
cancel_forgot_funct();
close_forgot_funct();