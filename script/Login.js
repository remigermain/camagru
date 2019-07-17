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

function removenotif(div)
{
  console.log(div);
  div.remove();
}

function reqForgotpassword()
{
  const req = new XMLHttpRequest();
  req.open("POST", "http://127.0.0.1:8008/Server/connection.php", true);
  var form = new FormData;
  const email = document.getElementById("email_forgot").value
  
  form.append('submit', "forgot");
  form.append('email', email);
  req.onreadystatechange = function()
  { 
      if(req.readyState == 4)
      {
          if(req.status >= 200 && req.status < 300)
          {
              forgot.classList.remove("is-active");
              create_notify(req.responseText.substr(1), req.responseText.substr(0, 1));
          }
          else
              alert("Error: returned status code " + req.status + " " + req.statusText);
      }
  }     
  req.send(form); 
}

logout.style.display = "none";
displayIsactive();


function window_event()
{
    window.onclick = function(event)
    {
        if (event.target == back_forgot) {
            forgot.classList.remove("is-active");
        }
    }
}

window_event();
cancel_forgot_funct();
close_forgot_funct();