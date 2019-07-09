const over = document.getElementById("form-over");
const edit = document.getElementById("form-edit");
const cont = document.getElementById("form-cont");
const over_li = document.getElementById("over-active");
const edit_li = document.getElementById("edit-active");
const cont_li = document.getElementById("cont-active");

function  displayIsactive()
{
  if (over.style.display == "none")
    over_li.classList.remove("is-active");
  else
    over_li.classList.add("is-active");

  if (edit.style.display == "none")
    edit_li.classList.remove("is-active");
  else
    edit_li.classList.add("is-active");

  if (cont.style.display == "none")
    cont_li.classList.remove("is-active");
  else
    cont_li.classList.add("is-active");

  }

function displayOver() 
{
  edit.style.display = "none";
  cont.style.display = "none";
  over.style.display = "block";
  displayIsactive();
}

function displayEdit()
{
  edit.style.display = "block";
  cont.style.display = "none";
  over.style.display = "none";
  displayIsactive();
}

function displayCont()
{
  edit.style.display = "none";
  cont.style.display = "block";
  over.style.display = "none";
  displayIsactive();
}

displayIsactive();