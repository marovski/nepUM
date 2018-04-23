   

<script src="./js/jquery.min.js" ></script>

<?php
require_once 'mysql.connect.php';
require_once 'dataBase.php';

//HTML_FOOTER
function footer() {
    ?>
    <p>Copyright 2015 All Rights Reserved. | Design by <b>OWL-IT</b></p>
    <?php
}

//HTML_HEADER
function top() {
    ?>

    <div id="logobox" >
    </div>
    <div id="headimg">
        <img height="250" name="slide" src="./img/brain4.jpg" width="778" />
    </div>
    <?php
}

//INICIAL PAGES
//HTML_PRIMEIRO CONTEUDO
function firstContent() {
    ?>

    <h1>Propósito</h1>

    <p>O NEP-UM é uma plataforma de treino cognitivo desenvolvida no âmbito do Projecto com o título “Treino Cognitivo em Perturbações cerebrais: Eficácia da estimulação cognitiva e desenvolvimento de uma nova ferramenta para os clínicos Portugueses”, financiado pela Ciência e Tecnologia (Referência PIC/IC/83290/2007), e é destinada a profissionais e pacientes envolvidos no processo de reabilitação cognitiva.</p>

    <p> Esta ferramenta foi desenvolvida tendo por base as mais recentes evidências respeitantes a conhecimentos teóricos e técnicas de terapias cognitivas aplicadas no contexto de diversas patologias neurológicas e psiquiátricas (exemplo - Doença de Alzheimer, Esclerose Múltipla, AVC, Traumatismo Crânioencefálico, Síndrome de Williams, etc.).<p>

    <h2>A plataforma NEP-UM permite:</h2>
    <ol>
        <li>
            <p>Prescrever, por parte do terapeuta, sessões e exercícios específicos para o paciente/participante.
            </p>
        </li>

        <li>
            <p>    Monitorizar o desempenho ao longo das tarefas bem como a elaboração de relatório para o terapeuta assistente.
            </p>   </li>

        <li><p>
                Aceder a exercícios especificamente adaptados às necessidades específicas do paciente/participante.
            </p>
        </li>
    </ol>
    <br>
    <h2 >Como chegar?</h2>
    <br>

    <?php
}

//HTML_CONVENIO
function partners() {
    ?>
    <div id="conv">
        <h1>Colaboradores:</h1>

        <p>Hospital Geral de Coimbra (Covões) - Centro Hospitalar de Coimbra</p>
        <p>Hospital de Braga</p>
        <p>Hospital de Magalhães Lemos</p>


        <p> Caso a sua instituição (ex.:  hospital, associação, etc.) esteja interessada em cooperar com as actividades de investigação desenvolvidas a propósito da plataforma NEPUM ou em disponibilizar esta ferramenta aos seus profissionais de saúde e pacientes, apresente-nos a sua proposta através do seu registo no programa.</h3>
        </p>

        <label>
            <img src="http://www.newsrondonia.com.br/imagensNoticias/image/hospital(2).jpg"></label>
    </div>
    <?php
}

//HTML ORIENTATION FOR PACIENT
function orientation() {
    ?>
    <div id="conv">
        <h1>Orientação:</h1>
        <p>Para aceder aos exercícios, o paciente/participante deverá pedir ao profissional de saúde que o acompanha (médico neurologista, psicólogo, psiquiatra) que entre em contacto com a equipa do NEP-UM para que lhe sejam fornecidos os dados de acesso.</p>

        <p> Desta forma, o profissional de saúde poderá prescrever ao seu paciente os exercícios adequados.</p>

        <p>  Para realizar os exercícios o paciente receberá um código de acesso pessoal e intransmissível. Todos os seus dados são confidenciais.</p>




    </div>
    <?php
}

function personalData() {
    $ligacao = connect();
    $user = $_SESSION['username'];
    $old_pass = "SELECT pass FROM user WHERE username='$user'" or die(mysql_error());
    $query = mysql_query($old_pass, $ligacao);
    while ($row = mysql_fetch_array($query)) {
        $pass = $row['pass'];
    }
    ?>
    <div id="perfis">
        <h1>Alterar password</h1>
        <fieldset>

            <form method="post">
                <p><label>Username:</label></p>
                <input type="text" name="username" value="<?= $user ?>" disabled>
                <p><label>Palavra-chave atual:</label></p>
                <input type="password" name="old">
                <p><label>Nova Palavra-chave</label></p>
                <input type="password" name="new">
                <p><label>Confirmar Palavra-chave</label></p>
                <input type="password" name="conf"><br/><br/>
                <input type="submit" name="edit" value="Editar">
            </form>
            <?php
            if (isset($_POST['edit'])) {
                if (isset($_POST['old']) && $_POST['old'] != '') {
                    $antiga = md5($_POST['old']);
                    if ($pass == $antiga) {
                        if (isset($_POST['new']) && $_POST['new'] != '') {
                            if (isset($_POST['conf']) && $_POST['conf'] != '') {
                                $new = md5($_POST['new']);
                                $conf = md5($_POST['conf']);
                                if ($new == $conf) {
                                    $update = "UPDATE user SET pass='$new' WHERE username='$user'" or die(mysql_error());
                                    mysql_query($update, $ligacao);
                                    echo 'Palavra-chave alterada com sucesso';
                                } else {
                                    echo 'Erro: Nova palavra-chave não é igual.';
                                }
                            } else {
                                echo 'Preencha todos os campos.';
                            }
                        } else {
                            echo 'Preencha todos os campos.';
                        }
                    } else {
                        echo 'Palavra-chave atual errada. Tente novamente.';
                    }
                } else {
                    echo 'Preencha todos os campos';
                }
            }
            mysql_free_result($query);
            mysql_close($ligacao);
            ?>
        </fieldset>
    </div>
    <?php
}

//HTML FALE CONNOSCO
function about() {
    ?>
    <div id="conv">
        <h1>Contacto:</h1>

        <p>
            Poderá  entrar em contacto connosco através das seguintes formas:</p>
        <address>
            <p> E-mail: nepowlit@hotmail.com</p>

            <p title="Phone"> Telefone: (+351) 253 601398</p>
        </address>

        <div id="perfis">
            <fieldset>
                <legend><image src="./img/contato.jpg" width="71px" height="60px" /></legend>
                <form method="post" style="font-style: oblique;">
                    <p><label>Nome:</label></p>
                    <input type="text" name="nome">


                    <p><label>Assunto:</label></p>
                    <input type="text" name="doubt">

                    <p><label>Texto:</label></p>
                    <input type="text" name="Text" style="width: 300px;height: 100px">
                    <p><label><span class="glyphicon glyphicon-envelope"></span> Email:</label></p>
                    <input type="email" name="mail">

                    <input type="submit" name="sendEmail" value="Enviar">
                </form>
            </fieldset>
        </div>
    </div>
    <?php
}

