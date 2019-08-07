const edit = document.getElementById("formedit");
const upload = document.getElementById("formupload");
const edit_li = document.getElementById("edit_active");
const upload_li = document.getElementById("upload_active");
const selectImage = document.getElementById("selectSource");
const buttonImage = document.getElementById("uploadImage");

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
/*
var video = document.getElementById('video');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
{
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}
*/

const displayUpload = document.getElementById("displayUpload");
const displayImgUpload = document.getElementById("imgInp");
const displayCamera = document.getElementById("displayCamera");
const displayImgCamera = document.getElementById("canvas");


var loadFile = function(event) {
  var output = document.getElementById('imgInp');
  var fileName = document.getElementById('fileName');
  output.src = URL.createObjectURL(event.target.files[0]);
  fileName.innerHTML = event.target.files[0].name + event.target.files[0].lastModified;
};

const iconImageButton = document.createElement("i");
iconImageButton.classList.add("material-icons");

function clickSource()
{
  if (selectImage.selectedIndex == 1) // take from camera
  {
    buttonImage.innerHTML = "Take from camera! &emsp;";
    iconImageButton.innerHTML = "photo_camera";
    displayUpload.style.display = "none";
    displayImgUpload.style.display = "none";
    displayCamera.style.display = "block";
    displayImgCamera.style.display = "block";
  }
  else
  {
    buttonImage.innerHTML = "Upload from local. &emsp;";
    iconImageButton.innerHTML = "cloud_upload";
    displayUpload.style.display = "block";
    displayImgUpload.style.display = "block";
    displayImgCamera.style.display = "none";
    displayCamera.style.display = "none";
  }
  buttonImage.append(iconImageButton);
}

selectImage.addEventListener('click', clickSource);

displayIsactive();