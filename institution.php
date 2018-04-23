<?php
session_start();
require_once './include/functionH.php';
require_once './include/functionH2.php';

$level = $_SESSION['level'];
acess_control($level);
?>  
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="icon" type="image/jpg" href="./img/nep.jpg" />
        <link rel="stylesheet" type="text/css" href="./css/global.css"/>
        <link href="./css/bootstrap1.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="./css/alertify.core.css" />

        <link href="./css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="./css/glyphicons.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- include a theme, can be included into the core instead of 2 separate files -->
        <link rel="stylesheet" href="./css/alertify.default.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>NepUminho</title>
        <script src="./js/jquery.min.js" ></script>

        <script src="./js/alertify.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./js/jscript.js"></script> 
        <script type="text/javascript" src="./js/country.js"></script> 
    </head>

    <body onload="mudarImagem()" >
        <div class="wrapper">
            <div id="header">
                <?php top(); ?>
            </div>
            <div id="cssmenu">
                <ul>
                    <li>
                        <a onclick="document.getElementById('homeI').href = 'institution.php'" id="homeI"><span class="fa fa-home fa-3x" ></span>
                        </a>
                    </li>
                    <li>
                        <a id="pI" onclick="clickTo('pI')">Perfil </a>
                    </li>
                    <li>
                        <a id="instM" onclick="clickTo('instM')">Profissional </a></li>
                    <li>
                        <a id="set" onclick="clickTo('set')" >Atribuir Paciente</a>
                    </li>


                  

                        <li>

                            <a onclick="logout();"   id="off">
                                <img src="./img/off.jpg" alt="Terminar" title="Terminar Sessão" width="30" height="30"
                                     />


                            </a>
                        </li>
                </ul>
            </div>
            <div id="bodybox">

                <div id="subnavi" >

                    <?php if ((!$_GET)or isset($_GET['set'])) { ?>
                        <script type="text/javascript" async="async">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script>
                        <script type="text/javascript" async="async">
                            var params = {rssmikle_url: "http://caminhodapsicologia.webnode.com.pt/rss/noticias.xml", rssmikle_frame_width: "220", rssmikle_frame_height: "500", frame_height_by_article: "", rssmikle_target: "_blank", rssmikle_font: "Arial, Helvetica, sans-serif", rssmikle_font_size: "15", rssmikle_border: "off", responsive: "off", rssmikle_css_url: "", text_align: "left", text_align2: "left", corner: "off", scrollbar: "on", autoscroll: "on", scrolldirection: "up", scrollstep: "3", mcspeed: "20", sort: "New", rssmikle_title: "on", rssmikle_title_sentence: "Notícias", rssmikle_title_link: "", rssmikle_title_bgcolor: "#7f0d06", rssmikle_title_color: "#FFFFFF", rssmikle_title_bgimage: "", rssmikle_item_bgcolor: "#FFFFFF", rssmikle_item_bgimage: "", rssmikle_item_title_length: "55", rssmikle_item_title_color: "#0066FF", rssmikle_item_border_bottom: "on", rssmikle_item_description: "on", item_link: "off", rssmikle_item_description_length: "150", rssmikle_item_description_color: "#666666", rssmikle_item_date: "gl1", rssmikle_timezone: "Etc/GMT", datetime_format: "%b %e, %Y %l:%M:%S %p", item_description_style: "text+tn", item_thumbnail: "full", article_num: "15", rssmikle_item_podcast: "off", keyword_inc: "", keyword_exc: ""};
                            feedwind_show_widget_iframe(params);</script>
                        <div id="imgbox">
                            <img src="./img/cognitive.jpg" alt="me" width="154" height="170"/>
                            <br />
                            <strong><p>Plataforma de Treino Cognitivo</p></strong>
                        </div>
                        <?php
                    }if (isset($_GET['Pinfo'])or isset($_GET['editI'])or isset($_GET['instPass'])) {
                        instVerticalM2();
                    }if (isset($_GET['instM'])or isset($_GET['addT'])or isset($_GET['instL'])or isset($_GET['search'])) {
                        instVerticalM1();
                    }
                    ?>

                </div>

                <div id="content">

                    <?php
                    if (!$_GET) {
                        ?>
                        <div id="admin1">   <h1>
                                <script >
                                    greetingP(2);</script></h1> 
                            <p style="font-size: 30px;color: #0000cc">Para iniciar utilize o menu de navegação</p>
                            <image src="http://curiosidades.batanga.com/sites/curiosidades.batanga.com/files/imagecache/primera/152985436.jpg" /></div>
                    <?php }if (isset($_GET['Pinfo'])) {
                        ?>
                        <image src="./img/instit.jpg" />

                        <?php
                    }if (isset($_GET['instM'])) {
                        ?>
                        <image src="./img/staff.jpg" style="  height: 513px;border-radius: 14px;border: 2px solid #C57C53;""/>

                        <?php
                    }

                    if (isset($_GET['instL'])) {
                        professionalList();
                    }
                    if (isset($_GET['addT'])) {
                        addProfessional();
                    }if (isset($_GET['editI'])) {
                        personalDataI();
                    }if (isset($_GET['instPass'])) {
                        personalData();
                    }if (isset($_GET['set'])) {
                        setPaciente();
                    }
                    if (isset($_GET['search'])) {
                        $i = $_GET['professional'];
                        search_professional($i);
                    }
                    ?>
                </div>
                <div id="footer">
                    <?php footer(); ?>
                </div>
            </div>

        </div>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    </body>
</html>
