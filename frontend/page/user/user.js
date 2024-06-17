window.addEventListener("DOMContentLoaded", function() {
    var toTopButton = document.querySelector(".tombol");

    // Ketika pengguna mengklik tombol, tampilkan atau sembunyikan tombol lain
    toTopButton.addEventListener("click", function() {
        var buttons = document.querySelectorAll('.tombol1, .tombol2, .tombol3');
        var label = document.querySelectorAll('.AI,.admin1,.admin2');
        for (var i = 0; i < buttons.length; i++) {
            if (buttons[i].style.display === "none") {
                buttons[i].style.display = "block";
            } else {
                buttons[i].style.display = "none";
                label[i].style.display = "none";
            }
        }
    });
});


window.addEventListener("DOMContentLoaded", function(){
    var showLabel = document.querySelector(".tombol3");


    showLabel.addEventListener("click", function(){
        var label = document.querySelectorAll('.AI');
        for (var i = 0; i < label.length; i++) {
            if (label[i].style.display === "none") {
                label[i].style.display = "block";
            } else {
                label[i].style.display = "none";
            }
        }
    });
});
window.addEventListener("DOMContentLoaded", function(){
    var showLabel = document.querySelector(".tombol2");


    showLabel.addEventListener("click", function(){
        var label = document.querySelectorAll('.admin2');
        for (var i = 0; i < label.length; i++) {
            if (label[i].style.display === "none") {
                label[i].style.display = "block";
            } else {
                label[i].style.display = "none";
            }
        }
    });
});
window.addEventListener("DOMContentLoaded", function(){
    var showLabel = document.querySelector(".tombol1");


    showLabel.addEventListener("click", function(){
        var label = document.querySelectorAll('.admin1');
        for (var i = 0; i < label.length; i++) {
            if (label[i].style.display === "none") {
                label[i].style.display = "block";
            } else {
                label[i].style.display = "none";
            }
        }
    });
});


//fungsi chatbot
window.addEventListener("DOMContentLoaded", function() {
    var chatBot = document.getElementsByClassName('AI');

    for (var i = 0; i < chatBot.length; i++) {
        chatBot[i].addEventListener('click', function() {
            window.location.replace("http://127.0.0.1:5000/");
        });
    }
});