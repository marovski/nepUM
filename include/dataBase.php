<?php
require_once 'mysql.connect.php';
require_once './phpmailer/PHPMailerAutoload.php';

//COnnect DataBase
function connect() {
    $conexao = mysql_connect(MYSQL_SERVER, MYSQL_USERNAME, MYSQL_PASSWORD);
    mysql_select_db(MYSQL_DATABASE, $conexao) or die(mysql_error());
    return $conexao;
}

//Atribuir Password Aleatório    
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

//Select patient permission
function selectPermission($i) {

    $connect = connect();
    $users = "SELECT * FROM patient WHERE nif = '$i'" or die(mysql_error());
    $query_u = mysql_query($users, $connect) or die(mysql_error());
    $row = mysql_fetch_array($query_u);
    $selected = $row['personal_data'];


    mysql_close($connect);
    return $selected;
}

//SELECT DATABASE Institution
function selectDB($t, $i) {
    if ($t == 1) {
        $table = 'institution';
        $nif = 'nipc';
    } elseif ($t == 2) {
        $table = 'professional';
        $nif = 'nif';
    } elseif ($t == 3) {
        $table = 'patient';
        $nif = 'nif';
    } elseif ($t == 4) {
        $table = 'investigator';
        $nif = 'nif';
    }
    $connect = connect();
    $users = "SELECT * FROM $table WHERE $nif = '$i'" or die(mysql_error());
    $query_u = mysql_query($users, $connect) or die(mysql_error());

    $selected = $query_u;


    mysql_close($connect);
    return $selected;
}

//VALIDAte UTILIZADOR
function valid_user($username, $password) {


    $ligacao = connect();
    $expressao = "SELECT * FROM user WHERE username='$username' AND pass='$password'" or die(mysql_error());

    $resultado = mysql_query($expressao, $ligacao);
    $valor_retorno = false;

    if (mysql_num_rows($resultado) === 1) {
        $dados = mysql_fetch_array($resultado);
        if ($dados['pass'] == $password) {
            $valor_retorno = $dados;
        }
    }


    mysql_close($ligacao);

    return $valor_retorno;
}

//login function
function login() {

    $in = filter_input(INPUT_POST, 'in', FILTER_SANITIZE_STRING);
    if (isset($in)) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $dados = valid_user($username, md5($password));



        if ($dados) {

            session_start();

            $valido = TRUE;
            $_SESSION['level'] = $dados['user_level'];
            $_SESSION['id'] = $dados['code'];
            $_SESSION['acess'] = $dados['checked'];
            $_SESSION['first'] = $dados['acess'];
            $_SESSION['username'] = $dados['username'];
            $_SESSION['checked'] = $dados['checked'];
            $_SESSION['institution'] = $dados['institution_nipc'];
            $_SESSION['professional'] = $dados['professional_nif'];
            $_SESSION['patient'] = $dados['patient_nif'];
            $_SESSION['guest'] = $dados['guest_id'];
            $_SESSION['investigator'] = $dados['investigator_nif'];

            if ($valido == TRUE) {

                echo'<script>alert("Seja bem vindo a plataforma NEP Uminho ")</script>';
                redirecionar();
            }
        } else {

            $valido = FALSE;
            if ($valido == FALSE) {
                ?><script>alert('Dados incorretos! Volte a tentar!');
                </script><?php
            }
        }
    }
}

//Redirect Function
function redirecionar() {

    if (($_SESSION['level']) == 2) {

        header('Location: ./institution.php', TRUE, 302);
    } else if (($_SESSION['level']) == 3) {
        header('Location: ./professional.php', TRUE, 302);
    } else if (($_SESSION['level']) == 4) {
        header('Location: ./patient.php', TRUE, 302);
    } else if (($_SESSION['level']) == 6) {
        header('Location: ./guest.php', TRUE, 302);
    } else if (($_SESSION['level']) == 1) {
        header('Location: ./admin.php', TRUE, 302);
    } else if (($_SESSION['level']) == 5) {
        header('Location: ./professionalN.php', TRUE, 302);
    }
}

