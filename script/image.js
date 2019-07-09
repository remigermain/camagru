const edit = document.getElementById("formedit");
const upload = document.getElementById("formupload");
const edit_li = document.getElementById("edit_active");
const upload_li = document.getElementById("upload_active");

function  displayIsactive()
{
  if (edit.style.display == "none")
  {
    edit_li.classList.remove("is-active");
    upload_li.classList.add("is-active");
  }
  else
  {
    edit_li.classList.add("is-active");
    upload_li.classList.remove("is-active");
  }
}

function displayedit () 
{
  upload.style.display = "none";
  edit.style.display = "block";
  displayIsactive();
}

function displayupload()
{
  upload.style.display = "block";
  edit.style.display = "none";
  displayIsactive();
}

var video = document.getElementById('video');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
{
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}

displayIsactive();