//CONTACT PROFESSIONAL
function contactProfessional() {
    ?>
    <div id="perfis">
        <fieldset>
            <legend><image src="./img/contato.jpg" width="71px" height="60px"/></legend>
            <form method="post" style="font-style: oblique;">
                <p><label>Nome:</label></p>
                <input type="text" name="nome"  value="<?= $_SESSION['username']; ?>" disabled="">


                <p><label>Assunto:</label></p>
                <input type="text" name="doubt" required="">

                <p><label>Dúvida:</label></p>
                <input type="text" name="Text" style="width: 300px;height: 100px" required="">

                <p><label>Profissional Designado:</label></p>
                <select name="proD" required="">
                    <?php
                    $patient = $_SESSION['patient'];
                    $pat = listProfessional(2, $patient);
                    while ($row1 = mysql_fetch_array($pat)) {
                        ?>
                        <option value="<?= $row1['nif'] ?>"><?= $row1['name'] ?></option>
                        <?php
                    }
                    ?> 

                    
                </select>
                <input type="submit" name="sendEmailP" value="Enviar">
            </form>
        </fieldset>
        <?php
        if (isset($_POST['sendEmailP'])) {
            $receiver = $_POST['proD'];
            $mensagem = $_POST['Text'];

            $sender = $_SESSION['patient'];
            $titulo = $_POST['doubt'];

            email2($sender, $receiver, $mensagem, $titulo);
        }
        ?>
    </div>
    <?php
}

