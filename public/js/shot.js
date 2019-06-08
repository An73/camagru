
let video = document.getElementById("videoElement");
let shotBtn = document.getElementById('shot-btn');
let canvas = document.getElementById('canvas-area');
let mainBtns = document.getElementById('main-btns');
let publishBtns = document.getElementById('publish-btns');

let tryAgainBtn = document.getElementById('try-again-btn');

let filterStandart = document.getElementById('filter-standart');
let filterBlur = document.getElementById('filter-blur');
let filterBW = document.getElementById('filter-bandw');
let filterInverse = document.getElementById('filter-inverse');
let filterBluefill = document.getElementById('filter-bluefill');
let filterNoir = document.getElementById('filter-noir');

let toMainBtn = document.getElementById('btn-to-main');
let logoutBtn = document.getElementById('btn-logout');

toMainBtn.onclick = function() {
  this.blur();
  location = "/";
}

logoutBtn.onclick = function() {
  this.blur();
  ajaxTemplate('POST', '/account/logout', null, null);
  location = "/";
}

if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(function (stream) {
        video.srcObject = stream;


      })
      .catch(function (err0r) {
        console.log("Something went wrong!");
      });
}

shotBtn.onclick = function() {
  this.blur();
  video.style.display = 'none';
  mainBtns.style.display = 'none';
  publishBtns.style.display = 'flex';
  canvas.style.display = 'block';
  context = canvas.getContext('2d');
  canvas.width = 500;
  canvas.height = 375;
  context.drawImage(video, 0, 0, 500, 375);
  let img = canvas.toDataURL('image/png').replace('data:image/png;base64,', '');

  document.querySelector("img").src = canvas.toDataURL();

  let publishButton = document.getElementById('publish-btn');
  publishButton.onclick = function() {
    this.blur();
    sendImage('img=' + img);
  }
  console.log(img);
}

tryAgainBtn.onclick = function() {
  this.blur();
  video.style.display = 'block';
  mainBtns.style.display = 'flex';
  publishBtns.style.display = 'none';
  canvas.style.display = 'none';
}

filterStandart.onclick = function() {
  this.blur();
  filterApply('');
}

filterBlur.onclick = function() {
  this.blur();
  filterApply('#blurEffect');
}

filterBW.onclick = function() {
  this.blur();
  filterApply('#blackandwhite');
}

filterInverse.onclick = function() {
  this.blur();
  filterApply('#inverse');
}

filterBluefill.onclick = function() {
  this.blur();
  filterApply('#bluefill');
}

filterNoir.onclick = function() {
  this.blur();
  filterApply('#noir');
}

function filterApply(filter) {
  video.style.filter = 'url(' + filter + ')';
  canvas.style.filter = 'url(' + filter + ')';
}

function sendImage(data) {
  let request = new XMLHttpRequest();
    request.open('POST', '/shot/publish', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(data);
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            if (request.status === 200) {
                

            }
        }
    };
}