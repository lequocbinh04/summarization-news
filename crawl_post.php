<?php
    if($_POST['host']){
        include_once './simple_html_dom.php';
        $host = $_POST['host'];
        if($host == "vnexpress"){
           
            $html_vnex = file_get_html("https://vnexpress.net/");
            $big_title = $html_vnex->find('div[class=thumb-art] img' , 0);
            $big_title = $big_title->alt;
            $big_link = $html_vnex->find('div[class=thumb-art] a' , 0)->href;
            echo "<p>🚀 <a href='#' class='hihi' onclick='run(\"$host\", \"$big_link\")'>".$big_title."</a></p>"; 

            $list = $html_vnex->find('ul[class=list-sub-feature] li a[data-thumb=0]');
            foreach ($list as $menu) {
                $title_vnex = $menu->innertext;
                $link_vnex =  $menu->href;
                echo "<p>🚀 <a href='#' class='hihi' onclick='run(\"$host\", \"$link_vnex\")'>".$title_vnex."</a></p>";
            }
            $list1 = $html_vnex->find('div[class=col-left col-small] article[class=item-news item-news-common] h3[class=title-news] a');
            foreach ($list1 as $menu2) {
                $link_vnex1 = $menu2->href;
                $title_vnex1 =  $menu2->title;
                echo "<p>🚀 <a href='#' class='hihi' onclick='run(\"$host\", \"$link_vnex1\")'>".$title_vnex1."</a></p>";
            }
        }
        else if($_POST['host'] == "dantri"){
            $html_dantri = file_get_html("https://dantri.com.vn/");
            $list_dantri = $html_dantri->find('h2[class=news-item__title] a',0);
            $bigtitle_dantri= $list_dantri->title;
            $biglink_dantri = "https://dantri.com.vn".$list_dantri->href;
            echo "<p>🚀 <a href='#' class='hihi'  onclick='run(\"$host\", \"$biglink_dantri\")'>".$bigtitle_dantri."</a></p>";
            $list = $html_dantri->find('li div[class=news-item news-item news-item--stream news-item--left2right] h3[class=news-item__title] a');
            foreach ( $list as $item  ) {
                $link_dantri = "https://dantri.com.vn".$item->href;
                $text_dantri = $item->plaintext;
                echo "<p>🚀 <a href='#' class='hihi' onclick='run(\"$host\", \"$link_dantri\")'>".$text_dantri."</a></p>";
            }
        }
        else{
            $html_tuoitrau =  file_get_html("https://tuoitre.vn/tin-moi-nhat.htm");
            $list_tuoitrau = $html_tuoitrau->find("a[data-linktype=newsdetail]");
            foreach ($list_tuoitrau as $menu_tuoitrau) {
                $title_tuoitrau = $menu_tuoitrau->title;
                $link_tuoitrau = "https://tuoitre.vn".$menu_tuoitrau->href;
                echo "<p>🚀 <a href='#' class='hihi' onclick='run(\"$host\", \"$link_tuoitrau\")'>".$title_tuoitrau."</a></p>";
            }
        }
    }
    
?>