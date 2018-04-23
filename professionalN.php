<?php
session_start();
require_once './include/functionH.php';
require_once './include/functionH2.php';

$level = 5;
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
                        <a onclick="document.getElementById('home').href = 'professionalN.php'" id="home"><span class="fa fa-home fa-3x" title="Inicio"></span>
                        </a>
                    </li>
                    <li><a id="profNData" href="" onclick="clickTo('profNData')">Perfil</a>
                    </li>
                    <li><a id="pathology" href="" onclick="clickTo('pathology')">Patologia</a>
                    </li>
                    <li><a id="exercise" href="" onclick="clickTo('exercise')">Exercício</a>
                    </li>
                    <li><a id="domain" href="" onclick="clickTo('domain')">Domínio</a>
                    </li>


                    <li>
                        <a onclick="logout();" id="off"><img src="./img/off.jpg" alt="Terminar" title="Terminar Sessão" width="30px" height="30px"></a>
                    </li>
                </ul>

            </div>
            <div id="bodybox">

                <div id="subnavi" >
                    <?php
                    if ((!$_GET)) {
                        ?>
                        <script type="text/javascript">
                            document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');
                        </script>
                        <script type="text/javascript">
                            var params = {rssmikle_url: "http://caminhodapsicologia.webnode.com.pt/rss/noticias.xml", rssmikle_frame_width: "220", rssmikle_frame_height: "500", frame_height_by_article: "", rssmikle_target: "_blank", rssmikle_font: "Arial, Helvetica, sans-serif", rssmikle_font_size: "15", rssmikle_border: "off", responsive: "off", rssmikle_css_url: "", text_align: "left", text_align2: "left", corner: "off", scrollbar: "on", autoscroll: "on", scrolldirection: "up", scrollstep: "3", mcspeed: "20", sort: "New", rssmikle_title: "on", rssmikle_title_sentence: "Notícias", rssmikle_title_link: "", rssmikle_title_bgcolor: "#7f0d06", rssmikle_title_color: "#FFFFFF", rssmikle_title_bgimage: "", rssmikle_item_bgcolor: "#FFFFFF", rssmikle_item_bgimage: "", rssmikle_item_title_length: "55", rssmikle_item_title_color: "#0066FF", rssmikle_item_border_bottom: "on", rssmikle_item_description: "on", item_link: "off", rssmikle_item_description_length: "150", rssmikle_item_description_color: "#666666", rssmikle_item_date: "gl1", rssmikle_timezone: "Etc/GMT", datetime_format: "%b %e, %Y %l:%M:%S %p", item_description_style: "text+tn", item_thumbnail: "full", article_num: "15", rssmikle_item_podcast: "off", keyword_inc: "", keyword_exc: ""};
                            feedwind_show_widget_iframe(params);
                        </script>


                        <?php
                    } if (isset($_GET['pathology']) or isset($_GET['addPat']) or isset($_GET['search'])) {
                        profNverticalM1();
                    }if (isset($_GET['exercise'])or isset($_GET['id']) or isset($_GET['exerciseE'])or isset($_GET['searchE']) or isset($_GET['exerc'])or isset($_GET['exerciseList'])or isset($_GET['exer'])) {
                        profNverticalM2();
                    }if (isset($_GET['domain']) or isset($_GET['addDomain'])or isset($_GET['listaPN'])or isset($_GET['dom'])or isset($_GET['searchD'])or isset($_GET['addDomainE'])) {
                        profNverticalM3();
                    }if (isset($_GET['profNData']) or isset($_GET['profNDados'])or isset($_GET['profNPass'])or isset($_GET['dom'])) {
                        profNverticalM4();
                    }
                    ?>

                </div>

                <div id="content">

                    <?php
                    if (!$_GET) {
                        ?>
                        <h1>
                            <script >
                                greetingP(3);
                            </script></h1> 
                        <p style="font-size: 30px;color: #0000cc">Para iniciar utilize o menu de navegação</p>
                        <image src="http://curiosidades.batanga.com/sites/curiosidades.batanga.com/files/imagecache/primera/152985436.jpg"\></div>
                    <?php
                }

                if (isset($_GET['exerc'])) {
                    menuStructure();
                }if (isset($_GET['pacient'])) {
                    addPatient();
                }if (isset($_GET['addPat'])) {
                    addPathology();
                }if (isset($_GET['addDomain'])) {
                    addDomain();
                }if (isset($_GET['profNPass'])) {
                    personalData();
                }if (isset($_GET['exerciseList'])) {
                    exerciseList();
                }if (isset($_GET['profNDados'])) {
                    personalDataP(2);
                }if (isset($_GET['search'])) {
                    $s = $_GET['pat'];
                    search_pathology($s);
                }if (isset($_GET['searchE'])) {
                    $e=$_GET['exercicio'];
                    searchExercise($e);
                }if (isset($_GET['id'])) {
                    $e=$_GET['id'];
                    $s=$_GET['v'];
                    regMultiple($e,$s);
                }if (isset($_GET['exerciseE'])) {
                     $i = $_GET['exerciseE'];
                     
                    $ligacao = connect();
                    
                    $elimina = "DELETE FROM exercise where name='$i'";
                    $query = mysql_query($elimina, $ligacao);
                    if($query==TRUE){
                           ?>
                <h3>Exercício eliminado com sucesso!</h3>
                        <?php
                    }else{
                                    ?>
                <h3>Falha na eliminação!</h3>
                        <?php
                    }
                    mysql_close($ligacao);
                  
                 
                }if (isset($_GET['addDomainE'])) {
                    
                    setDomain();
                }if (isset($_GET['searchD'])) {
                    $s = $_GET['dominio'];
                    search_domain($s);
                }if (isset($_GET['profNData'])) {
                ?><p style="font-size: 27px;color: #991417;cursor: pointer;">Dados pessoais - Para iniciar utilize o menu lateral</p>                    
                            <image src="http://www.imagens.zapidi.com/wp-content/uploads/edd/2015/01/ferramenta-configura%C3%A7%C3%B5es.png" width="400" height="300" style="margin-left: 54px"/>
                <?php
                }if (isset($_GET['pathology'])) {
                ?><p style="font-size: 27px;color: #991417;cursor: pointer;">Gerir Patologias - Para iniciar utilize o menu lateral</p>                    
                            <image src="http://www.beliefnet.com/healthandhealing/images/si2146_ma.jpg"  width="420" height="300"style="margin-left: 54px"/>
                <?php
                }if (isset($_GET['exercise'])) {
                ?><p style="font-size: 27px;color: #991417;cursor: pointer;">Exercícios - Para iniciar utilize o menu lateral</p>                    
                            <image src="http://www.lessons4living.com/images/penclchk.gif"  style="margin-left: 54px"/>
                <?php
                }if (isset($_GET['domain'])) {
                ?><p style="font-size: 27px;color: #991417;cursor: pointer;">Domínios- Para iniciar utilize o menu lateral</p>                    
                            <image src="http://youthforservice.org/wp-content/uploads/2013/05/Alzheimer%E2%80%99s-Disease-Signs-Symptoms-Stages-Treatment.jpg" width="500" height="400" style="margin-left: 54px"/>
                <?php
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