//register guest
function reg_guest() {
    $regG = filter_input(INPUT_POST, 'guest1', FILTER_SANITIZE_STRING);
    if (isset($regG)) {
        $nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        $escola = filter_input(INPUT_POST, 'habilitacao', FILTER_SANITIZE_STRIPPED);
        $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_STRING);
        $mes = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
        $pass = randomPassword();
        $pass_encrypt = md5($pass);
        $ligacao = connect();
        $expression_guest = "INSERT INTO guest (name, email, date_birth, gender, academic_qual) "
                . "VALUES ('$nome','$mail','$ano-$mes-$dia','$sex','$escola')" or die(mysql_error());
        $query_guest = mysql_query($expression_guest, $ligacao);

        $line_guest = "SELECT * FROM guest WHERE email='$mail'" or die(mysql_error());
        $linhas = mysql_query($line_guest, $ligacao) or die(mysql_error());
        $row = mysql_fetch_array($linhas);
        $id = $row['id'];

        $expression_insert = "INSERT INTO user (username, pass, guest_id, user_level, checked) VALUES ('$username','$pass_encrypt','$id', 6, 1)" or die(mysql_error());
        $query = mysql_query($expression_insert, $ligacao) or die(mysql_error());
        if ((($query_guest) && ($query)) == TRUE) {
            $mensagem = '<p>Aqui estão os dados da sua conta:<br/> User: ' . $username . '<br/> Pass: ' . $pass . '</p> ';
            $titulo = 'Registo';
            email($mail, $nome, $pass, $mensagem, $titulo);
            ?><script>alertify.alert("Registado com sucesso.", function () {
                    alertify.message('OK');
                });</script><?php
        } else {
            ?><script>alertify.alert("Registo sem sucesso,volte a inserir os dados!", function () {
                        alertify.message('OK');
                    });</script><?php
        }
        mysql_close($ligacao);
    }
}

//Register Institution
function registerInstituition() {
    $regI = filter_input(INPUT_POST, 'registarI', FILTER_SANITIZE_STRING);
    if (isset($regI)) {

        $nome = mysql_real_escape_string(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
        $username = mysql_escape_string(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $nipc = mysql_escape_string(filter_input(INPUT_POST, 'nipc', FILTER_SANITIZE_STRING));
        $endereco = mysql_escape_string(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING));
        $mail = mysql_escape_string(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING));
        $tipo = mysql_escape_string(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING));
        $postal1 = mysql_escape_string(filter_input(INPUT_POST, 'cpostal1', FILTER_SANITIZE_STRING));
        $postal2 = mysql_escape_string(filter_input(INPUT_POST, 'cpostal2', FILTER_SANITIZE_STRING));

        $pass = randomPassword();
        $pass_encrypt = md5($pass);



        $ligacao = connect();
        $expressao_inst = "INSERT INTO institution (nipc, name, address, area, mail,postal) "
                . "VALUES ('$nipc','$nome', '$endereco', '$tipo', '$mail','$postal1-$postal2')" or die(mysql_error());
        $query_inst = mysql_query($expressao_inst, $ligacao);

        $expressao_user = "INSERT INTO user (username, pass, institution_nipc,checked,user_level) "
                . "VALUES ('$username', '$pass_encrypt', '$nipc',1,2)" or die(mysql_error());
        $query_user = mysql_query($expressao_user, $ligacao) or die(mysql_error());
        if ((($query_inst) && ($query_user)) == TRUE) {
            $mensagem = '<p>Aqui estão os dados da sua conta:<br/> User: ' . $username . '<br/> Pass: ' . $pass . '</p> ';
            $titulo = 'Registo';
            email($mail, $nome, $pass, $mensagem, $titulo);
            ?><script>alertify.alert("Instituição registado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Registo sem sucesso,volte a inserir os dados!", function () {
                        alertify.message('OK');
                    });</script><?php
        }


        mysql_close($ligacao);
    }
}

