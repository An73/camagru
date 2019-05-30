function modalWindow(id) {
    let modalElement = document.getElementById(id);
    modalElement.style.display = 'block';
    window.onclick = function(event){
        if (event.target == modalElement) {
            modalElement.style.display = 'none';
        }
    };

    document.onkeydown = function(event) {
        if (event.keyCode == 27) {
			modalElement.style.display = 'none';
		}
    };
}

function ajaxTemplate(method, url, data, callFunction) {
    let request = new XMLHttpRequest();
    request.open(method, url, true);
    request.setRequestHeader('Content-Type', 'application/json');
    request.send(data);
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            if (request.status === 200) {
                console.log("!! " + request.responseText);
            }
        }
    };
}