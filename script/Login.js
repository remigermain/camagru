const login = document.getElementById("formLogin");
const logout = document.getElementById("formLogout");
const register = document.getElementById("formRegister");
const login_li = document.getElementById("login_active");
const register_li = document.getElementById("register_active");

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

function reqForgotpassword()
{
  const req = new XMLHttpRequest();
  req.open("POST", "http://127.0.0.1:8008/Server/connection.php", true);
  var form = new FormData;
  const email = document.getElementById("email").value

  form.append('submit', "forgot");
  form.append('email', email);
  req.onreadystatechange = function()
  { 
      if(req.readyState == 4)
      {
          if(req.status >= 200 && req.status < 300)
          {
              //document.location.reload(true);
              console.log(req.responseText);
          }
          else
              alert("Error: returned status code " + req.status + " " + req.statusText);
      }
  }     
  req.send(form); 
}

logout.style.display = "none";
displayIsactive();