//Registar Profissional
function registerDoctor($nipcI) {
    $regD = filter_input(INPUT_POST, 'registar', FILTER_SANITIZE_STRING);
    if (isset($regD)) {
        $nomeD = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_STRING);
        $mes = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
        $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);

        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        $num_bi = filter_input(INPUT_POST, 'bi', FILTER_SANITIZE_STRING);
        $nif = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_STRING);
        $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);
        $postal1 = mysql_escape_string(filter_input(INPUT_POST, 'cpostal1', FILTER_SANITIZE_STRING));
        $postal2 = mysql_escape_string(filter_input(INPUT_POST, 'cpostal2', FILTER_SANITIZE_STRING));
        $phone = mysql_escape_string(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
        $pass = randomPassword();
        $pass_encrypt = md5($pass);


        $ligacao = connect();

        $expressao_nuc = "INSERT INTO professional (nif, date_of_birth, gender, locality, mail, name, institution_nipc, id_card,postal,phone) "
                . "VALUES ('$nif','$ano-$mes-$dia', '$sexo', '$morada', '$mail', '$nomeD', '$nipcI', '$num_bi',$postal1-$postal2,'$phone')" or die(mysql_error());
        $query_nuc = mysql_query($expressao_nuc, $ligacao) or die(mysql_error());
        $expressao_user = "INSERT INTO user (username, pass, professional_nif,institution_nipc,checked,user_level) VALUES ('$user', '$pass_encrypt', '$nif','$nipcI',1,3)" or die(mysql_error());
        $query_user = mysql_query($expressao_user, $ligacao);
        if ((($query_nuc) && ($query_user)) == TRUE) {
            $mensagem = '<p>Aqui estão os dados da sua conta:<br/> User: ' . $user . '<br/> Pass: ' . $pass . '</p> ';
            $titulo = 'Registo';
            email($mail, $user, $pass, $mensagem, $titulo);
            ?><script>alertify.alert("Professional registado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Registo sem sucesso,volte a inserir os dados!", function () {
                        alertify.message('OK');
                    });</script><?php
        }
        mysql_close($ligacao);
    }
}

//Register nep collaborator
function reg_investigator() {
    $inv = filter_input(INPUT_POST, 'reg_inv', FILTER_SANITIZE_STRING);
    if (isset($inv)) {
        $nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_STRING);
        $mes = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
        $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);
        $cidadao = filter_input(INPUT_POST, 'cc', FILTER_SANITIZE_STRING);
        $nif_inv = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);
        $user = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
        $postal1 = mysql_escape_string(filter_input(INPUT_POST, 'cpostal1', FILTER_SANITIZE_STRING));
        $postal2 = mysql_escape_string(filter_input(INPUT_POST, 'cpostal2', FILTER_SANITIZE_STRING));
        $phone = mysql_escape_string(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
        $pass = randomPassword();
        $pass_encripta = md5($pass);
        $ligacao = connect();

        $expressao_prof = "INSERT INTO investigator (nif, id_card, name, date_of_birth, locality, gender, mail,phone,postal) "
                . "VALUES ('$nif_inv','$cidadao','$nome','$ano-$mes-$dia','$morada','$sex','$mail','$phone','$postal1-$postal2')" or die(mysql_error());
        $query = mysql_query($expressao_prof, $ligacao) or die(mysql_error());

        $expressao_user = "INSERT INTO user (username, pass, investigator_nif,checked,user_level) VALUES ('$user','$pass_encripta','$nif_inv',1,5)" or die(mysql_error());
        $query_user = mysql_query($expressao_user, $ligacao);
        if ((($query) && ($query_user)) == TRUE) {
            $mensagem = '<p>Aqui estão os dados da sua conta:<br/> User: ' . $user . '<br/> Pass: ' . $pass . '</p> ';
            $titulo = 'Registo';
            email($mail, $nome, $pass, $mensagem, $titulo);
            ?><script>alertify.alert("Professional de Núcleo registado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Registo sem sucesso,volte a inserir os dados!", function () {
                        alertify.message('OK');
                    });</script><?php
        }
        mysql_free_result($expressao_user);
        mysql_free_result($expressao_prof);
        mysql_close($ligacao);
    }
}

