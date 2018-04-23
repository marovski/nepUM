<?php
session_start();
require_once './include/functionH.php';
require_once './include/functionH2.php';
$level = 3;
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
                        <a onclick="document.getElementById('home').href = 'professional.php'" id="home"><span class="fa fa-home fa-3x" title="Inicio"></span>
                        </a>
                    </li>
                    <li><a id="ppro" href="" onclick="clickTo('ppro')">Perfil</a>
                    </li>
                    <li>
                        <a id="createS" href="" onclick="clickTo('createS')">Criar  Sessão</a>
                    </li>
                    <li><a id="pac" href="" onclick="clickTo('pac')">Paciente</a>
                    </li>
                    <li>
                        <a id="menu2" data-toggle="dropdown">Relatório<span >▼</span></a>
                        <ul class="dropdown-menu" >

                            <li>  <a id="reportList" onclick="clickTo('reportList')">Consultar Relatórios</a><br/></li>
                        </ul>
                    </li> 

                    <li>
                        <?php
                        $ligacao = connect();
                        $prof = $_SESSION['professional'];
                        $t = "SELECT COUNT(*) FROM mailbox WHERE status = 1 and deleted = 1 and receiver='$prof'";
                        $query = mysql_query($t, $ligacao);
                        $R = mysql_fetch_array($query);
                        $r = $R[0];
                        if ($r == 0) {
                            ?>
                            <a id="mailbox" href="" onclick="clickTo('mailbox')"><img src="./img/mail.jpg" style="
                                                                                      width: 32px;
                                                                                      height: 32px;
                                                                                      margin-top: -4px;
                                                                                      "></a>
                            <?php } else {
                                ?>
                            <a id="mailbox" href="" onclick="clickTo('mailbox')"><img src="./img/mail1.jpg" style="
                                                                                      width: 32px;
                                                                                      height: 32px;
                                                                                      margin-top: -4px;
                                                                                      "></a> <?php mysql_close($ligacao);} ?>
                    </li>
                    <li>
                        <a onclick="logout();" id="off"><img src="./img/off.jpg" alt="Terminar" title="Terminar Sessão" width="30px" height="30px"></a>
                    </li>
                </ul>

            </div>
            <div id="bodybox">

                <div id="subnavi" >
                    <?php
                    if ((!$_GET)or isset($_GET['createS'])or isset($_GET['reportList'])or isset($_GET['mailbox'])or isset($_GET['mailboxd'])or isset($_GET['id'])) {
                        ?>

                        <script type="text/javascript">
                            document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');
                        </script>
                        <script type="text/javascript">
                            var params = {rssmikle_url: "http://caminhodapsicologia.webnode.com.pt/rss/noticias.xml", rssmikle_frame_width: "220", rssmikle_frame_height: "500", frame_height_by_article: "", rssmikle_target: "_blank", rssmikle_font: "Arial, Helvetica, sans-serif", rssmikle_font_size: "15", rssmikle_border: "off", responsive: "off", rssmikle_css_url: "", text_align: "left", text_align2: "left", corner: "off", scrollbar: "on", autoscroll: "on", scrolldirection: "up", scrollstep: "3", mcspeed: "20", sort: "New", rssmikle_title: "on", rssmikle_title_sentence: "Notícias", rssmikle_title_link: "", rssmikle_title_bgcolor: "#7f0d06", rssmikle_title_color: "#FFFFFF", rssmikle_title_bgimage: "", rssmikle_item_bgcolor: "#FFFFFF", rssmikle_item_bgimage: "", rssmikle_item_title_length: "55", rssmikle_item_title_color: "#0066FF", rssmikle_item_border_bottom: "on", rssmikle_item_description: "on", item_link: "off", rssmikle_item_description_length: "150", rssmikle_item_description_color: "#666666", rssmikle_item_date: "gl1", rssmikle_timezone: "Etc/GMT", datetime_format: "%b %e, %Y %l:%M:%S %p", item_description_style: "text+tn", item_thumbnail: "full", article_num: "15", rssmikle_item_podcast: "off", keyword_inc: "", keyword_exc: ""};
                            feedwind_show_widget_iframe(params);
                        </script>

                        <?php
                    }if (isset($_GET['ppro'])or isset($_GET['dataPr2'])or isset($_GET['dataPr1'])) {
                        profVerticalM1();
                    } if (isset($_GET['pac'])or isset($_GET['afG'])or ( isset($_GET['search']))or isset($_GET['pacient']) or isset($_GET['patList']) or isset($_GET['search'])or isset($_GET['patP'])or isset($_GET['patR'])) {
                        profverticalM2();
                    }
                    ?>

                </div>

                <div id="content">

                    <?php
                    if ((!$_GET)) {
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
                    addExercise();
                }if (isset($_GET['pacient'])) {
                    addPatient();
                }if (isset($_GET['createS'])) {
                    createSession();
                }if (isset($_GET['afG'])) {
                    turn_guest();
                }if (isset($_GET['dataPr2'])) {
                    personalData();
                }if (isset($_GET['dataPr1'])) {
                    personalDataP(1);
                } if (isset($_GET['reportList'])) {
                    reportList();
                }if (isset($_GET['patList'])) {
                    patientList();
                }if (isset($_GET['patP'])) {
                    setPathology();
                }if (isset($_GET['mailbox'])or isset($_GET['mailboxd'])or isset($_GET['id'])) {
                    mailbox();
                }if (isset($_GET['mailboxd'])) {
                    $i = $_GET['mailboxd'];
                    $ligacao = connect();
                    $e = $_GET['if'];
                    $elimina = "UPDATE mailbox SET deleted=0  WHERE id='$e'";
                    $query = mysql_query($elimina, $ligacao);
                    mysql_close($ligacao);
                    ?>  <div class="table-responsive">
                        <table class="table table-hover"><thead><th>Mensagem Recebida</th></thead>
                            <tbody><td>
    <?= $i; ?></td></tbody></table></div>
                                    <?php
                                }if (isset($_GET['id'])) {
                                    $ligacao = connect();
                                    $e = $_GET['id'];
                                    $elimina = "UPDATE mailbox SET status=0  WHERE id='$e'";
                                    $query = mysql_query($elimina, $ligacao);
                                    if($query==TRUE){
                                        ?><script>alertify.success("Success notification")</script><?php
                                    }
                                    mysql_close($ligacao);
                                }
                                if (isset($_GET['patR'])) {
                                    removePathology();
                                }if (isset($_GET['search'])) {
                                    $p = $_GET['patient'];
                                    search_patient($p);
                                }if (isset($_GET['pac'])) {
                                    ?><p style="font-size: 27px;color: #991417;cursor: pointer;">Bem Vindo - Para iniciar utilize o menu lateral</p>                    
                    <image src="http://www.ediciona.com/portafolio/image/0/3/8/1/imagen_3_1830.png"  width="400" height="400"style="margin-left: 54px"/>
                                    <?php
                                }if (isset($_GET['ppro'])) {
                                    ?><p style="font-size: 27px;color: #991417;cursor: pointer;">Dados pessoais - Para iniciar utilize o menu lateral</p>                    
                    <image src="http://www.imagens.zapidi.com/wp-content/uploads/edd/2015/01/ferramenta-configura%C3%A7%C3%B5es.png" width="400" height="300" style="margin-left: 54px"/>
                    <?php
                }
                ?>
            </div>
            <div id="footer">
<?php footer(); ?>
            </div>
        </div>

        </div>



    </body>
</html>
