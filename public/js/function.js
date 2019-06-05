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

function ajaxTemplate(method, url, data, callFunction, contentType = null) {
    let request = new XMLHttpRequest();
    request.open(method, url, true);
    if (contentType === null) {
        request.setRequestHeader('Content-Type', 'application/json');
    }
    else {
        request.overrideMimeType('text/plain; charset=x-user-defined');
        request.setRequestHeader('Content-Type', 'multipart/form-data');
    }
    request.send(data);
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            if (request.status === 200 && callFunction !== null) {
                callFunction(request.responseText);
            }
        }
    };
}