
let video = document.getElementById("videoElement");
let shotBtn = document.getElementById('shot-btn');
let canvas = document.getElementById('canvas-area');
let mainBtns = document.getElementById('main-btns');
let publishBtns = document.getElementById('publish-btns');

let uploadButton = document.getElementById('upload-btn-wrapper');

let tryAgainBtn = document.getElementById('try-again-btn');

let filterPepe = document.getElementById('filter-pepe');
let filterRaccoon1 = document.getElementById('filter-raccoon-1');
let filterRaccoon2 = document.getElementById('filter-raccoon-2');
let filterRocketman = document.getElementById('filter-rocketman');
let filterPenguin = document.getElementById('filter-penguin');
let filterCat = document.getElementById('filter-cat');

let image = document.getElementById('image-area');
let shot;

let toMainBtn = document.getElementById('btn-to-main');
let logoutBtn = document.getElementById('btn-logout');
let imageInput = document.getElementById('input-image');

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
  shot = canvas.toDataURL('image/jpeg').replace('data:image/jpeg;base64,', '');
  sendImage('img=' + shot + '&filter=clear');
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

filterPepe.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=pepe');
}

filterRaccoon1.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=raccoon-1');
}

filterRaccoon2.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=raccoon-2');
}

filterRocketman.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=rocketman');
}

filterPenguin.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=penguin');
}

filterCat.onclick = function() {
  this.blur();
  sendImage('img=' + shot + '&filter=cat');
}

imageInput.onchange = function() {

  disabledButton('');
  video.style.display = 'none';
  mainBtns.style.display = 'none';
  publishBtns.style.display = 'flex';

  let input = this.files[0];
  let reader = new FileReader();
  reader.readAsDataURL(input);
  reader.onload = function() {
    let encoded = reader.result.replace(/^data:(.*;base64,)?/, '');
      if ((encoded.length % 4) > 0) {
        encoded += '='.repeat(4 - (encoded.length % 4));
      }
    console.log(reader.result);
    sendImage('img=' + encoded + '&filter=clear');
    shot = encoded;
  }
}

disabledButton('false');

// function filterApply(filter) {
//   video.style.filter = 'url(' + filter + ')';
//   canvas.style.filter = 'url(' + filter + ')';
// }

function sendImage(data) {
  let request = new XMLHttpRequest();
    request.open('POST', '/shot/filter', true);
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
  filterPepe.disabled = $val;
  filterRaccoon1.disabled = $val;
  filterPenguin.disabled = $val;
  filterRaccoon2.disabled = $val;
  filterRocketman.disabled = $val;
  filterCat.disabled = $val;
}