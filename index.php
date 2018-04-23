
<?php
require_once './include/functionH.php';

login();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="icon" type="image/jpg" href="./img/nep.jpg" />
        <link rel="stylesheet" type="text/css" href="./css/global.css"/>
        <link href="./css/bootstrap1.min.css" rel="stylesheet"/>
        <link href="./css/glyphicons.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>NepUminho</title>
        <script src="./js/jquery.min.js" ></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false" ></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" ></script>


        <script src="./js/alertify.min.js"></script>
        <script type="text/javascript" src="./js/jscript.js"></script>
</head> 

    <body  onload="mudarImagem();
            initialize();" >
           
        <div id="form-content" class="modal hide fade in" style="display: none;">
            <div class="modal-header">

                <h3>Termos e condições</h3>
            </div>
            <div class="modal-body">
                <div>

                    <p>A equipa da plataforma NEP-UM reserva-se o direito de adicionar ou alterar os termos
                        e condições de utilização sem aviso prévio,
                        pelo que deve consultar as presentes condições sempre que aceder ao portal.</p>
                    <h3>Descrição</h3>
                    <p>O acesso à plataforma NEP-UM é gratuito, contudo deve ser realizado através de referência por um 
                        profissional de saúde. Os pacientes que desejem usufruir do mesmo serviço deverão contactar o profissional
                        de saúde a seu cargo de forma a que este lhes permita acesso.</p>
                    <h3>Propriedade intelectual</h3>
                    <p>A presente plataforma é para uso pessoal do utilizador (profissionais de saúde e pacientes), pelo que fica 
                        proibida qualquer utilização comercial dos conteúdos do portal, bem como a cópia, alteração, distribuição, 
                        exibição, reprodução, publicação, transferência ou venda de quaisquer informações, esclarecimentos ou serviços 
                        obtidos. Exceptuam-se a esta interdição os usos livres autorizados por lei, nomeadamente o direito de citação, 
                        desde que claramente identificada a fonte da informação.
                        <br>Qualquer infracção destes direitos ou utilização não autorizada dos conteúdos por terceiros, 
                            pode dar origem a procedimento extrajudicial e/ou judicial de natureza cível e/ou criminal.</p>
                    <h3>Exclusão de responsabilidade</h3>
                    <p>Em caso algum a equipa da plataforma NEP-UM pode ser responsabilizada, directa ou indirectamente, por 
                        uso indevido da plataforma, qualquer dano resultante ou de qualquer forma relacionado com o uso da 
                        presente plataforma e das informações apresentadas e relativas à mesma.</p>
                    <h3>Suspensão, interrupção ou alteração do serviço</h3>
                    <p>A equipa da plataforma NEP-UM pode em qualquer altura interromper ou suspender o serviço, 
                        temporária ou definitivamente, sem qualquer aviso prévio.<br>
                            A equipa do NEP-UM reserva-se o direito de inserir, alterar e remover, sem aviso prévio e 
                            seja qual for a causa, qualquer informação presente no portal. </p>
                    <h3>Legislação aplicável e jurisdição</h3> 
                    <p>Os presentes termos e condições de utilização regem-se pela legislação Portuguesa.</p>
                    <h3>Disposições finais</h3>
                    <p>Este portal tem como objectivo último ser consultado e utilizado por um vasto leque de utilizadores, 
                        embora direccionado a pacientes com patologia cerebral
                        e profissionais de saúde. Os dados dos utilizadores são devidamente protegidos.<br>
                            Pretendemos que estas informações sejam actualizadas e rigorosas e 
                            procuraremos corrigir todos os erros que nos forem comunicados.
                    </p>
                    <p>Para esclarecimentos adicionais não hesite em nos contactar: nepowlit@hotmail.com</p>


                </div>
            </div>
            <div class="modal-footer">

                <a class="btn" name="in"  title="Aceitar" >Aceitar</a>
                <a class="btn" data-dismiss="modal">Recusar</a>
            </div>
        </div>

        <div class="wrapper">
            <div id="header" >
                <?= top(); ?>
            </div>
            <div id='cssmenu'>

                <ul>
                    <li> <a id="who" href="#" onclick="clickTo('who')" >Quem Somos? <span class="icon-users"></span></a>

                    </li>
                    <li> <a id="structure" href="#" onclick="clickTo('structure')" >Infra-Estrutura <span class="icon-office"></span></a>

                    </li>

                    <li><a  id="menu1" data-toggle="dropdown" href="#" class="" >Info-Uteis <span class="icon-info-sign"></span></a>


                        <ul class="dropdown-menu" >

                            <li ><a  id="e"  onclick="clickTo('e')">Convénio</a><br/>
                            </li><li > <a   id="talk" onclick="clickTo('talk')">Orientação ao Paciente</a>
                            </li></ul>

                    </li> 

                    <li> <a id="contato" onclick="clickTo('contato')" >Fale connosco <span class="icon-comment"></span></a>
                    </li>
                    <li>
                        <a href="#" id="guest" onclick="clickTo('guest')">Primeira vez<span class="glyphicon glyphicon-send"></span> </a>

                    </li>

                    <li>
                        <form id="login"  method="post" class="navbar-search pull-right" >
                            <input id="username" type="text" name="username" placeholder="Utilizador" required >
                                <input id="password" type="password" name="password" placeholder="Password" required>

                                    <button   class="btn btn-default btn-sm" name="in"  type="submit" >
                                        <span class="glyphicon glyphicon-log-in" ></span> Entrar
                                    </button>
                                    <a  href="#" id="forgot" onclick="clickTo('forgot')">Esqueceu-se da password?</a>

                                    </form>

                                    </li>

                    
                                    </ul>
                                    </div>

                                    <div id="bodybox">
                                        <div id="subnavi">

                                            <script type="text/javascript" async="async">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script>
                                            <script type="text/javascript" async="async">
                                                var params = {rssmikle_url: "http://caminhodapsicologia.webnode.com.pt/rss/noticias.xml", rssmikle_frame_width: "220", rssmikle_frame_height: "500", frame_height_by_article: "", rssmikle_target: "_blank", rssmikle_font: "Arial, Helvetica, sans-serif", rssmikle_font_size: "15", rssmikle_border: "off", responsive: "off", rssmikle_css_url: "", text_align: "left", text_align2: "left", corner: "off", scrollbar: "on", autoscroll: "on", scrolldirection: "up", scrollstep: "3", mcspeed: "20", sort: "New", rssmikle_title: "on", rssmikle_title_sentence: "Notícias", rssmikle_title_link: "", rssmikle_title_bgcolor: "#7f0d06", rssmikle_title_color: "#FFFFFF", rssmikle_title_bgimage: "", rssmikle_item_bgcolor: "#FFFFFF", rssmikle_item_bgimage: "", rssmikle_item_title_length: "55", rssmikle_item_title_color: "#0066FF", rssmikle_item_border_bottom: "on", rssmikle_item_description: "on", item_link: "off", rssmikle_item_description_length: "150", rssmikle_item_description_color: "#666666", rssmikle_item_date: "gl1", rssmikle_timezone: "Etc/GMT", datetime_format: "%b %e, %Y %l:%M:%S %p", item_description_style: "text+tn", item_thumbnail: "full", article_num: "15", rssmikle_item_podcast: "off", keyword_inc: "", keyword_exc: ""};
                                                feedwind_show_widget_iframe(params);</script>
                                            <div id="imgbox">
                                                <img src="./img/cognitive.jpg" alt="me" width="154" height="170"/>
                                                <br />
                                                <strong><p>Plataforma de Treino Cognitivo</p></strong>
                                            </div>
                                        </div>

                                        <div id="content">

                                            <?php
                                            if (!filter_input_array(INPUT_GET)) {

                                                firstContent();
                                                ?>

                                                <div  class="menueconteudoadmin"  >
                                                    <div class="formsadmin">
                                                        <div id="caixaopcoes" class="caixaopcoes">
                                                            <div id=mapa class=mapa>
                                                                <div  >
                                                                    <form id="map" method="post" action="index.php"  >
                                                                        Origem: &nbsp<input type="text" id="txtEnderecoPartida" name="txtEnderecoPartida" /><br><br>
                                                                                Destino: <a>Escola de Psicologia Campus de Gualtar 4710-057 Braga</a><br><br>
                                                                                        <input type="submit" id="btnEnviar" name="btnEnviar" value="Traçar Rota" onclick="submitMap();"/>
                                                                                        </form>
                                                                                        </div>
                                                                                        <div id=desenharmapa class=desenharmapa></div>
                                                                                        <div id="trajeto" class="trajeto"></div>

                                                                                        </div>
                                                                                        </div>
                                                                                        </div>
                                                                                        </div>


                                                                                        <?php
                                                                                    }
                                                                                    if (isset($_GET['infra'])) {
                                                                                        infrastructure();
                                                                                    }if (isset($_GET['forgotPass'])) {
                                                                                        forgot();
                                                                                    }
                                                                                    if (isset($_GET['conv'])) {
                                                                                        partners();
                                                                                    }if (isset($_GET['who'])) {
                                                                                        require 'team.php';
                                                                                    }if (isset($_GET['Paciente'])) {
                                                                                        orientation();
                                                                                    }if (isset($_GET['contato'])) {
                                                                                        about();
                                                                                    }if (isset($_GET['guest'])) {
                                                                                        firstTime();
                                                                                    }
                                                                                    ?>
                                                                                    </div>
                                                                                    </div>
                                                                                    <div id="footer">
                                                                                        <?php footer(); ?>
                                                                                    </div>
                                                                                    </div>


                                                                                    </body>
        
                                                                                    </html>