<?php
session_start();
require_once './include/functionH.php';
require_once './include/functionH2.php';

//$level = 6;
//acess_control($level);
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="icon" type="image/jpg" href="./img/nep.jpg" />
        <link rel="stylesheet" type="text/css" href="./css/global.css"/>
        <link href="./css/bootstrap1.min.css" rel="stylesheet"/>
       
        <link rel="stylesheet" href="./css/alertify.core.css" />

        <link href="./css/custom.css" rel="stylesheet" type="text/css"/>
       
        <link rel="stylesheet" href="./css/alertify.default.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>NepUminho</title>

        <script src="./js/Word.js" ></script>
        <script src="./js/jquery.min.js" ></script>
        <script src="./js/alertify.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./js/jscript.js"></script> 
        <script type="text/javascript" src="./js/country.js"></script> 

    </head>
    <body>
        <div class="wrapper">
            <div id="header">
                <?php top(); ?>
            </div>
            <div id="cssmenu">
                <ul>
                    <li>
                        <a onclick="document.getElementById('home').href = 'guest.php'" id="home"><span class="fa fa-home fa-3x" title="Inicio"></span>
                        </a>
                    </li>

                    <li>
                        <a id="realizar" href="#" onclick="clickTo('realizar')">Realizar Exercício</a>
                    </li>
              

                    <li>
                        <a onclick="logout();" id="off"><img src="./img/off.jpg" alt="Terminar" title="Terminar Sessão" width="30px" height="30px"></a>
                    </li>
                </ul>
            </div>
            <div id="bodybox">

                <div id="subnavi" >

                    <?php
                    if ((!$_GET)or isset($_GET['realizar'])or isset($_GET['exercicio'])) {
                        ?>
                        <script type="text/javascript" async="async">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script>
                        <script type="text/javascript" async="async">
                            var params = {rssmikle_url: "http://caminhodapsicologia.webnode.com.pt/rss/noticias.xml", rssmikle_frame_width: "220", rssmikle_frame_height: "500", frame_height_by_article: "", rssmikle_target: "_blank", rssmikle_font: "Arial, Helvetica, sans-serif", rssmikle_font_size: "15", rssmikle_border: "off", responsive: "off", rssmikle_css_url: "", text_align: "left", text_align2: "left", corner: "off", scrollbar: "on", autoscroll: "on", scrolldirection: "up", scrollstep: "3", mcspeed: "20", sort: "New", rssmikle_title: "on", rssmikle_title_sentence: "Notícias", rssmikle_title_link: "", rssmikle_title_bgcolor: "#7f0d06", rssmikle_title_color: "#FFFFFF", rssmikle_title_bgimage: "", rssmikle_item_bgcolor: "#FFFFFF", rssmikle_item_bgimage: "", rssmikle_item_title_length: "55", rssmikle_item_title_color: "#0066FF", rssmikle_item_border_bottom: "on", rssmikle_item_description: "on", item_link: "off", rssmikle_item_description_length: "150", rssmikle_item_description_color: "#666666", rssmikle_item_date: "gl1", rssmikle_timezone: "Etc/GMT", datetime_format: "%b %e, %Y %l:%M:%S %p", item_description_style: "text+tn", item_thumbnail: "full", article_num: "15", rssmikle_item_podcast: "off", keyword_inc: "", keyword_exc: ""};
                            feedwind_show_widget_iframe(params);</script>

                        <?php
                    }if (isset($_GET['exercise1'])) {
                        ?> <div id="accordian">


                            <ul>
                                <li> <a id="registo" onclick="clickTo('realizar')">Realizar Exercício</a></li>
                                <li>  <a id="lista" onclick="clickTo('')">Consultar Resultados</a></li>


                            </ul>

                        </div> <?php
                }
                    ?>   

                </div>

                <div id="content">
                    <?php
                    if (!$_GET) {
                        ?>
                        <div id="admin1">   <h1>
                                 <script >
                                    greetingP(5);
                                </script></h1> 
                            <p style="font-size: 30px;color: #0000cc">Para iniciar utilize o menu de navegação</p>
                            <image src="http://curiosidades.batanga.com/sites/curiosidades.batanga.com/files/imagecache/primera/152985436.jpg"\></div>
                        <?php
                    }if (isset($_GET['realizar'])) {
                        require './include/Word.php';
                    }if (isset($_GET['exercicio'])) {
                        result(2);
                    }if (isset($_GET['exercise1'])) {
                        ?><p style="font-size: 25px;color: #CA430F;">Para iniciar os exercícios utilize o menu de navegação lateral</p>
                        <img src="img/exercise.jpg" width="400" height="300"/><?php
                }
                    ?>
                </div>
                <div id="footer">
                    <?php footer(); ?>
                </div>

            </div>

    </body>
</html>