//HTML INFRASTRUCTURE
function infrastructure() {
    ?>
    <div id="conv">
        <h1>Infra Estrutura:</h1>
        <p>O laboratório de Neuropsicofisiologia está inserido no Centro de Investigação em Psicologia da Escola de Psicologia, Universidade do Minho <a href="http://webs.psi.uminho.pt/LABSPSI/lnp/">(http://webs.psi.uminho.pt/LABSPSI/lnp/)</a>.
        </p><p> Dispõe de uma sala para avaliação e registo de medidas psicofisiológicas, sala de trabalho. Além disso, está inserido no Serviço de Psicologia da Escola de Psicologia da Universidade do Minho, dispondo dos recursos deste serviço <a href="http://www.psi.uminho.pt/Default.aspx?tabid=12&pageid=68&lang=pt-PT">(http://www.psi.uminho.pt/Default.aspx?tabid=12&pageid=68&lang=pt-PT)</a>.
        </p>
        <br/>
        <label>
            <img onmouseover="" src="http://npl-nepum.psi.uminho.pt/Files/1/Images/6003ecb3-7e9d-4720-b566-d42f80114039/Image.JPG" width="500" height="300"></label>
    </div>
    <?php
}

//VERTICAL MENUS               
//Vertical Menu
function profVerticalM1() {
    ?>   

    <div id="accordian">


        <ul>
            <li> <a id="dataPr1" onclick="clickTo('dataPr1')">Alterar Dados <span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="dataPr2" onclick="clickTo('dataPr2')">Alterar Password <span class="glyphicon glyphicon-pencil"></span></a></li>

        </ul>

    </div> 





    <?php
}

function profverticalM2() {
    ?>
    <div id="accordian">


        <ul>

            <li> <a id="pacient" onclick="clickTo('pacient')">Registar Paciente <span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="afG" onclick="clickTo('afG')">Afiliar Guest <span class="glyphicon glyphicon-pencil"></span></a></li>

            <li>  <a id="patList" onclick="clickTo('patList')">Listar Pacientes <span class="glyphicon glyphicon-list-alt"></span></a> </li>
            <li>  <a id="patP" onclick="clickTo('patP')">Atribuir patologia <span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="patR" onclick="clickTo('patR')">Retirar patologia <span class="glyphicon glyphicon-pencil"></span></a></li>

            <li>
                <form method="get">
                    <input type="text" name="patient"  required="true"/>
                    <button type="submit" id="searchPatient" name="search" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

function profNverticalM1() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="addPat" onclick="clickTo('addPat')">Adicionar Patologia <span class="glyphicon glyphicon-pencil"></span></a></li>


            <li>
                <form method="get">
                    <input type="text" name="pat"  required="true"/>
                    <button type="submit" id="searchPat" name="search" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

function profNverticalM2() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="exerc" onclick="clickTo('exerc')">Adicionar Exercício <span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="exerciseList" onclick="clickTo('exerciseList')">Listar Exercicios <span class="glyphicon glyphicon-list-alt"></span></a></li>


            <li>
                <form method="get">
                    <input type="text" name="exercicio"  required="true"/>
                    <button type="submit" id="search" name="searchE" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

function profNverticalM3() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="addDomain" onclick="clickTo('addDomain')">Registar Domínio<span class="glyphicon glyphicon-pencil"></span></a></li>
            <li> <a id="addDomainE" onclick="clickTo('addDomainE')">Adicionar domínio a um exercício<span class="glyphicon glyphicon-pencil"></span></a></li>




            <li>

                <form method="get">
                    <input type="text" name="dominio"  required="true"/>
                    <button type="submit" id="search" name="searchD" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

function profNverticalM4() {
    ?>
    <div id="accordian">


        <ul>

            <li> <a id="profNDados" onclick="clickTo('profNDados')">Alterar Dados <span class="glyphicon glyphicon-pencil"></a></li>
            <li> <a id="profNPass" onclick="clickTo('profNPass')">Alterar Password <span class="glyphicon glyphicon-pencil"></a></li>

        </ul>

    </div>   
    <?php
}

//Institution vertical menu
function instVerticalM1() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="inst1" onclick="clickTo('inst1')"">Registar Profissional <span class="glyphicon glyphicon-pencil"></span></a></li>

            <li><a id="inst" onclick="clickTo('inst')">Listar Profissionais <span class="glyphicon glyphicon-list-alt"></span></a>
            </li>
            <li>
                <form method="get">
                    <input type="text" name="professional"  required="true"/>
                    <button type="submit" id="search" name="search" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

function patverticalM1() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="patDados" onclick="clickTo('patDados')">Alterar Dados <span class="glyphicon glyphicon-pencil"></a></li>

            <li> <a id="patPass" onclick="clickTo('patPass')">Alterar Password <span class="glyphicon glyphicon-pencil"></a></li>
        </ul>
    </div>   
    <?php
}

function patverticalM2() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="exerciseR" onclick="clickTo('exerciseR')">Realizar Exercício <span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="checkResults" onclick="clickTo('checkResults')">Listar Resultados <span class="glyphicon glyphicon-list-alt"></span></a></li>


        </ul>

    </div>
    <?php
}

function adminVerticalM() {
    ?>
    <div id="accordian">


        <ul>
            <li> <a id="registo" onclick="clickTo('registo')">Registar Instituição <span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="lista" onclick="clickTo('lista')">Listar Instituições<span class="glyphicon glyphicon-list-alt"></span></a></li>

            <li>
                <form method="get">
                    <input type="text" name="s"  required="true"/>
                    <button type="submit" id="search" name="search" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

//HTML Vertical menu
function adminVerticalM2() {
    ?>
    <div id="accordian">

        <ul>
            <li> <a id="registo2" onclick="clickTo('registo2')">Registar Profissional<span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="lista2" onclick="clickTo('lista2')">Listar Profissionais<span class="glyphicon glyphicon-list-alt"></span></a></li>

            <li>
                <form method="get">
                    <input type="text" name="i" required="true"/>
                    <button type="submit" id="search" name="searchI" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </li>
        </ul>

    </div>   
    <?php
}

function instVerticalM2() {
    ?>
    <div id="accordian">

        <ul>
            <li> <a id="editI" onclick="clickTo('editI')">Alterar dados<span class="glyphicon glyphicon-pencil"></span></a></li>
            <li>  <a id="instPass" onclick="clickTo('instPass')">Alterar Password<span class="glyphicon glyphicon-pencil"></span></a></li>


        </ul>

    </div>   
    <?php
}

//HTML to Edit personal data
function personalDataI() {
    ?>
    <?php
    $user = $_SESSION['institution'];
    $dados = selectDB(1, $user);
    ?>
    <h1>Dados</h1>
    <div id="perfis">
        <fieldset>
            <div class="container">

                <hr>
                <div class="row">


                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">



                        <form class="form-horizontal" role="form" method="post">
                            <?php
                            if (mysql_num_rows($dados) > 0) {

                                while ($row = mysql_fetch_array($dados)) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nome:</label>
                                        <div class="col-lg-8">
                                            <p> <input class="form-control" type="text" name="iN" value="<?php echo $row['name']; ?>"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">NIPC:</label>
                                        <div class="col-lg-8">
                                            <p> <input class="form-control" type="int" disabled="" value="<?php echo $row['nipc']; ?>"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Área atual:<?php echo $row['area']; ?></label>
                                        <div class="col-lg-8">
                                            <?php if ($row['area'] == 'Clínica') { ?>
                                                <p> <select class="form-control" name="tipo"> 
                                                        <option value="<?php echo $row['area']; ?>"></option>
                                                        <option value="Institucional">Institucional</option>
                                                        <option value="Hospitalar">Hospitalar</option>
                                                    </select>
                                                <?php } if ($row['area'] == 'Institucional') { ?>
                                                    <select class="form-control" name="tipo"> 
                                                        <option value="<?php echo $row['area']; ?>"></option>
                                                        <option value="Clínica">Clínica</option>

                                                        <option value="Hospitalar">Hospitalar</option>
                                                    </select>
                                                <?php }if ($row['area'] == 'Hospitalar') { ?>
                                                    <select class="form-control" name="tipo"> 
                                                        <option value="<?php echo $row['area']; ?>"></option>
                                                        <option value="Clínica">Clínica</option>
                                                        <option value="Institucional">Institucional</option>

                                                    </select></p>
                                            <?php }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Código Postal:<?php echo $row['postal']; ?></label>
                                        <div class="col-lg-8">
                                            <p>
                                                <input class="form-control"  id="input1" type='int' name='cpostal1'  maxlength="4" />-<input class="form-control" id="input1" type='int' name='cpostal2'  maxlength="3" />

                                            </p>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Email:</label>
                                        <div class="col-lg-8">
                                            <p> <input class="form-control" type="email" name="iEmail" value="<?php echo $row['mail']; ?>"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Endereço atual:<?php echo $row['address']; ?></label>
                                        <div class="col-md-8">
                                            <p><select class="form-control" name="endereco" id="state" ></select>  
                                                <script language="javascript">
                                                    populateStates("state");
                                                </script></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-8">
                                            <p><input type="submit" name="GuardarI" class="btn btn-danger" value="Guardar">
                                                <span></span>
                                                <input type="reset" class="btn btn-default" value="Cancelar"></p>
                                        </div>
                                    </div>
                                </form>

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <?=
        updateDataI($user);
        ?>
    </div>

    <?php
}

//HTML EDITAR DADOS
function personalDataP($i) {
    ?>
    <?php
    if ($i == 1) {
        $pro = $_SESSION['professional'];
        $date = selectDB(2, $pro);
        $v = 1;
    } if ($i == 3) {
        $pro = $_SESSION['patient'];
        $date = selectDB(3, $pro);
        $v = 3;
    } elseif ($i == 2) {
        $pro = $_SESSION['investigator'];
        $date = selectDB(4, $pro);
        $v = 2;
    }
    ?>
    <h1>Dados</h1>
    <div id="perfis">
        <fieldset>
            <div class="container">

                <hr>
                <div class="row">


                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">



                        <form class="form-horizontal" role="form" method="post">
                            <?php
                            if (mysql_num_rows($date) > 0) {

                                while ($row = mysql_fetch_array($date)) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nome:</label>
                                        <div class="col-lg-8">
                                            <p> <input class="form-control" name="proN" type="text" value="<?php echo $row['name']; ?>"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Número de telefone:</label>
                                        <div class="col-lg-8">
                                            <p>
                                                <input  class="form-control" name="proT" type="int" value="<?php echo $row['phone']; ?>" maxlength="9">
                                            </p>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Código Postal atual:<?php echo $row['postal']; ?></label>
                                        <div class="col-lg-8">
                                            <p>
                                                <input class="form-control"  id="input1" type='int' name='cpostal1'  maxlength="4" />-<input class="form-control" id="input1" type='int' name='cpostal2'  maxlength="3" />

                                            </p>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">NIF:</label>
                                        <div class="col-lg-8">
                                            <p> <input class="form-control" type="text" disabled="" value="<?php echo $row['nif']; ?>"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Email:</label>
                                        <div class="col-lg-8">
                                            <p> <input class="form-control" name="proE" type="email" value="<?php echo $row['email']; ?>"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Endereço atual:<?php echo $row['locality']; ?></label>
                                        <div class="col-md-8">
                                            <p><select class="form-control" name="endereco" id="state" ></select>  
                                                <script language="javascript">
                                                    populateStates("state");
                                                </script></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-8">
                                            <p><input type="submit" class="btn btn-danger" name="GuardarP"  value="Guardar">
                                                <span></span>
                                                <input type="reset" class="btn btn-default" value="Cancelar"></p>
                                        </div>
                                    </div>
                                </form>

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <?=
        updateData($pro, $v);
        ?>
    </div>


    <?php
}

//REGisters
function firstTime() {
    ?>
    <div id="conv">
        <h1>Introduza seus dados</h1>
        <div id="perfis">
            <fieldset>
                <form method="post" >                    
                    <p>Nome:<font color="red" size="2" >*</font></p>
                    <input type="text" name="name" required=""  maxlength="75"><br/>
                    <p>NIF:<font color="red" size="2">*</font></p>                    
                    <input type="int" name="nif" onkeyup="showValidNIF(this.value)" maxlength="9" pattern="[0-9]+$" ><span id="txtValNIF"></span>
                    <p>Data de nascimento:<font color="red" size="2" >*</font></p>
                    <select name="dia" required="">
                        <option>Dia</option>
                        <?php
                        for ($i = 1; $i < 32; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>                
                    </select>
                    <select name="mes" required="">
                        <option>Mês</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                    <select name="ano" required="">
                        <option>Ano</option>
                        <?php
                        for ($i = 2005; $i > 1950; $i--) {
                            echo "<option value=$i>$i</option>";
                        }
                        ?>
                    </select>
                    <p>Habilitações:<font color="red" size="2" >*</font></p>
                    <select name="habilitacao">
                        <option>Escolaridade</option>
                        <option value="4ºano">4º ano de escolaridade</option>
                        <option value="6ºano">6º ano de escolaridade</option>
                        <option value="9ºano">9º ano de escolaridade</option>
                        <option value="12ºano">12º ano de escolaridade</option>
                        <option value="Licenciatura ou superior">Licenciatura ou superior</option>
                        <option value="0">Não possuiu quaisquer habilitações</option>
                    </select>
                    <p>Sexo:<font color="red" size="2" >*</font></p>
                    <p><input type="radio" name="sex" value="Masculino" required="">Masculino
                        <input type="radio" name="sex" value="Feminino" required="">Feminino</p>
                    <p>E-mail:<font color="red" size="2">*</font></p>
                    <input type="email" name="mail" required ><br/><br/>
                    <p>Utilizador:<font color="red" size="2"  maxlength="14" pattern="[A-Z a-z]+$">*</font></p>
                    <input type="text" name="user" required>
                    <input type="submit"  name="guest1"  value="Submeter">
                </form>
                <image src="./img/registov.jpg" style="left: 50%;  margin-left: 309px;  margin-top: -218px;"/>
            </fieldset>
            <?= reg_guest(); ?>
        </div>
    </div>
    <?php
}

function addInvestigator() {
    ?>
    <h1>Registo de Profissional do Núcleo</h1>
    <div id="perfis">
        <fieldset>
            <form method="post"  >
                <p><label>Nome:<font color="red" size="2" >*</font></label></p>
                <input type="text" name="name" required=""  maxlength="75">
                <p><label>Utilizador:<font color="red" size="2" required >*</font></label></p>
                <input type="text" name="user_name" required="" pattern="[A-Z a-z]+$" maxlength="14" >

                <p><label>Data de nascimento:<font color="red" size="2" >*</font></label></p>
                <select name="dia"required="">
                    <option  >Dia</option>
                    <?php
                    for ($i = 1; $i < 32; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>                
                </select>
                <select name="mes" required="">
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
                <select name="ano" required="">
                    <option>Ano</option>
                    <?php
                    for ($i = 1991; $i > 1950; $i--) {
                        echo "<option value=$i>$i</option>";
                    }
                    ?>
                </select>
                <p><label>Sexo:<font color="red" size="2" >*</font></label></p>
                <p><input type="radio" name="sex" value="Masculino" required="">Masculino
                    <input type="radio" name="sex" value="Femino" required="">Feminino</p>
                <p><label>NIF:<font color="red" size="2" >*</font></label></p>
                <input type="int" name="nif" maxlength="9" pattern="[0-9]+$" onkeyup="showValidNIF(this.value)" required=""  ><span id="txtValNIF"></span>
                <p><label>Número cartão de cidadão:<font color="red" size="2" >*</font></label></p>
                <input type="int" name="cc" required="" pattern="[0-9]+$" maxlength="12"  >
                <p><label>E-mail:<font color="red" size="2" >*</font></label></p>
                <input type="email" name="mail" required="">
                <p><label>Telefone:</label></p>
                <input type="int" name="phone" pattern="[0-9]+$" oninvalid="this.setCustomValidity('Insira o número de telemóvel sem indicativo')" maxlength="9">

                <p><label>Morada:<font color="red" size="2" >*</font></label></p>

                <select name="morada" id="state" required=""></select>  
                <script language="javascript">
                    populateStates("state");
                </script>
                <p><label>Código Postal:<font color="red" size="2" >*</font></label></p>
                <input id="input1" type='int' name='cpostal1'  maxlength="4" pattern="[0-9]+$"/>-<input id="input1" type='int' name='cpostal2'  maxlength="3" />



                <input type="submit" name="reg_inv" value="Registar">
            </form>
            <image src="./img/providers.jpg" style="left: 50%;  margin-left: 344px;margin-top: -405px; border-radius: 14px;border: 2px solid #a1a1a1;"/>
        </fieldset>
        <?= reg_investigator(); ?>
    </div><?php
    }

//HTML ADICIONAR TERAPEUTA
    function addProfessional() {
        $nipc = $_SESSION['institution'];
        ?>
    <div id="perfis">
        <h1>Registo de Profissional</h1>
        <fieldset>

            <form method="post" >
                <p><label>Nome:<font color="red" size="2" >*</font></label></p>
                <input type="text" name="nome"  required="" maxlength="75">
                <p><label>Data Nascimento:<font color="red" size="2" >*</font></label></p>
                <select name="dia" required="">
                    <option >Dia</option>
    <?php
    for ($i = 1; $i < 32; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>                
                </select>
                <select name="mes">
                    <option>Mês</option>
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
                <select name="ano">
                    <option>Ano</option>
    <?php
    for ($i = 1991; $i > 1950; $i--) {
        echo "<option value='$i'>$i</option>";
    }
    ?>
                </select>
                <p><label>Sexo:<font color="red" size="2" >*</font></label><input type="radio" value="Masculino" name="sexo" required="">Masculino
                    <input type="radio" value="Feminino" name="sexo" required="">Feminino</p>


                <p><label>Email:<font color="red" size="2" >*</font></label></p>
                <input type="email" name="mail" placeholder="" required="">
                <p><label>Telefone:</label></p>
                <input type="int" name="phone" pattern="[0-9]+$" oninvalid="this.setCustomValidity('Insira o número de telemóvel sem indicativo')" maxlength="9"  >
                <p><label>Morada:</label></p>

                <select name="morada" id="state" required=""></select>  
                <script language="javascript">
                    populateStates("state");
                </script>
                <p><label>Código Postal:<font color="red" size="2" >*</font></label></p>
                <input id="input1" type='int' name='cpostal1'  maxlength="4" pattern="[0-9]+$"/>-<input id="input1" type='int' name='cpostal2' pattern="[0-9]+$" maxlength="3" />


                <p><label>Número de cartão de cidadão :<font color="red" size="2" >*</font></label></p>
                <input type="int" name="bi" required="" pattern="[0-9]+$" maxlength="9" >
                <p><label>NIF:<font color="red" size="2" >*</font></label></p>
                <input type="int" name="nif" maxlength="9" onkeyup="showValidNIF(this.value)" required="" pattern="[0-9]+$"><span id="txtValNIF"></span>
                <p><label>Utilizador:<font color="red" size="2" >*</font></label></p>
                <input type="text" name="user" required="" maxlength="14" pattern="[A-Z a-z]+$">
                <input type="submit" name="registar" value="Registar">
            </form>
            <image src="./img/pro.jpg" style="left: 50%;  margin-left: 340px;margin-top: -313px;border-radius: 14px;border: 2px solid #a1a1a1;"/>
        </fieldset>
    <?=
    registerDoctor($nipc);
    ?>
    </div>
        <?php
    }

//ADD PAcient
    function addPatient() {
        ?>
    <div id="perfis">
        <h1>Registo de Paciente</h1>
        <fieldset>

            <form method="post"  class="form-inline">
                <p><label>Nome:<font color="red" size="2" >*</font></label></p>
                <input type="text" name="nome" placeholder="Nome"  required="" maxlength="75">
                <p><label>Data Nascimento:<font color="red" size="2" >*</font></label></p>
                <select name="dia"required="">
                    <option >Dia:</option>
    <?php
    for ($i = 1; $i < 32; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>                
                </select>
                <select name="mes"required="">
                    <option>Mês:</option>
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
                <select name="ano" required="">
                    <option>Ano:</option>
    <?php
    for ($i = 2005; $i > 1950; $i--) {
        echo "<option value='$i'>$i</option>";
    }
    ?>
                </select>
                <label><p>Permissão de gerência de dados:</p>
                    <p><input type="radio" value="0" name="dataP">Sim 
                        <input type="radio" value="1" name="dataP">Não</p></label>
                <p>Habilitações:<font color="red" size="2" >*</font></p>
                <select name="habilitacao" required="">
                    <option>Escolaridade</option>
                    <option value="4ºano">4º ano de escolaridade</option>
                    <option value="6ºano">6º ano de escolaridade</option>
                    <option value="9ºano">9º ano de escolaridade</option>
                    <option value="12ºano">12º ano de escolaridade</option>
                    <option value="Licenciatura ou superior">Licenciatura ou superior</option>
                    <option value="0">Não possuiu quaisquer habilitações</option>
                </select>

                <p><label>Sexo:<font color="red" size="2" >*</font></label></p>
                <p><input type="radio" value="Masculino" name="sexo">Masculino
                    <input type="radio" value="Feminino" name="sexo">Feminino</p>
                <p><label>Morada:</label></p>
                <select name="state" id="state" required=""></select>  

                <script language="javascript">
                    populateStates("state");
                </script>
                <p><label>Código Postal:<font color="red" size="2" >*</font></label></p>
                <input id="input1" type='int' name='cpostal1' pattern="[0-9]+$"  maxlength="4" />-<input id="input1" type='int' name='cpostal2' pattern="[0-9]+$" maxlength="3" />
                <p><label>Telefone:<font color="red" size="2" >*</font></label></p>
                <input type="int" name="phone" pattern="[0-9]+$" oninvalid="this.setCustomValidity('Insira o número de telemóvel sem indicativo')" maxlength="9">
                <p><label>Email:<font color="red" size="2" >*</font></label></p>
                <input type="email" name="mail" placeholder="email@hotmail.com">
                <p><label>Número de cartão de cidadão:<font color="red" size="2" >*</font> </label></p>
                <input type="text" name="bi" placeholder="C.C" pattern="[0-9]+$" required="" maxlength="9">
                <p><label>NIF:<font color="red" size="2" >*</font></label></p>
                <input type="int" name="nif" onkeyup="showValidNIF(this.value)" required="" pattern="[0-9]+$" maxlength="9" ><span id="txtValNIF"></span>

                <p> <label><input type="submit" name="regP" value="Registar"></label></p>
            </form>  
            <image src="./img/paciente.jpg" style="left: 50%;  margin-left: 330px;
                   margin-top: -384px; border-radius: 9px;
                   border: 2px solid #A66348;"/>
        </fieldset>
    <?php
    $inst = $_SESSION['institution'];
    $pro = $_SESSION['professional'];
    regPatient($inst, $pro);
    ?>
    </div>
        <?php
    }

//REGISTER INSTITUITION
    function addInstituition() {
        ?>
    <h1>Registo de Instituições</h1>
    <div id="perfis">
        <fieldset>

            <form method="post" >
                <p><label>Nome:<font color="red" size="2" >*</font></label></p>
                <input type="text" name="nome" required=""  maxlength="75">
                <p><label>NIPC:<font color="red" size="2" >*</font></label></p>
                <input type="int" name="nipc"  onkeyup="showValidNIF(this.value)" maxlength="9" pattern="[0-9]+$" /><span id="txtValNIF"></span>
                <p><label>Username:<font color="red" size="2" >*</font></label></p>
                <input type="text" name="username" required="" pattern="[A-Z a-z]+$" maxlength="14" >
                <p><label>Área:<font color="red" size="2" >*</font></label></p>
                <select name="tipo" required=""> 
                    <option value="Institucional">Institucional</option>
                    <option value="Clínica">Clinica</option>
                    <option value="Hospitalar">Hospitalar</option>
                </select>
                <p><label>Morada:<font color="red" size="2">*</font></label></p>

                <select name="endereco" id="state" required=""></select>  
                <script language="javascript">
                    populateStates("state");
                </script>
                <p><label>Código Postal:<font color="red" size="2" >*</font></label></p>
                <input id="input1" type='int' name='cpostal1'  maxlength="4" pattern="[0-9]+$"/>-<input id="input1" type='int' name='cpostal2' pattern="[0-9]+$" maxlength="3" />

                <p><label>Email:<font color="red" size="2" >*</font></label></p>
                <input type="email" name="mail" required="">
                <input type="submit" name="registarI" value="Registar">
            </form>
        </fieldset>
    <?= registerInstituition(); ?>
    </div>
        <?php
    }

//HTML_ADICIONAR EXERCICIO
    function addExercise() {
        ?>  
    <div id="perfis">
        <h1>Registo de Exercício</h1>
        <fieldset>
            <form method="post" >                              
                <p><label>Nome:</label></p>
                <input type="text" name="lname">
                <p><label>Descrição:</label></p>
                <input type="text" name="lD">
                <p><label>Tarefa:</label></p>
                <input type="text" name="lTarefa">

                <p>
                    <label> Estrutura: 
                        <select name="structure"> 
    <?php
    $patient = listStructure();
    while ($row = mysql_fetch_array($patient)) {
        ?>
                                <option value="<?= $row['title'] ?>"><?= $row['title'] ?></option>

        <?php
    }
    ?>      

                        </select>
                    </label></p>
                <p>
                    <label> Nível: 
                        <select name="nivel"> 
                            <option value="1">Nível dificuldade baixo</option>
                            <option value="2">Nível dificuldade médio</option>
                            <option value="3">Nível dificuldade alto</option>
                        </select>
                    </label></p>

                <input type="submit" name="addExerc" value="Adicionar">
            </form>
            <image src="http://skillsgym.pt/sites/all/files/imagens/paginas/programa-de-desenvolvimento-cognitivo.jpg" style="left: 50%;margin-left: 525px;margin-top: -363px;"/>

        </fieldset>
    <?= regExercise(); ?>
    </div>

    <?php
}

//Adicionar Patologia
function addPathology() {
    ?>
    <div id="perfis">
        <h1>Registo de Patologias</h1>
        <fieldset>
            <form method="post">                              

                <p><label>Nome:</label></p>
                <input type="text" name="Pname" pattern="[A-Z a-z]+$" maxlength="75" >




                <input type="submit" name="addPat" value="Adicionar">
            </form>
            <image src="./img/pathology.jpg" style="left: 50%;margin-left: 410px;margin-top: -90px;border-radius: 6px;"/>
        </fieldset>
    <?php
    if (isset($_POST['addPat'])) {
        $Pname = $_POST['Pname'];
        $con = connect();


        $sql = "Insert into pathology (name)values('$Pname')";

        if (($query = mysql_query($sql, $con)) === TRUE) {
            ?><script>alertify.alert("Patologia registada com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Patologia não foi registada.", function () {
                            alertify.message('OK');
                        });</script><?php
            mysql_error($con);
        }

        mysql_close($con);
    }
    ?>  </div>
        <?php
        }

        function createSession() {
            ?>

    <h1>Criar Sessão</h1>
    <div id="perfis">
        <fieldset>
            <form method="post"><br>
                <p>
                    <label for="patient">Paciente:<font color="red" size="2" >*</font></label>

                    <select required="" name="patient">
                        <option >Escolha um Paciente</option>
    <?php
    $patient = listPatient(3, $_SESSION['professional']);
    while ($row = mysql_fetch_array($patient)) {
        ?>
                            <option value="<?= $row['nif'] ?>"><?= $row['name'] ?></option>

        <?php
    }
    ?>       
                    </select>
                </p>
                <br><br>
                <p>
                    <label for="exercise">Exercício:<font color="red" size="2" >*</font></label>
                    <select required name="exercise">

                        <option>Escolha um Exercício</option>
    <?php
    $exercise = listExercise(1);
    while ($row = mysql_fetch_array($exercise)) {
        ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>

        <?php
    }
    ?>       
                    </select>
                </p>
                <br><br>
                <br><br>
                <p><label>Data Limite:<font color="red" size="2" >*</font></label></p>
                <select required=""name="dia">
                    <option >Dia</option>
    <?php
    for ($i = 1; $i < 32; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>                
                </select>
                <select required name="mes">
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
                <select required name="ano">
                    <option>Ano</option>
    <?php
    for ($i = 2020; $i > 2014; $i--) {
        echo "<option value=$i>$i</option>";
    }
    ?>
                </select><br><br>
                <input type="submit" name="reg_sess" value="Criar Sessão">
            </form>
            <image src="./img/session.jpg" style="left: 50%;  margin-left: 309px;margin-top: -420px; width:300; height:280 "/>
        </fieldset>
    </div>

    <?php
    regSession();
}

function checkResults($nif) {
    ?>
    <form method="post">

        <table class="table" onclick="">
    <?php
    $connect = connect();
    $exer = "SELECT * FROM answer where patient_nif='$nif'" or die(mysql_error());
    $query_i = mysql_query($exer, $connect) or die(mysql_error());
    ?>
            <tr>
                <th>Data</th> 
                <th>Tempo</th>
                <th>Respostas Erradas</th>

            </tr>
    <?php
    if (mysql_num_rows($query_i) > 0) {


        while ($row4 = mysql_fetch_array($query_i)) {
            ?>

                    <tr class="toggle">
                        <td><?php echo $row4['date'] ?> </td>
                        <td><?php echo $row4['time'] ?> </td>
                        <td><?php echo $row4['wrong_answer'] ?> </td>

                    </tr>


            <?php
        }
    }
    ?> </table></form><?php
        }

//SEt pathology to patient
        function setPathology() {
            ?>
    <h1>Atribuir Patologia</h1>
    <form method="post">
        <p><label>Paciente:<font color="red" size="2" >*</font></label></p>
        <select required="" name="paciente">
    <?php
    $pat = listPatient(3, $_SESSION['professional']);
    while ($row1 = mysql_fetch_array($pat)) {
        ?>
                <option value="<?= $row1['nif'] ?>"><?= $row1['name'] ?></option>
                <?php
            }
            ?> 
        </select>
        <p><label>Patologia:<font color="red" size="2" >*</font></label></p>
        <select required="" name="pat">
    <?php
    $pat = listPathology();
    while ($row1 = mysql_fetch_array($pat)) {
        ?>
                <option value="<?= $row1['name'] ?>"><?= $row1['name'] ?></option>
                <?php
            }
            ?> 
        </select>
        <input type="submit" value="Adicionar" name="patPatient" class="btn-danger">
    </form>
    <?= patientPathology(); ?>
    <?php
}

//Remove Pathology from Patient
function removePathology() {
    ?>
    <form method="post">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Patologia</th>
                        <th>Opção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
    <?php
    $ligacao = connect();
    $pathology = "SELECT Pa.name, P.pathology_name, P.patient_code
                                  FROM patient_has_pathology P, patient Pa
                                  WHERE Pa.nif = P.patient_code" or die(mysql_error());
    $pathology_query = mysql_query($pathology, $ligacao) or die(mysql_error());
    while ($row = mysql_fetch_array($pathology_query)) {
        $nif = $row['patient_code'];
        echo '<td>' . $row["name"] . '</td>';
        echo '<td>' . $row["pathology_name"] . '</td>';
        echo '<td><form method="POST"><button type="submit" name="elimina"><span class="icon-pencil" title="Remover"></button></span></form></td>';
    }
    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
    if (isset($_POST['elimina'])) {
        remove_path($nif);
    }
}

//Report Consulting
function reportList() {
    ?>
    <h1>Consulte um Relatório</h1>
    <form>
        <p><label>Nome do Paciente:<font color="red" size="2" >*</font></label></p>
        <select required name="paciente">
    <?php
    $pat = listPatient();
    while ($row1 = mysql_fetch_array($pat)) {
        ?>
                <option value="<?= $row1['name'] ?>"><?= $row1['name'] ?></option>
                <?php
            }
            ?>       
        </select>
        <p><label>Template do Relatório:<font color="red" size="2" >*</font></label></p>
        <select required name="template">
            <option>Gráficos</option>
            <option>Tabelas</option>
        </select>
        <p><label>Dominio:<font color="red" size="2" >*</font></label></p>
        <select required name="dominio">
    <?php
    $pat = listDomain();
    while ($row2 = mysql_fetch_array($pat)) {
        ?>
                <option value="<?= $row2['name'] ?>"><?= $row2['name'] ?></option>
                <?php
            }
            ?>       
        </select>
        <p><label>Data de Inicio:<font color="red" size="2" >*</font></label></p>
        <select required=""name="dia">
            <option >Dia</option>
    <?php
    for ($i = 1; $i < 32; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>                
        </select>
        <select required name="mes">
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <select required name="ano">
            <option>Ano</option>
    <?php
    for ($i = 1997; $i > 1900; $i--) {
        echo "<option value=$i>$i</option>";
    }
    ?>
        </select><br>
        <p><label>Data Limite:<font color="red" size="2" >*</font></label></p>
        <select required=""name="dia">
            <option >Dia</option>
    <?php
    for ($i = 1; $i < 32; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>                
        </select>
        <select required name="mes">
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <select required name="ano">
            <option>Ano</option>
    <?php
    for ($i = 1997; $i > 1900; $i--) {
        echo "<option value=$i>$i</option>";
    }
    ?>
        </select><br>
        <input type="submit" value="Consultar">
        <image src="http://www.ebc.com.br/sites/default/files/icon_relatorio.jpg" width="350" height="250" style="margin-right: 100px; margin-top: -370px; float:right"/>

    </form>
    <?php
}

//REGISTER domain
function addDomain() {
    ?>
    <h1>Registo de Domínio</h1>
    <div id="perfis">
        <fieldset>

            <form method="post">
                <p><label>Nome:</label></p>
                <input type="text" name="name" required="">
                <p><label>Descrição:</label></p>
                <input type="text" name="description">
                <br><br><input type="submit" name="addDomain" value="Registar">
            </form>
        </fieldset>
    <?= regDomain(); ?>
    </div>
        <?php
    }

//PAtient List
    function patientList() {
        ?>


    <table class="table" >
    <?php
    $connect = connect();
    $users = "SELECT * FROM user WHERE patient_nif IS NOT NULL" or die(mysql_error());

    $pat = "SELECT * FROM patient where professional_nif='$_SESSION[professional]'"or die(mysql_error());
    $query_u = mysql_query($users, $connect) or die(mysql_error());
    $query_i = mysql_query($pat, $connect) or die(mysql_error());
    ?>
        <tr>
            <th class="clickable1" >Nome</th> 
            <th>Telefone</th>
            <th>Email</th>
            <th>Habilitações</th>
            <th>Estado</th>


        </tr>
    <?php
    if ((mysql_num_rows($query_u) > 0) && (mysql_num_rows($query_i) > 0)) {


        while (($row3 = mysql_fetch_array($query_u)) && ($row4 = mysql_fetch_array($query_i))) {
            ?>

                <tr class="toggle">
                    <td><?php echo $row4['name'] ?> </td>
                    <td><?php echo $row4['phone'] ?> </td>
                    <td><?php echo $row4['email'] ?> </td>
                    <td><?php echo $row4['qualifications'] ?> </td>

                    <td><?php
            if ($row3['checked'] === 1) {
                echo "Ativado";
            } else {
                echo "Bloqueado";
            }
            ?></td>
                </tr>


            <?php
        }
    }
    ?> </table><?php
    }

//HTML DE LISTA DE PROFISSIONAIS DE SAÙDE
    function professionalList() {
        ?>

    <table class="table" onclick="">
        <tr>
            <th class="clickable1" >Nome</th>
            <th>NIF</th>
            <th>Cartão Cidadão</th>
            <th>Morada</th>
            <th>E-mail</th>
        </tr>
    <?php
    $code = $_SESSION['institution'];
    $ligacao = connect();
    $expressao = "SELECT * FROM professional where institution_nipc='$code'" or die(mysql_error());
    $query = mysql_query($expressao, $ligacao);
    while ($row = mysql_fetch_array($query)) {
        $nif = $row['nif'];
        $card = $row['id_card'];
        $localidade = $row['locality'];
        $nome = $row['name'];
        $mail = $row['mail'];
        ?>
            <tr class="toggle">
                <td><?= $nome ?></td>
                <td><?= $nif ?></td>
                <td><?= $card ?></td>
                <td><?= $localidade ?></td>
                <td><?= $mail ?></td>
            </tr>

    <?php } ?>
    </table>
        <?php
    }
    ?>
<?php

function instituicaoList() {
    ?>


    <table class="table" onclick="">
    <?php
    $connect = connect();
    $users = "SELECT * FROM user WHERE institution_nipc IS NOT NULL" or die(mysql_error());
    $insti = "SELECT * FROM institution"or die(mysql_error());
    $query_u = mysql_query($users, $connect) or die(mysql_error());
    $query_i = mysql_query($insti, $connect) or die(mysql_error());
    ?>
        <tr>
            <th class="clickable1" >Nome</th> 
            <th>Área</th>
            <th>Morada</th>
            <th>Email</th>
            <th>Acesso</th>

        </tr>
    <?php
    if ((mysql_num_rows($query_u) > 0 ) && (mysql_num_rows($query_i) > 0)) {


        while (($linha = mysql_fetch_array($query_u)) && ($row = mysql_fetch_array($query_i))) {
            ?>

                <tr class="toggle">
                    <td><?php echo $row['name'] ?> </td>
                    <td><?php echo $row['area'] ?> </td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['mail'] ?> </td>


                    <td> <?php
            if ($linha['checked'] == 1) {
                echo "Ativado";
            } else {
                echo "Bloqueado";
            }
            ?></td>
                </tr>


            <?php
        }
    }
    ?> </table><?php
    }

//Investigators list
    function investigatorList() {
        ?>
    <table class="table">
        <tr>
            <th class="clickable1" >Nome</th>
            <th>NIF</th>
            <th>Cartão Cidadão</th>
            <th>Localidade</th>
            <th>E-mail</th>
            <th>Acesso</th>
        </tr>
    <?php
    $ligacao = connect();
    $expressao_inv = "SELECT * FROM investigator" or die(mysql_error());
    $query = mysql_query($expressao_inv, $ligacao);
    $expressao_usr = "SELECT * FROM user WHERE investigator_nif IS NOT NULL" or die(mysql_error());
    $query_usr = mysql_query($expressao_usr, $ligacao) or die(mysql_error());
    if ((mysql_num_rows($query) > 0) && (mysql_num_rows($query_usr) > 0)) {
        while (($linha = mysql_fetch_array($query_usr)) && ($row = mysql_fetch_array($query))) {
            ?>
                <tr class="toggle">
                    <td><?= $row['name'] ?> </td>
                    <td><?= $row['nif'] ?> </td>
                    <td><?= $row['id_card'] ?></td>
                    <td><?= $row['locality'] ?></td>
                    <td><?= $row['mail'] ?> </td>
                    <td>
            <?php
            if ($linha['checked'] == 1) {
                echo "Ativado";
            } else {
                echo "Bloqueado";
            }
            ?>
                    </td>
                </tr>
            <?php
        }
    }
    ?>
    </table>
        <?php
    }

//Recupera password
    function forgot() {
        ?><div id="conv">
        <h1>Recupere a sua password</h1>
        <div id="perfis">

            <p>Digite o seu nome de utilizador e o email associado a conta</p>
            <fieldset >
                <legend><img src="./img/askMark.jpg" width="71px" height="70px" style="
                             margin-left: 667px;
                             margin-top: -36px;
                             "></legend>
                <form class="form-inline" role="form" method="POST">
                    Utilizador<font color="red" size="2" >*</font>:<input class="fundoesquecida" type="text" name="utilizador" style="
                                                                          margin-left: 5px;
                                                                          margin-top: 10px;
                                                                          "><br><br>
                    NIF<font color="red" size="2" >*</font>:<input class="fundoesquecida" type="text" name="nif" id="nifrecupera" style="
                                                                   margin-left: 50px;
                                                                   margin-top: 9px;
                                                                   "><br><br>
                    Email<font color="red" size="2" >*</font>:<input type="email" name="email" class="fundoesquecida" id="emailrecupera" style="
                                                                     margin-left: 35px;
                                                                     margin-top: 5px;
                                                                     "><br><br>
                    <input type="submit" name="esquece" value="Enviar">
                </form>
            </fieldset>
        </div>
    </div>
    <?php
    $comp = filter_input(INPUT_POST, 'esquece', FILTER_SANITIZE_STRING);
    if (isset($comp)) {
        $num_if = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_STRING);
        $user = filter_input(INPUT_POST, 'utilizador', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);


        $ligacao = connect();

        $querycompara = ("SELECT * FROM user") or die(mysql_error());

        //$querycompara = ("SELECT * FROM user Where investigator_nif=nif  or patient_nif=nif or guest_nif=nif or professional_nif=nif or institution_nipc =nif") or die(mysql_error());
        $query = mysql_query($querycompara, $ligacao) or die(mysql_error());
        while ($linha = mysql_fetch_array($query)) {
            $nome = $linha['username'];
            $instituicao = $linha['institution_nipc'];
            $profissional = $linha['professional_nif'];
            $guest = $linha['guest_id'];
            $investigador = $linha['investigator_nif'];
            $paciente = $linha['patient_nif'];
            $utilizador = $linha['username'];
            $titulo = 'Recuperação da Password';
            if (!($instituicao == '') && ($instituicao == $num_if) && ($utilizador == $user)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$user' and institution_nipc='$num_if'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                $mensagem = '<p>Aqui estão os novos dados da sua conta:<br/> User: ' . $nome . '<br/> Pass: ' . $pass . '</p> ';
                email($email, $user, $pass, $mensagem, $titulo);
            } elseif (!($profissional == '') && ($profissional == $num_if) && ($utilizador == $user)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$user' and professional_nif='$num_if'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                $mensagem = '<p>Aqui estão os novos dados da sua conta:<br/> User: ' . $nome . '<br/> Pass: ' . $pass . '</p> ';
                email($email, $user, $pass, $mensagem, $titulo);
            } elseif (!($investigador == '') && ($investigador == $num_if) && ($utilizador == $user)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$user' and investigator_nif='$num_if'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                $mensagem = '<p>Aqui estão os novos dados da sua conta:<br/> User: ' . $nome . '<br/> Pass: ' . $pass . '</p> ';
                email($email, $user, $pass, $mensagem, $titulo);
            } elseif (!($paciente == '') && ($paciente == $num_if) && ($utilizador == $user)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$user' and patient_nif='$num_if'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                $mensagem = '<p>Aqui estão os novos dados da sua conta:<br/> User: ' . $nome . '<br/> Pass: ' . $pass . '</p> ';
                email($email, $user, $pass, $mensagem, $titulo);
            } elseif (!($guest == '') && ($guest == $num_if) && ($utilizador == $user)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$user' and guest_id='$num_if'" or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                $mensagem = '<p>Aqui estão os novos dados da sua conta:<br/> User: ' . $nome . '<br/> Pass: ' . $pass . '</p> ';
                email($email, $user, $pass, $mensagem, $titulo);
            }
        }
        mysql_close($ligacao);
    }
}

function exerciseList() {
    ?>


    <table class="table" >
    <?php
    $connect = connect();
    $exer = "SELECT * FROM exercise" or die(mysql_error());
    $query_i = mysql_query($exer, $connect) or die(mysql_error());
    ?>
        <tr>
            <th class="clickable1" >Nome</th> 
            <th>Dominio</th>
            <th>Estrutura</th>
            <th>Descrição</th>

        </tr>
    <?php
    if (mysql_num_rows($query_i) > 0) {


        while ($row4 = mysql_fetch_array($query_i)) {
            ?>

                <tr class="toggle">
                    <td><?php echo $row4['name'] ?> </td>
                    <td><?php echo $row4['domain_name'] ?> </td>
                    <td><?php echo $row4['structure_title'] ?> </td>
                    <td><?php echo $row4['description'] ?> </td>

                </tr>


            <?php
        }
    }
    ?> </table><?php
        mysql_close($connect);
    }
    