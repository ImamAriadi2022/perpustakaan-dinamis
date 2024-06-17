document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("loginForm");

    form.addEventListener("submit", function(event) {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "" || password === "") {
            event.preventDefault();
            showPopup("Silakan masukkan data yang sesuai.", "error");
        }
    });
});

function showPopup(message, type) {
    var popup = document.createElement("div");
    popup.className = "popup-message " + type;
    popup.innerText = message;

    document.body.appendChild(popup);
    popup.style.display = "block";

    setTimeout(function() {
        popup.style.display = "none";
        document.body.removeChild(popup);
    }, 3000); // Pop-up akan hilang setelah 3 detik
}
