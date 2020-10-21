<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <style>
            body,h1,h2,h3,h4,h5,h6,p{
                font-family: 'Roboto', sans-serif;
            }
        </style>
    </head>
    <body style="background-color: #000;">
        <div class="row" >
            <div class="col-5 pb-3 pr-0 pl-0" id="capture" style="background-color: #fff; min-height: 600px; width:100%;">
                <div style="width: 100%;">
                    <div style="width : 100%; height: 350px; background-size: cover!important;background: url('<?php echo $_GET['image']?>') no-repeat center center;">
                        <img src="logo_news.png" alt="" class = "mt-3 ml-3" style="width: 100px; height: 40px; opacity: 0.5;">
                    </div>
                </div>
                <div class="news-content mt-3 ml-3">
                    <img src="water-mark.png" style="position: absolute;top: 400px; width: 200px; height: 200px; opacity: 0.4; left: 230px"/>
                    <div style="position: relative; z-index: 1;" class="pr-2">
                        <h3 class="title-news">
                            <?php
                                echo $_GET['title'];
                            ?>
                        </h3>
                        <p class="mt-3" style="font-size:1.1rem">
                            <?php
                                echo $_GET['content'];
                            ?>
                        </p>
                        <p class="text-right mt-4 mr-3">
                            <?php
                                echo $_GET['time'].". Theo ".$_GET['host'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            html2canvas(document.querySelector("#capture"),
            {
                    scale: 2,
                    allowTaint: true,
                }).then(canvas => {
                let image = (canvas.toDataURL());
                var xhr = new XMLHttpRequest();
                xhr.onload = function () { };
                xhr.onerror = function () { };

                xhr.open("POST","http://localhost/generate_news_img/save.php");

                xhr.withCredentials = true;

                var formData = new FormData();
                formData.append("image", image);

                xhr.send(formData);
            });
        </script>
    </body>
</html>