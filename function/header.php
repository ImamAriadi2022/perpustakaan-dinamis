<?php 

function navbar ($tittle) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <tittle>
                $tittle
            </tittle>
            <style>
                .navbar {
                    background-color: #333333;
                    padding: 15px;
                    position: fixed;
                    top: 0;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
        </head>
        <body>
            <nav class="navbar">
                <div class="nav">
                    <h1 style= "color: #ffffff;">Perpustakaan Tsora</h1>
                </div>
            </nav>
        </body>
    </html>
    EOT;

}


function footer () {
    echo <<< EOT
        <footer
        Style = "
        background-color: #333333;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        bottom: 0;
        padding: 2rem;
        "
        >
            <p style = "color: #ffffff;">Copyright by Imam Ariadi & muhammad azka naufal</p> 
        </footer>
    EOT;
}

?>