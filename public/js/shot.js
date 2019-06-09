
let video = document.getElementById("videoElement");
let shotBtn = document.getElementById('shot-btn');
let canvas = document.getElementById('canvas-area');
let mainBtns = document.getElementById('main-btns');
let publishBtns = document.getElementById('publish-btns');

let tryAgainBtn = document.getElementById('try-again-btn');

let filterClear = document.getElementById('filter-clear');
let filterRaccoon1 = document.getElementById('filter-raccoon-1');
let filterRaccoon2 = document.getElementById('filter-raccoon-2');
let filterInverse = document.getElementById('filter-inverse');
let filterBluefill = document.getElementById('filter-bluefill');
let filterNoir = document.getElementById('filter-noir');

let image = document.getElementById('image-area');
let shot;

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
  disabledButton('');
  video.style.display = 'none';
  mainBtns.style.display = 'none';
  publishBtns.style.display = 'flex';
  canvas.style.display = 'none';
  context = canvas.getContext('2d');
  canvas.width = 500;
  canvas.height = 375;
  context.drawImage(video, 0, 0, 500, 375);
  shot = canvas.toDataURL('image/png').replace('data:image/png;base64,', '');
  sendImage('img=' + shot + '&filter=clear');

  // let publishButton = document.getElementById('publish-btn');
  // publishButton.onclick = function() {
  //   this.blur();
  //   sendImage('img=' + img + '&filter=' + filter);
  // }
  console.log(shot);
}

tryAgainBtn.onclick = function() {
  this.blur();
  disabledButton('false');
  video.style.display = 'block';
  mainBtns.style.display = 'flex';
  publishBtns.style.display = 'none';
  image.style.display = 'none';
}

filterClear.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=clear');
}

filterRaccoon1.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=raccoon-1');
}

filterRaccoon2.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=raccoon-2')
}

filterInverse.onclick = function() {
  this.blur();
}

filterBluefill.onclick = function() {
  this.blur();
}

filterNoir.onclick = function() {
  this.blur();
}

disabledButton('false');

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
                image.style.display = 'block';
                image.src = request.responseText;

            }
        }
    };
}

function disabledButton($val) {
  filterClear.disabled = $val;
  filterRaccoon1.disabled = $val;
  filterBluefill.disabled = $val;
  filterRaccoon2.disabled = $val;
  filterInverse.disabled = $val;
  filterNoir.disabled = $val;
}