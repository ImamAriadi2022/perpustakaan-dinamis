function validateForm() {
    var username = document.forms["registerForm"]["username"].value;
    var password = document.forms["registerForm"]["password"].value;
    var errorMessage = "";

    if (username == "") {
        errorMessage += "Username harus diisi.\n";
    }

    if (password == "") {
        errorMessage += "Password harus diisi.\n";
    }

    if (errorMessage != "") {
        showPopup(errorMessage, "error");
        return false;
    }

    return true;
}

function showPopup(message, type) {
    var popup = document.createElement("div");
    popup.className = "popup-message " + type;
    popup.innerText = message;

    document.body.appendChild(popup);
    popup.style.display = "block";

    setTimeout(function() {
        popup.style.display = "none";
        document.body.removeChild(popup);
    }, 3000);
}

