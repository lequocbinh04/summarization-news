<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Get toàn bộ bài báo</h5> <br>
                      <a href="#" onclick="xuli('vnexpress')">
                        🔥 VNexpress.net
                      </a> <br> <br>
                      <a href="#" onclick="xuli('dantri')">
                        🔥 Dantri.com.vn
                      </a> <br> <br>
                      <a href="#" onclick="xuli('tuoitre')">
                        🔥 Tuoitre.vn
                      </a>
                      <br>

                      <div class="text-center mt-3">
                        <a href="#" class="mt-3 btn btn-primary">Submit</a>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body binh">

                    </div>
                </div>
            </div>
            </div>
        </div>
    <style>
        a:hover{
            text-decoration: none;
        }  
        a{
            color: black;
        }
    </style>
    <script>
        function xuli(host){
            $.post('./crawl_post.php',{
                host: host
            }, (data)=>{
                $('.binh').html(data);
                $('a').attr('href', '#');
            });
        }
        function run(host, url){
            $.ajax({
                url: 'http://localhost:5000?host='+host+"&url="+url,
                type: "GET",
                beforeSend: function(xhr){xhr.setRequestHeader('Access-Control-Allow-Origin', '*');},
                success: function(data) { 
                    data = data.data;
                    if(host == "vnexpress") host = "Vnexpress.net";
                    else if(host == "dantri") host = "Dantri.com.vn";
                    else host = "tuoitre.vn";
                    window.open('http://localhost/generate_news_img/?title='+data.title+'&content='+data.content+'&image='+data.image+'&time='+data.time+"&host="+host,"_blank");
                }
            });
        }
    </script>
    </body>

</html>