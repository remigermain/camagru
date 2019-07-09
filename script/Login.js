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

logout.style.display = "none";
displayIsactive();