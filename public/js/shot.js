
let video = document.getElementById("videoElement");
let shotBtn = document.getElementById('shot-btn');
let canvas = document.getElementById('canvas-area');
let mainBtns = document.getElementById('main-btns');
let publishBtns = document.getElementById('publish-btns');

let tryAgainBtn = document.getElementById('try-again-btn');

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
  console.log(img);
}

tryAgainBtn.onclick = function() {
  this.blur();
  video.style.display = 'block';
  mainBtns.style.display = 'flex';
  publishBtns.style.display = 'none';
  canvas.style.display = 'none';
}

function sendImage(data) {
  let request = new XMLHttpRequest();
    request.open('POST', '/shot/publish', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencode');
    request.send(data);
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            if (request.status === 200 && callFunction !== null) {
                

            }
        }
    };
}