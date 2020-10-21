<?php
    if($_POST['image']){
        $data = $_POST['image'];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents('./news/ ' .round(microtime(true) * 1000).".png", $data);
    }
?>