//Register Pacient
function regPatient($i, $pro) {
    $reg = filter_input(INPUT_POST, 'regP', FILTER_SANITIZE_STRING);
    if (isset($reg)) {
        $nome = $_POST['nome'];
        $address = $_POST['state'];
        $mail = $_POST['mail'];
        $postal1 = $_POST['cpostal1'];
        $postal2 = $_POST['cpostal2'];
        $phone = $_POST['phone'];
        $cc = $_POST['bi'];
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
        $sex = $_POST['sexo'];
        $degree = $_POST['habilitacao'];
        $dataEdit = $_POST['dataP'];
        $nif = $_POST['nif'];
        $pass = randomPassword();
        $pass_encrypt = md5($pass);

        $ligacao = connect();
        $expression_patient = "INSERT INTO patient (nif,postal,phone,date_of_birth,gender,locality,email,name,institution_nipc,id_card,professional_nif,qualifications,personal_data)" .
                "VALUES('$nif','$postal1-$postal2','$phone','$ano-$mes-$dia','$sex','$address','$mail','$nome','$i','$cc','$pro','$degree','$dataEdit')"
                or die(mysql_error());


        $query_p = mysql_query($expression_patient, $ligacao);
        $expression_insert = "INSERT INTO user (username, pass, patient_nif,institution_nipc,professional_nif,user_level,checked) VALUES ('$nome','$pass_encrypt','$nif','$i','$pro',4,1)" or die(mysql_error());
        $query = mysql_query($expression_insert, $ligacao) or die(mysql_error());
        if ((($query_p) && ($query)) == TRUE) {
            $mensagem = '<p>Aqui estão os dados da sua conta:<br/> User: ' . $nome . '<br/> Pass: ' . $pass . '</p> ';
            $titulo = 'Registo';
            email($mail, $nome, $pass, $mensagem, $titulo);
            ?><script>alertify.alert("Paciente registado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professional.php?pacient'>";
        } else {
            ?><script>alertify.alert("Registo sem sucesso,volte a inserir os dados!", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professional.php?pacient'>";
        }



        mysql_close($ligacao);
    }
}

//Register domain
function regDomain() {
    $dom = filter_input(INPUT_POST, 'addDomain', FILTER_SANITIZE_STRING);
    if (isset($dom)) {
        $nome = $_POST['name'];
        $descricao = $_POST['description'];

        $ligacao = connect();
        $expression_domain = "INSERT INTO domain (name,description,code)" .
                "VALUES('$nome','$descricao','')"
                or die(mysql_error());


        $query_p = mysql_query($expression_domain, $ligacao) or die(mysql_error());
        if (($query_p) == TRUE) {
            ?><script>alertify.alert("Dominio registado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professionalN.php?addDomain'>";
        } else {
            ?><script>alertify.alert("Dados incorretos ,registo sem sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professionalN.php?addDomain'>";
        }

        mysql_close($ligacao);
    }
}

//Register Exercise
function regExercise() {
    $dom = filter_input(INPUT_POST, 'subExercicio', FILTER_SANITIZE_STRING);
    if (isset($dom)) {
        $nome = $_POST['name'];
        $descricao = $_POST['description'];
        $tarefa = $_POST['instructions'];
        $structure = $_POST['structure'];
        $structureid = $_POST['structureid'];
        $level = $_POST['level'];

        $ligacao = connect();


        $expression_domain = "INSERT INTO exercise (name,description,instructions,structure_title,structure_id,level)" .
                "VALUES('$nome','$descricao','$tarefa','$structure','$structureid','$level')"
                or die(mysql_error());
      
        $query_p = mysql_query($expression_domain, $ligacao) or die(mysql_error());
        if (($query_p) == TRUE) {
            ?><script>alertify.alert("Exercício registado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professionalN.php?exercise'>";
        } else {
            ?><script>alertify.alert("Dados incorretos ,registo sem sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        }

        mysql_close($ligacao);
    }
}

//Add Pathology to Patient
function patientPathology() {
    $s = filter_input(INPUT_POST, 'patPatient', FILTER_SANITIZE_STRING);
    if (isset($s)) {
        $ligacao = connect();
        $pathology = filter_input(INPUT_POST, 'pat', FILTER_SANITIZE_STRING);
        $patient = filter_input(INPUT_POST, 'paciente', FILTER_SANITIZE_STRING);
        $expressao = "INSERT INTO patient_has_pathology (pathology_name, patient_code) VALUES ('$pathology','$patient')" or die(mysql_error());
        $query_user = mysql_query($expressao, $ligacao);
        if (($query_user) == TRUE) {
            ?><script>alertify.alert("Patologia adicionado ao paciente com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professional.php?pac'>";
        } else {
            ?><script>alertify.alert("Registo sem sucesso,volte a inserir os dados!", function () {
                        alertify.message('OK');
                    });</script><?php
        }


        mysql_close($ligacao);
    }
}

//Add domain to exercise
function domainExerc() {
    $j = filter_input(INPUT_POST, 'dom', FILTER_SANITIZE_STRING);
    if (isset($j)) {
        $ligacao = connect();
        $dominio = filter_input(INPUT_POST, 'dominio', FILTER_SANITIZE_STRING);
        $exercicio = filter_input(INPUT_POST, 'exer', FILTER_SANITIZE_STRING);
        $expressao = "Update exercise set domain_name='$dominio' where name='$exercicio'";
        $query = mysql_query($expressao, $ligacao);
        if ($query == TRUE) {
            ?><script>alertify.alert("Dominio adicionado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professionalN.php?domain'>";
        }
        mysql_close($ligacao);
    }
}

//Remove Pathology from patient
function remove_path($patient) {
    if (isset($_POST['elimina'])) {
        $ligacao = connect();
        $remove = "DELETE FROM patient_has_pathology WHERE patient_code='$patient'" or die(mysql_error());
        mysql_query($remove, $ligacao);
        ?><script>alertify.alert("Patologia removida com sucesso.", function () {
                    alertify.message('OK');
                });</script><?php
        echo "<meta http-equiv='refresh' content='2; url=professional.php?pac'>";
    }
    mysql_close($ligacao);
}

//Create session
function regSession() {
    $sess = filter_input(INPUT_POST, 'reg_sess', FILTER_SANITIZE_STRING);
    $pro = $_SESSION['professional'];
    if (isset($sess)) {
        $paciente = $_POST['patient'];
        $exercicio = $_POST['exercise'];
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
        $ligacao = connect();

        $expression_sess = "INSERT INTO sessions (date,patient_nif,id_exercise,done,professional_r)" .
                "VALUES('$ano-$mes-$dia','$paciente','$exercicio',1,$pro)"
                or die(mysql_error());


        $query_p = mysql_query($expression_sess, $ligacao) or die(mysql_error());
        if ($query_p == TRUE) {
            ?><script>alertify.alert("Sessão criada com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
            echo "<meta http-equiv='refresh' content='2; url=professional.php?createS'>";
        }
        mysql_close($ligacao);
    }
}

//Email function
function email($mail, $nome, $pass, $mensagem, $titulo) {
    $m = new PHPMailer;
    $imagem = '<img src="./img/nep.jpg" >';
    $mensagem = $imagem . $mensagem;

    $m->isSMTP();
    $m->SMTPAuth = true;

    $m->Host = 'smtp-mail.outlook.com';
    $m->Username = 'nepowlit@hotmail.com';
    $m->Password = 'nepuminhoOWL';
    $m->SMTPSecure = 'tls';
    $m->Port = 587;

    $m->From = 'nepowlit@hotmail.com';
    $m->FromName = 'NEP-UM';
    $m->addAddress($mail, $nome);
    $m->CharSet = 'UTF-8';

    $m->isHTML(true);

    //$m->Subject = 'Registo';
    $m->Subject = ($titulo);
    $m->MsgHTML($mensagem);
    //$m->Body = '<img src="./img/nep.jpg" >' . '<p>Bem-vindo a plataforma de avaliação Neuropsicológica.'
    //. 'O seu registo foi efetuado com sucesso, ficam aqui os seus dados: <br/> User: ' . $nome . '<br/> Pass ' . $pass . '</p> ';

    if ($m->send()) {
        echo '<script>alert("Email enviado com sucesso")</script>';
    } else {
        echo '<script>alert(' . $m->ErrorInfo . ')</script>';
    }
}

//Email mailbox
function email2($sender, $receiver, $mensagem, $titulo) {
    $ligacao = connect();

    date_default_timezone_set('europe/lisbon');

    $dia = $date = date('Y/m/d');
    $hora = $date = date('H:i:s');

    $expression_insert = "INSERT INTO mailbox (sender, receiver, subject, message, status, send_date, send_time,deleted) VALUES ('$sender','$receiver','$mensagem','$titulo','1','$dia','$hora','1')" or die(mysql_error());
    $query = mysql_query($expression_insert, $ligacao) or die(mysql_error());
    if ($query==TRUE) {
        ?><script>alertify.alert("Mensagem enviado com sucesso.", function () {
                    alertify.message('OK');
                });</script><?php
    } else {
        ?><script>alertify.alert("Mensagem não enviada.", function () {
                    alertify.message('OK');
                });</script><?php
    }
    mysql_close($ligacao);
}

//COntrol function
function acess_control($level) {



    if (isset($_SESSION['username'])) {
        // if a valid user session is found then the user level is checked, if the
        // user has level 3 access they will be granted access if not a access denied
        //message be displayed and the user will be redirected.


        if (($_SESSION['level'] == $level) && ($_SESSION['checked'] == 1)) {
            
        } else {
            header("Refresh: 3; url=index.php");

            echo '<h3>Acesso negado - Não possui permissão para aceder a esta página!</h3>';
            echo 'Irá ser reemcaminhado para a página inicial em 3 seconds';

            exit(); // Quit the script.
        }
    }
    // if no valid session is found then the user is not logged in and will
    // receive a access denied message and will be redirected to the login page.
    else if (!isset($_SESSION['username'])) {

        header("Refresh: 3; url=index.php");
        echo '<h3>Acesso negado - Não possui permissão para aceder a esta página!</h3>';
        echo 'Irá ser reemcaminhado para a página inicial em 3 seconds';

        exit(); // Quit the script.
    }
}

//Retriev password
function forgotpass($username, $nif, $mail) {
    $comp = filter_input(INPUT_POST, 'esquece', FILTER_SANITIZE_STRING);
    if (isset($comp)) {
        $nif = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'utilizador', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

        /* $nif = mysql_real_escape_string($nif);
          $username = mysql_real_escape_string($username);
          $email = mysql_real_escape_string($email);
         */
        $ligacao = connect();

        $querycompara = ("SELECT * FROM user Where investigator_nif is not null or patient_nif is not null or guest_nif is not null or professional_nif is not null or institution_nipc is not null") or die(mysql_error());

        //$querycompara = ("SELECT * FROM user Where investigator_nif=nif  or patient_nif=nif or guest_nif=nif or professional_nif=nif or institution_nipc =nif") or die(mysql_error());
        $query = mysql_query($querycompara, $ligacao) or die(mysql_error());
        while ($linha = mysql_fetch_array($query)) {
            $instituicao = $linha['institution_nipc'];
            $profissional = $linha['professional_nif'];
            $guest = $linha['guest_nif'];
            $investigador = $linha['investigator_nif'];
            $paciente = $linha['patient_nif'];
            $utilizador = $linha['username'];
            if ((!$instituicao = '') && ($instituicao = $nif) && ($utilizador = $username)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$username' and institution_nipc='$nif'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                email($mail, $nome, $pass);
            } else if ((!$profissional = '') && ($profissional = $nif) && ($utilizador = $username)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$username' and professional_nif='$nif'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                email($mail, $nome, $pass);
            } else if ((!$investigador = '') && ($investigador = $nif) && ($utilizador = $username)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='555' where username='$username' and investigator_nif='$nif'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                email($mail, $nome, $pass);
            } else if ((!$paciente = '') && ($paciente = $nif) && ($utilizador = $username)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$username' and patient_nif='$nif'"or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                email($mail, $nome, $pass);
            } else if ((!$guest = '') && ($guest = $nif) && ($utilizador = $username)) {
                $pass = randomPassword();
                $passencry = md5($pass);
                $atualiza = "update user set pass='$passencry' where username='$username' and guest_nif='$nif'" or die(mysql_error());
                mysql_query($atualiza, $ligacao);
                email($mail, $nome, $pass);
            }
        }
        mysql_close($ligacao);
        ?>
        <script>alert('Email enviado!');</script><?php
    }
}

//Aux Functions
function listDomain() {
    $ligacao = connect();
    $query = ("Select * From domain");
    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

function listPatient($i, $pro) {
    $ligacao = connect();
    if ($i == 1) {
        $query = ("Select * From patient");
    }if ($i == 2) {
        $query = ("SELECT DISTINCT pa.name,pa.nif
 FROM user p,patient pa where checked=0 and pa.professional_nif=p.professional_nif ;");
    }if ($i == 3) {
        $query = ("Select * From patient where professional_nif='$pro'");
    }else if ($i == 4) {
        $query = ("Select name From patient where nif='$pro'");
    }

    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

function listProfessional($i, $pro) {
    $ligacao = connect();
    if ($i == 1) {
        $query = ("Select * from professional");
    }if ($i == 2) {

        $query = ("SELECT P.name,P.nif
                                  FROM professional P, patient Pa
                                  WHERE   P.nif=Pa.professional_nif AND Pa.nif='$pro'");
    } elseif ($i == 3) {
        $query = ("SELECT P.name, P.nif
FROM user U, professional P
WHERE U.checked=1 AND U.institution_nipc=312312323 AND U.professional_nif = P.nif");
    }

    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

function listPathology() {
    $ligacao = connect();
    $query = ("Select * from pathology");
    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

function listPathology2() {
    $ligacao = connect();
    $query = ("Select * from patient_has_pathology");
    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

function listExercise($i) {
    
    $ligacao = connect();
    if($i==1){
        $query = ("Select * From exercise ");
    }elseif($i==2){
        $query = ("Select * From exercise where domain_name =''");
    }
   
    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

function listStructure() {
    $ligacao = connect();
    $query = ("Select * From structure where code limit 5");
    $resultado = mysql_query($query, $ligacao);
    mysql_close($ligacao);
    return $resultado;
}

//Update data for Professional and Institution
function updateData($pro, $v) {
    $ligacao = connect();

    $post = filter_input(INPUT_POST, 'GuardarP', FILTER_SANITIZE_STRING);
    if (isset($post)) {

        $name = filter_input(INPUT_POST, 'proN', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'proT', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'proE', FILTER_SANITIZE_STRING);
        $postal1 = filter_input(INPUT_POST, 'cpostal1', FILTER_SANITIZE_STRING);
        $postal2 = filter_input(INPUT_POST, 'cpostal2', FILTER_SANITIZE_STRING);
        if ($_POST['endereco'] != '') {
            $address = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        } else {
            $address;
        }
        if ($v == 1) {
            $t = 'professional';
        }if ($v == 3) {
            $t = 'patient';
        } elseif ($v == 2) {
            $t = 'investigator';
        }
        $expression = "UPDATE $t SET name = '$name' , phone='$phone',mail='$mail',postal='$postal1-$postal2' ,locality='$address'  WHERE nif = '$pro'" or die(mysql_error());
        $query1 = mysql_query($expression, $ligacao) or die(mysql_error());
        if ($query1 == TRUE) {
            ?><script>alertify.alert("Dados atualizados com sucesso.", function () {
                    alertify.message('OK');
                });</script><?php
        } else {
            ?><script>alertify.alert("Atualização de dados sem sucesso!Volte a tentar!", function () {
                        alertify.message('OK');
                    });</script><?php
        }
    }
    mysql_close($ligacao);
}

function updateDataI($user) {
    $ligacao = connect();

    $post = filter_input(INPUT_POST, 'GuardarI', FILTER_SANITIZE_STRING);
    if (isset($post)) {

        $name = filter_input(INPUT_POST, 'iN', FILTER_SANITIZE_STRING);
        $area = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'iEmail', FILTER_SANITIZE_STRING);
        $postal1 = filter_input(INPUT_POST, 'cpostal1', FILTER_SANITIZE_STRING);
        $postal2 = filter_input(INPUT_POST, 'cpostal2', FILTER_SANITIZE_STRING);
        if ($_POST['endereco'] != '') {
            $address = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        } else {
            $address;
        }
        $expression = "UPDATE institution SET name = '$name' , area='$area',mail='$mail',postal='$postal1-$postal2' ,address='$address'  WHERE nipc = '$user'" or die(mysql_error());
        $query1 = mysql_query($expression, $ligacao) or die(mysql_error());
        if ($query1 == TRUE) {
            ?><script>alertify.alert("Dados atualizados com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Atualização de dados sem sucesso!Volte a tentar!", function () {
                        alertify.message('OK');
                    });</script><?php
        }
    }
    mysql_close($ligacao);
}

//Change guest
function change_guest($prof, $inst, $user) {
    if (isset($_POST['cria'])) {
        $nome = $_POST['nome'];
        $nif = $_POST['nif'];
        $cc = $_POST['bi'];
        $nascimento = $_POST['nascimento'];
        $data = $_POST['dataP'];
        $qualf = $_POST['habilitacao'];
        $sex = $_POST['sexo'];
        $morada = $_POST['state'];
        $cod = $_POST['cpostal1'];
        $postal = $_POST['cpostal2'];
        $tel = $_POST['phone'];
        $mail = $_POST['mail'];
        $pass = randomPassword();
        $encry = md5($pass);

        $ligacao = connect();
        $update_user = "UPDATE user SET pass='$encry' AND guest_id='' AND professional_nif='$prof' "
                . "AND institution_nipc='$inst' AND patient_nif='$nif' AND checked='1' "
                . "AND acess='0' AND user_level='4' WHERE username='$user'" or die(mysql_error());
        $l = mysql_query($update_user, $ligacao);

        $patient = "INSERT INTO patient (nif, id_card, name, date_of_birth, gender, "
                . "phone, postal, locality, email, professional_nif, institution_nipc, qualifications, personal_data)"
                . "VALUES ('$nif', '$cc', '$nome', '$nascimento', '$sex', '$tel', '$cod-$postal', '$morada', '$mail', '$prof',"
                . "'$inst', '$qualf', '$data')" or die(mysql_error());
        $p = mysql_query($patient, $ligacao);
        if (($l && $p) == TRUE) {
            ?><script>alertify.alert("Dados de guest atualizado com sucesso.", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Dados não atualizados.", function () {
                        alertify.message('OK');
                    });</script><?php
        }
    }mysql_close($ligacao);
}

//Giving a new professional to patient
function update_patient() {
    if (isset($_POST['patPatient'])) {
        $nif_pat = $_POST['paciente'];

        $nif_pro = $_POST['pat'];
        $ligacao = connect();
        $update = "UPDATE user SET checked='1', professional_nif='$nif_pro' WHERE patient_nif='$nif_pat'" or die(mysql_error());
        mysql_query($update, $ligacao) or die(mysql_error());

        $update_pat = "UPDATE patient SET professional_nif='$nif_pro' WHERE nif='$nif_pat'" or die(mysql_error());
        $q = mysql_query($update_pat, $ligacao) or die(mysql_error());
        if (($q) == TRUE) {
            ?><script>alertify.alert("Guest atribuido com sucesso!", function () {
                        alertify.message('OK');
                    });</script><?php
        } else {
            ?><script>alertify.alert("Guest não atribuido!", function () {
                        alertify.message('OK');
                    });</script><?php
        }
        mysql_close($ligacao);
    }
}

//Block functions
function block($nipc) {
    if (isset($_POST['block'])) {

        $checked = "SELECT * FROM user WHERE institution_nipc='$nipc' AND professional_nif IS NOT NULL AND patient_nif IS NOT NULL";
        $check_query = mysql_query($checked, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            if ($row['checked'] === 1) {
                //$exp_inst = "UPDATE user SET VALUE checked='0' WHERE institution_nipc='$nipc'" or die(mysql_error());
                //mysql_query($exp_inst, $ligacao) or die(mysql_error());
                $exp_pro = "UPADATE user SET VALUE checked='0' WHERE professional_nif IS NOT NULL AND institution_nipc='$nipc'" or die(mysql_error());
                mysql_query($exp_pro, $ligacao) or die(mysql_error());
                $exp_pat = "UPDATE user SET VALUE checked='0' WHERE patient_nif IS NOT NULL AND institution_nipc='$nipc'" or die(mysql_error());
                mysql_query($exp_pat, $ligacao) or die(mysql_error());
            } elseif ($row['checked'] === 0) {
                //$exp_inst = "UPDATE user SET VALUE checked='1' WHERE institution_nipc='$nipc'" or die(mysql_error());
                //mysql_query($exp_inst, $ligacao);
                $exp_pro = "UPADATE user SET VALUE checked='1' WHERE professional_nif IS NOT NULL AND institution_nipc='$nipc'" or die(mysql_error());
                mysql_query($exp_pro, $ligacao);
                $exp_pat = "UPDATE user SET VALUE checked='1' WHERE patient_nif IS NOT NULL AND institution_nipc='$nipc'" or die(mysql_error());
                mysql_query($exp_pat, $ligacao);
            }
        }
    }
}

function block_patient($pro) {
    if (isset($_POST['blockPro'])) {

        $checked_pat = "SELECT * FROM user WHERE professional_nif='$pro' AND patient_nif IS NOT NULL";
        $check_query = mysql_query($checked_pat, $ligacao);
        while ($row = mysql_fetch_array($check_query)) {
            if ($row['checked'] == 1) {
                $exp_pat = "UPDATE user SET VALUE checked='0' WHERE patient_nif IS NOT NULL AND institution_nipc='$pro'" or die(mysql_error());
                mysql_query($exp_pat, $ligacao) or die(mysql_error());
            } elseif ($row['checked'] == 0) {
                $exp_pat = "UPDATE user SET VALUE checked='1' WHERE patient_nif IS NOT NULL AND institution_nipc='$pro'" or die(mysql_error());
                mysql_query($exp_pat, $ligacao) or die(mysql_error());
            }
        }
    }
}
