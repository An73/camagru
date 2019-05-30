
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

function signButton() {
    let signUpButton = document.getElementById('sign-up-id');

    signUpButton.onclick = function() {
        this.blur();
        modalWindow('modal-signup');
    }
}

signButton();