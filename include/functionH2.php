
<script src="./js/jquery.min.js" ></script>
<?php
require_once 'mysql.connect.php';
require_once 'dataBase.php';

//Search all users
function search_all($u) {
    $user = mysql_escape_string($u);

    $ligacao = connect();
//profissional
    $sql_pro = mysql_query("SELECT * FROM professional WHERE name LIKE  '%" . $user . "%' and name not like '$user'") or die(mysql_error());
    $result_pro = mysql_num_rows($sql_pro);
//paciente
    $sql_pat = mysql_query("SELECT * FROM patient WHERE name LIKE '%" . $user . "%' and name not like '$user'") or die(mysql_error());
    $result_pat = mysql_num_rows($sql_pat);
//guest
    $sql_guest = mysql_query("SELECT * FROM guest WHERE name LIKE '%" . $user . "%' and name not like '$user'") or die(mysql_error());
    $result_guest = mysql_num_rows($sql_guest);
    if ($result_pro >= 1) {
        ?>
        <table class="table">
            <tr>
                <th>Nome</th> 
                <th>NIF</th>
                <th>Nascimento</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Intituição</th>
                <th>Opções</th>
            </tr>
            <?php
            while ($linha = mysql_fetch_array($sql_pro)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['nif'] ?> </td>
                    <td><?= $linha['date_of_birth'] ?> </td>
                    <td><?= $linha['locality'] ?> </td>
                    <td><?= $linha['mail'] ?></td>
                    <td><?= $linha['institution_nipc'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button>       <form method="post"> <button type="submit" name="blockPro"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>

                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" size="10" value="<?= $linha['name'] ?>"></td>
                    <td><?= $linha['nif'] ?></td>
                    <td><?= $linha['date_of_birth'] ?></td>
                    <td><input type="text" name="rua" size="10" value="<?= $linha['locality'] ?>"></td>
                    <td><input type="email" name="mail" size="25" value="<?= $linha['mail'] ?>"></td>
                    <td><?= $linha['institution_nipc'] ?></td>
                    <td>
                        <button type="submit" name="submitPro"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
            </table>
            <?php
            $pro = $linha['nif'];
        }
    } elseif ($result_pat >= 1) {
        ?>
        <table class="table">
            <tr>
                <th>Nome</th> 
                <th>NIF</th>
                <th>Nascimento</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Médico</th>
                <th>Intituição</th>
                <th>Opções</th>
            </tr>
            <?php
            while ($linha = mysql_fetch_array($sql_pat)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['nif'] ?> </td>
                    <td><?= $linha['date_of_birth'] ?> </td>
                    <td><?= $linha['locality'], $linha['postal'] ?></td>
                    <td><?= $linha['email'] ?></td>
                    <td><?= $linha['professional_nif'] ?></td>
                    <td><?= $linha['institution_nipc'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button>       <form method="post"> <button type="submit" name="blockPat"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>

                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" size="10" value="<?= $linha['name'] ?>"></td>
                    <td><?= $linha['nif'] ?></td>
                    <td><?= $linha['date_of_birth'] ?></td>
                    <td><?= $linha['locality'], $linha['postal'] ?></td>
                    <td><input type="text" name="mail" size="10" value="<?= $linha['email'] ?>"></td>
                    <td><?= $linha['professional_nif'] ?></td>
                    <td><?= $linha['institution_nipc'] ?></td>
                    <td>
                        <button type="submit" name="submitPat"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
            </table>
            <?php
            $pat = $linha['nif'];
        }
    } elseif ($result_guest >= 1) {
        ?>
        <table class="table">
            <tr class="toggle">
                <th>Nome</th>
                <th>Sexo</th>
                <th>Habilitações</th>
                <th>Email</th>
                <th>Opções</th>
            </tr>
            <?php
            while ($linha = mysql_fetch_array($sql_guest)) {
                ?>
                <tr>
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['gender'] ?></td>
                    <td><?= $linha['academic_qual'] ?></td>
                    <td><?= $linha['email'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button>       <form method="post"> <button type="submit" name="blockGue"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>

                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" size="10" value="<?= $linha['name'] ?>"></td>
                    <td><?= $linha['gender'] ?></td>
                    <td><?= $linha['academic_qual'] ?></td>
                    <td><input type="email" name="mail" size="25" value="<?= $linha['email'] ?>"></td>
                    <td>
                        <button type="submit" name="submitGue"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
                <?php
                $id = $linha['id'];
            }
            ?>
        </table>
        <?php
    } else {
        ?><script>alertify.alert("Utilizador não encontrado.", function () {
                alertify.message('OK');
            });</script><?php
    } if (isset($_POST['submitPro'])) {
        if (isset($_POST['nome']) && isset($_POST['rua']) && $_POST['mail']) {
            $nome = $_POST['nome'];
            $rua = $_POST['rua'];
            $mail = $_POST['mail'];

            $update_info = "UPDATE professional SET name = '$nome', mail = '$mail', locality = '$rua' WHERE nif = '$pro'" or die(mysql_error());
            $query_info = mysql_query($update_info, $ligacao) or die(mysql_error());

            if (!($query_info)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script>
                <?php
            }
        }
    } elseif (isset($_POST['blockPro'])) {
        $check = "SELECT * FROM user WHERE professional_nif = '$pro'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            block_patient($pro);
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE professional_nif = '$pro'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Professional bloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE professional_nif = '$pro'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Professional desbloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    } elseif (isset($_POST['submitPat'])) {
        if (isset($_POST['nome']) && $_POST['mail']) {
            $nome = $_POST['nome'];
            $mail = $_POST['mail'];

            $update_info = "UPDATE patient SET name = '$nome', email = '$mail' WHERE nif = '$pat'" or die(mysql_error());
            $query_info = mysql_query($update_info, $ligacao) or die(mysql_error());

            if (!($query_info)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script>
                <?php
            }
        }
    } elseif (isset($_POST['blockPat'])) {
        $check = "SELECT * FROM user WHERE patient_nif = '$pat'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE patient_nif = '$pat'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Paciente bloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE patient_nif = '$pat'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Paciente desbloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    } elseif (isset($_POST['submitGue'])) {
        if (isset($_POST['nome']) && (isset($_POST['mail']))) {
            $nome = $_POST['nome'];
            $mail = $_POST['mail'];

            $update_info = "UPDATE guest SET name = '$nome', email = '$mail' WHERE id = '$id'" or die(mysql_error());
            $query_info = mysql_query($update_info, $ligacao) or die(mysql_error());

            if (!($query_info)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script>
                <?php
            }
        }
    } elseif (isset($_POST['blockGue'])) {
        $check = "SELECT * FROM user WHERE guest_id = '$id'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE guest_id = '$id'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Convidado bloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE guest_id = '$id'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Convidado desbloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    }

    mysql_close($ligacao);
}

//List of all users
function user_list() {
    $connect = connect();
    ?>
    <h3 onclick="showDiv('#pro')" style="cursor: pointer;">Profissionais de saúde</h3>
    <div id="pro" style="display: none;">
        <table class="table">
            <?php
            $profissionais = "SELECT * FROM professional" or die(mysql_error());
            $query_pro = mysql_query($profissionais, $connect) or die(mysql_error());

            $user_pro = "SELECT * FROM user WHERE professional_nif IS NOT NULL" or die(mysql_error());
            $pro_query = mysql_query($user_pro, $connect) or die(mysql_error());
            ?>
            <tr>
                <th>Nome</th> 
                <th>NIF</th>
                <th>Nascimento</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Intituição</th>
                <th>Acesso</th>
            </tr>
            <?php
            if ((mysql_num_rows($query_pro) > 0) && (mysql_num_rows($pro_query) > 0)) {
                while (($pro = mysql_fetch_array($query_pro)) && ($user = mysql_fetch_array($pro_query))) {
                    ?>
                    <tr class="toggle">
                        <td><?= $pro['name'] ?> </td>
                        <td><?= $pro['nif'] ?> </td>
                        <td><?= $pro['date_of_birth'] ?></td>
                        <td><?= $pro['locality'] ?></td>
                        <td><?= $pro['mail'] ?> </td>
                        <td><?= $pro['institution_nipc'] ?></td>
                        <td>
                            <?php
                            if ($user['checked'] == 1) {
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
    </div>
    <h3 onclick="showDiv('#pat')" style="cursor: pointer;">Pacientes</h3>
    <div id="pat" style="display: none;">
        <table class="table">
            <?php
            $pacientes = "SELECT * FROM patient"or die(mysql_error());
            $query_pat = mysql_query($pacientes, $connect) or die(mysql_error());

            $user_pat = "SELECT * FROM user WHERE patient_nif IS NOT NULL" or die(mysql_error());
            $pro_pat = mysql_query($user_pat, $connect) or die(mysql_error());
            ?>
            <tr>
                <th>Nome</th> 
                <th>NIF</th>
                <th>Nascimento</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Médico</th>
                <th>Intituição</th>
                <th>Acesso</th>
            </tr>
            <?php
            if ((mysql_num_rows($query_pat) > 0) && (mysql_num_rows($pro_pat) > 0)) {
                while (($pat = mysql_fetch_array($query_pat)) && ($user = mysql_fetch_array($pro_pat))) {
                    ?>
                    <tr class="toggle">
                        <td><?= $pat['name'] ?> </td>
                        <td><?= $pat['nif'] ?> </td>
                        <td><?= $pat['date_of_birth'] ?></td>
                        <td><?= $pat['locality'], $pat['postal']; ?></td>
                        <td><?= $pat['email'] ?></td>
                        <td><?= $pat['professional_nif'] ?></td>
                        <td><?= $pat['institution_nipc'] ?></td>
                        <td>
                            <?php
                            if ($user['checked'] == 1) {
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
    </div>
    <h3 onclick="showDiv('#gue')" style="cursor: pointer;">Convidados</h3>
    <div id="gue" style="display: none;">
        <table class="table">
            <?php
            $guests = "SELECT * FROM guest" or die(mysql_error());
            $query_gue = mysql_query($guests, $connect) or die(mysql_error());

            $user_gue = "SELECT * FROM user WHERE guest_id IS NOT NULL" or die(mysql_error());
            $pro_gues = mysql_query($user_gue, $connect) or die(mysql_error());
            ?>
            <tr>
                <th>Nome</th> 
                <th>Nascimento</th>
                <th>Sexo</th>
                <th>Email</th>
                <th>Habilitações</th>
                <th>Acesso</th>
            </tr>
            <?php
            if ((mysql_num_rows($query_gue) > 0) && (mysql_num_rows($pro_gues) > 0)) {
                while (($gue = mysql_fetch_array($query_gue)) && ($user = mysql_fetch_array($pro_gues))) {
                    ?>
                    <tr class="toggle">
                        <td><?= $gue['name'] ?> </td>
                        <td><?= $gue['date_birth'] ?> </td>
                        <td><?= $gue['gender'] ?></td>
                        <td><?= $gue['email'] ?></td>
                        <td><?= $gue['academic_qual'] ?> </td>
                        <td>
                            <?php
                            if ($user['checked'] == 1) {
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
    </div>
    <?php
}

//Search Institution
function search_institution($s) {
    $inst = mysql_escape_string($s);

    $ligacao = connect();
    $sql = mysql_query("SELECT * FROM institution WHERE name LIKE '" . "%" . $inst . "%' and name not like '$inst'") or die(mysql_error());
    $result = mysql_num_rows($sql);
    if ($result >= 1) {
        ?>   
        <table class="table">
            <tr>
                <th class="clickable1" >Nome</th> 
                <th>Área</th>
                <th>Morada</th>
                <th>Email</th>
                <th title="Número de Identificação Fiscals de Pessoa Coletiva">NIPC</th>
                <th>Opções</th>
            </tr>
            <?php
            while ($linha = mysql_fetch_array($sql)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['area'] ?> </td>
                    <td><?= $linha['address'] ?> </td>
                    <td><?= $linha['mail'] ?> </td>
                    <td><?= $linha['nipc'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button>       <form method="post"> <button type="submit" name="blockI"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>

                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" style="width: 100px" value="<?= $linha['name'] ?>"></td>
                    <td><?= $linha['area'] ?></td>
                    <td><input type="text" name="rua" style="width: 110px" value="<?= $linha['address'] ?>"></td>
                    <td><input type="email" name="mail" value="<?= $linha['mail'] ?>"></td>
                    <td><?= $linha['nipc'] ?></td>
                    <td>
                        <button type="submit" name="submitEi"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
            </tr>
            </table> 
            <?php
            $nipcIN = $linha['nipc'];
        }
    } else {
        ?><script>alertify.alert("Instituição não encontrada.", function () {
                alertify.message('OK');
            });</script><?php
    }
    if (isset($_POST['submitEi'])) {
        if (isset($_POST['nome']) && isset($_POST['rua']) && isset($_POST['mail'])) {
            $nome = $_POST['nome'];
            $nipc = $nipcIN;
            $rua = $_POST['rua'];
            $mail = $_POST['mail'];

            $sqw = "UPDATE institution SET name = '$nome', mail ='$mail',address='$rua' WHERE nipc = '$nipc'" or die(mysql_error());
            $row2 = mysql_query($sqw, $ligacao) or die(mysql_error());

            if (!($row2)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script><?php
            }
        }
    } else if (isset($_POST['blockI'])) {
        $check = "SELECT * FROM user WHERE institution_nipc = '$nipcIN'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            block($nipcIN);
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE institution_nipc = '$nipcIN'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Instituição bloqueada com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE institution_nipc = '$nipcIN'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Instituição desbloqueada com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    }
    mysql_free_result($sql);
    mysql_close($ligacao);
}

//Search investigator
function search_investigator($s) {
    $inv = mysql_escape_string($s);
    $ligacao = connect();
    $sql = mysql_query("SELECT * FROM investigator WHERE name LIKE  '%" . $inv . "%'and name not like '$inv' ") or die(mysql_error());
    $result = mysql_num_rows($sql);
    if ($result >= 1) {
        ?>   
        <table class="table">
            <tr>
                <th class="clickable1" >Nome</th>
                <th title="Número de Identificação Fiscal">NIF</th>
                <th title="Cartão de cidadão">C.C</th>
                <th>Sexo</th>
                <th>Morada</th>
                <th>Email</th>
                <th>Opções</th>
            </tr><?php
            while ($linha = mysql_fetch_array($sql)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['nif'] ?> </td>
                    <td><?= $linha['id_card'] ?> </td>
                    <td><?= $linha['gender'] ?> </td>
                    <td><?= $linha['locality'] ?> </td>
                    <td><?= $linha['mail'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button>       <form method="post"> <button type="submit" name="block"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>
                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" size="10" value="<?= $linha['name'] ?>"></td>
                    <td><?= $linha['nif'] ?></td>
                    <td><?= $linha['id_card'] ?></td>
                    <td><?= $linha['gender'] ?></td>
                    <td><input type="text" name="rua" size="10" value="<?= $linha['locality'] ?>"></td>
                    <td><input type="email" name="mail" size="25" value="<?= $linha['mail'] ?>"></td>
                    <td>
                        <button type="submit" name="submitE"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
            </table>
            <?php
            $inv = $linha['nif'];
        }
    } else {
        ?><script>alertify.alert("Professional do núcleo não encontrado.", function () {
                alertify.message('ok');
                wind
            });</script><?php
    }
    if (isset($_POST['submitE'])) {
        if (isset($_POST['nome']) && isset($_POST['rua']) && $_POST['mail']) {
            $nome = $_POST['nome'];
            $rua = $_POST['rua'];
            $mail = $_POST['mail'];

            $update_info = "UPDATE investigator SET name = '$nome', mail = '$mail', locality = '$rua' WHERE nif = '$inv'" or die(mysql_error());
            $query_info = mysql_query($update_info, $ligacao) or die(mysql_error());

            if (!($query_info)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script>
                <?php
            }
        }
    } else if (isset($_POST['block'])) {
        $check = "SELECT * FROM user WHERE investigator_nif = '$inv'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE investigator_nif = '$inv'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Investigador bloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE investigator_nif = '$inv'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Investigador desbloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    }
    mysql_free_result($sql);
    mysql_close($ligacao);
}

//Search professional
function search_professional($s) {
    ?>


    <?php
    $i = mysql_escape_string($s);

    $ligacao = connect();
    $sql = mysql_query("SELECT * FROM professional WHERE name LIKE  '%" . $i . "%' and name not like '$i' ") or die(mysql_error());
    $result = mysql_num_rows($sql);
    if ($result >= 1) {
        ?>   <table class="table" >
            <tr>
                <th class="clickable1" >Nome</th> 

                <th>Morada</th>
                <th>Email</th>
                <th>Cartão de cidadão</th>
                <th title="Número de Identificação Fiscal">NIF</th>
                <th>Opções</th>
            </tr><?php
            //echo $result . " resultado(s) para <strong>" . $inst . "</strong><br><br>";
            while ($linha = mysql_fetch_array($sql)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>

                    <td><?= $linha['locality'] ?> </td>
                    <td><?= $linha['mail'] ?> </td>
                    <td><?= $linha['id_card'] ?></td>
                    <td><?= $linha['nif'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button><form method="post"><button type="submit" name="blockpro"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>
                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" size="15" value="<?= $linha['name'] ?>"></td>

                    <td><input type="text" name="rua" size="15" value="<?= $linha['locality'] ?>"></td>
                    <td><input type="email" name="mail" size="20" value="<?= $linha['mail'] ?>"></td>
                    <td><?= $linha['id_card'] ?></td>
                    <td><?= $linha['nif'] ?></td>
                    <td>
                        <button type="submit" name="submitpro"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
            </table>
            <?php
            $pro = $linha['nif'];
        }
    } else {
        ?><script>alertify.alert("Professional  não encontrado.", function () {
                alertify.message('ok');
                wind
            });</script><?php
    }

    if (isset($_POST['submitpro'])) {
        if (isset($_POST['nome']) && isset($_POST['rua']) && $_POST['mail']) {
            $nome = $_POST['nome'];
            $rua = $_POST['rua'];
            $mail = $_POST['mail'];

            $update_info = "UPDATE professional SET name = '$nome', mail = '$mail', locality = '$rua' WHERE nif = '$pro'" or die(mysql_error());
            $query_info = mysql_query($update_info, $ligacao) or die(mysql_error());

            if (!($query_info)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script>
                <?php
            }
        }
    } elseif (isset($_POST['blockpro'])) {
        $check = "SELECT * FROM user WHERE professional_nif = '$pro'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            block_patient($pro);
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE professional_nif = '$pro'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Professional bloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE professional_nif = '$pro'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Professional desbloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    }
  
    mysql_close($ligacao);
}

//SEarch patient
function search_patient($p) {

    $pat = mysql_real_escape_string($p);

    $ligacao = connect();
    $sql = mysql_query("SELECT * FROM patient WHERE name LIKE '" . "%" . $pat . "%' and name not like '$pat'") or die(mysql_error());
    $result = mysql_num_rows($sql);
    if ($result >= 1) {
        ?>   <table class="table">
            <tr>
                <th class="clickable1" >Nome</th> 
                <th>NIF</th>
                <th>Data de Nascimento</th>
                <th>Morada</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Habilitações</th>
            </tr><?php
            while ($linha = mysql_fetch_array($sql)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['nif'] ?></td>
                    <td><?= $linha['date_of_birth'] ?></td>
                    <td><?= $linha['locality'], -$linha['postal'] ?></td>
                    <td><?= $linha['phone'] ?></td>
                    <td><?= $linha['email'] ?></td>
                    <td><?= $linha['qualifications'] ?></td>
                    <td><button onclick="showDiv('.toggle2')" style="cursor: pointer;"><span class="icon-pencil" title="Editar"></span></button>       <form method="post"> <button type="submit" name="blockPat"  style="  margin-left: 51px; margin-top: -21px;"><span class="icon-remove" title="Bloquear" ></span></button></form></td>
                </tr>

                <tr class="toggle2">
                <form method="post">
                    <td><input type="text" name="nome" size="10" value="<?= $linha['name'] ?>"></td>
                    <td><?= $linha['nif'] ?></td>
                    <td><?= $linha['date_of_birth'] ?></td>
                    <td><?= $linha['locality'] - $linha['postal'] ?></td>
                    <td><input type="text" name="mail" size="10" value="<?= $linha['email'] ?>"></td>
                    <td><?= $linha['professional_nif'] ?></td>
                    <td><?= $linha['institution_nipc'] ?></td>
                    <td>
                        <button type="submit" name="submitPat"><span class="icon-ok-sign"></span></button>
                        <button type="submit" name="cancel" onclick="showDiv('#toggle2')"><span class="icon-remove-sign"></span></button>
                    </td>
                </form>
            </table>
            <?php
            $pat = $linha['nif'];
        }
    } else if ($result == 0) {
        ?> 
        <script>alertify.alert("Paciente não encontrado.", function () {
                alertify.message('ok');
                wind
            });</script><?php
    }if (isset($_POST['submitPat'])) {
        if (isset($_POST['nome']) && $_POST['mail']) {
            $nome = $_POST['nome'];
            $mail = $_POST['mail'];

            $update_info = "UPDATE patient SET name = '$nome', email = '$mail' WHERE nif = '$pat'" or die(mysql_error());
            $query_info = mysql_query($update_info, $ligacao) or die(mysql_error());

            if (!($query_info)) {
                die('Erro: ' . mysql_error());
            } else {
                ?><script>alertify.alert("Informação alterada com sucesso.", function () {
                            alertify.message('ok');
                            wind
                        });</script>
                <?php
            }
        }
    } elseif (isset($_POST['blockPat'])) {
        $check = "SELECT * FROM user WHERE patient_nif = '$pat'" or die(mysql_error());
        $check_query = mysql_query($check, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($check_query)) {
            $checked = $row['checked'];
            if ($checked == 1) {
                $block = "UPDATE user SET checked='0' WHERE patient_nif = '$pat'" or die(mysql_error());
                $exec = mysql_query($block, $ligacao);

                if (!($exec)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Paciente bloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            } else {
                $dblock = "UPDATE user SET checked=1 WHERE patient_nif = '$pat'" or die(mysql_error());
                $dblock_query = mysql_query($dblock, $ligacao);

                if (!($dblock_query)) {
                    die('Erro: ' . mysql_error());
                } else {
                    ?><script>alertify.alert("Paciente desbloqueado com sucesso", function () {
                                alertify.message('ok');
                                wind
                            });</script><?php
                }
            }
        }
    }

    mysql_free_result($sql);
    mysql_close($ligacao);
}

//Search pathology
function search_pathology($s) {

    $path = mysql_real_escape_string($s);

    $ligacao = connect();
    $sql = mysql_query("SELECT * FROM pathology WHERE name LIKE '" . "%" . $path . "%''and name not like '$path'") or die(mysql_error());
    $result = mysql_num_rows($sql);
    if ($result >= 1) {
        ?>   <table class="table">
            <tr>
                <th class="clickable1" >Patologia</th> 

            </tr><?php
            //echo $result . " resultado(s) para <strong>" . $inst . "</strong><br><br>";
            while ($linha = mysql_fetch_array($sql)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                </tr>


            </table> 
            <?php
        }
    } else {
        ?><script>alertify.alert("Patologia  não encontrada.", function () {
                alertify.message('ok');
                wind
            });</script><?php
    } 
    mysql_close($ligacao);
}

//Search Domain
function search_domain($d) {

    $dom = mysql_escape_string($d);

    $ligacao = connect();
    $sql = mysql_query("SELECT * FROM domain WHERE name LIKE '" . "%" . $dom . "%''and name not like '$dom'") or die(mysql_error());
    //$delete=mysql_query("DELETE * FROM domain WHERE name LIKE '" . "%" . $dom . "'") or die(mysql_error());
    $result = mysql_num_rows($sql);
    if ($result >= 1) {
        ?>   <table class="table">
            <tr>
                <th class="clickable1" >Nome</th> 
                <th>Descrição</th>
            </tr><?php
            //echo $result . " resultado(s) para <strong>" . $inst . "</strong><br><br>";
            while ($linha = mysql_fetch_array($sql)) {
                ?>
                <tr class="toggle">
                    <td><?= $linha['name'] ?></td>
                    <td><?= $linha['description'] ?></td>
                </tr>
            </table> 
            <?php
        }
    } else {
        ?><script>alertify.alert("Dominio  não encontrado.", function () {
                alertify.message('ok');
                wind
            });</script><?php
    } 
    mysql_close($ligacao);
}

function checkSessions($nifS) {

    $connect = connect();
    $ses = "SELECT * FROM sessions where patient_nif='$nifS'" or die(mysql_error());
    $query_i = mysql_query($ses, $connect) or die(mysql_error());
    
    
    ?>
    <fieldset>
        <legend> <h1>Exercícios Aconselhados</h1></legend>
            <p>Escolha uma Sessão</p>
           <!-- Nome<input name="name"type="text">-->
            <form method="post">
                    <select autofocus name="data" required id="session">
                        <?php $sess = listSession();
                        while ($row = mysql_fetch_array($sess)) {?>
                            <option value="<?= $row['date'] ?>"><?= $row['date'] ?></option>
                          
                        <?php    }
                       //echo $row['id_sessions'];     ?>
                    </select>
                    <br>
                    
                    <input type="submit" id="checkexercises" name="verificar" value="Consultar">
            </form>
                  
    </fieldset>
<?php
if(isset($_POST['verificar'])){
    $date= $_POST['data'];
     $ligacao=connect();
      $query=("SELECT exercise_name FROM sessions WHERE date='$date'");
      
      $sql=mysql_query($query,$ligacao) or die(mysql_error());
      $linha=  mysql_fetch_array($sql)or die(mysql_error());
      ?>
    <p>Exercicio a realizar:</p>
    <p> <?php echo "-" . $linha['exercise_name'];?></p>
    <?php
}
}
//Set pacient to new professional
function setPaciente() {
    ?>
    <h1>Atribuir Paciente</h1>
    <div>
        <form method="post">
            <p><label>Paciente:<font color="red" size="2" >*</font></label></p>
            <select required="" name="paciente">
                <?php
                $pat = listPatient(2, '');
                while ($row1 = mysql_fetch_array($pat)) {
                    ?>
                    <option value="<?= $row1['nif'] ?>"><?= $row1['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
            <p><label>Profissionais:<font color="red" size="2" >*</font></label></p>
            <select required="" name="pat">
                <?php
                $pat = listProfessional(3,'');
                while ($row1 = mysql_fetch_array($pat)) {
                    ?>
                    <option value="<?= $row1['nif'] ?>"><?= $row1['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
            <input type="submit" value="Adicionar Paciente" name="patPatient" class="btn-danger">
        </form>
    
        <image src="./img/doctorpatient.jpg" style="  height: 513px;border-radius: 14px;border: 2px solid #8B8582;width: 747px;"/>
   
    <?= update_patient();?>
    </div>
    
    <?php
}

//CHange guest
function turn_guest() {
    ?>
    <h1>Afiliação de Guest</h1>
    <form method="post">
        <input type="text" name="usernameguest" placeholder="Username Guest">
        <input type="password" name="pass">
        <input type="submit" name="data">
    </form>
    <?php
    if (isset($_POST['data'])) {
        $user_guest = $_POST['usernameguest'];
        $pass_guest = md5($_POST['pass']);
        $ligacao = connect();
        $search = "SELECT * FROM user WHERE username='$user_guest' AND pass='$pass_guest' WHERE guest_id IS NOT NULL";
        $query_search = mysql_query($search, $ligacao) or die(mysql_error());
        while ($row = mysql_fetch_array($query_search)) {
            $pass = $row['pass'];
            $user = $row['username'];
            $id = $row['id'];
            if ($pass == $pass_guest && $user == $user_guest) {
                $guest = "SELECT * FROM guest WHERE guest_id='$id'" or die(mysql_error());
                $query_guest = mysql_query($guest, $ligacao) or die(mysql_error());
                while ($info = mysql_fetch_array($query_guest)) {
                    $nome = $info['name'];
                    $data = $info['date_birth'];
                    //$sex = $info['gender'];
                    //$habi = $info['academic_qual'];
                    $mail = $info['email'];
                    ?>
                    <div id="perfis">
                        <form method="POST">
                            <p><label>Nome:<font color="red" size="2" >*</font></label></p>
                            <input type="text" value="<?= $nome ?>" name="nome">
                            <p><label>NIF:<font color="red" size="2" >*</font></label></p>
                            <input type="int" name="nif" onkeyup="showValidNIF(this.value)" required="" maxlength="9" ><span id="txtValNIF"></span>
                            <p><label>Número de cartão de cidadão:<font color="red" size="2" >*</font> </label></p>
                            <input type="text" name="bi" placeholder="C.C" required="" maxlength="9">
                            <p>Data de nascimento</p>
                            <input type="text" value="<?= $data ?>" name="nascimento">
                            <input type="">
                            <label><p>Pode editar os dados?</p>
                                <p><input type="radio" value="1" name="dataP">Sim 
                                    <input type="radio" value="0" name="dataP">Não</p></label>
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
                            <input id="input1" type='int' name='cpostal1'  maxlength="4" />-<input id="input1" type='int' name='cpostal2'  maxlength="3" />
                            <p><label>Telefone:<font color="red" size="2" >*</font></label></p>
                            <input type="int" name="phone" maxlength="9">
                            <p><label>Email:<font color="red" size="2" >*</font></label></p>
                            <input type="email" name="mail" value="<?= $mail ?>" placeholder="email@hotmail.com">
                            <input type="submit" name="cria" value="Registar">
                        </form>
                    </div>
                    <?php
                    if (isset($_POST['cria'])) {
                        $inst = $_SESSION['institution'];
                        $prof = $_SESSION['professional'];
                        change_guest($prof, $inst, $user);
                    }
                }
            }
        }
        mysql_close($ligacao);
    }
}

//Atribuir dominio ao exercício
function setDomain() {
    ?>
    <h1>Atribuir domínio</h1>
    <div>
        <form method="post">
            <p><label>Domínio:</label></p>
            <select required="" name="dominio">
                <?php
                $pat = listDomain();
                while ($row1 = mysql_fetch_array($pat)) {
                    ?>
                    <option value="<?= $row1['name'] ?>"><?= $row1['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
            <p><label>Exercício:</label></p>
            <select required="" name="exer">
                <?php
                $pat = listExercise(2);
                while ($row1 = mysql_fetch_array($pat)) {
                    ?>
                    <option value="<?= $row1['name'] ?>"><?= $row1['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
            <input type="submit" value="Associar domínio" name="dom" class="btn-danger">
        </form>

    </div>

    <?= domainExerc(); ?>

    <?php
}

//Function Exercise
function searchExercise($i) {
    $ligacao = connect();


    $query = ("SELECT * FROM exercise where name LIKE  '%" . $i . "%' and name not like '$i'");


    $sql = mysql_query($query);
     $result = mysql_num_rows($sql);
    if ($result >= 1) {
    ?>  
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>    
                    <th>Estrutura</th>    
                    <th>Domínio</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysql_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td> <?= $row['name'] ?> </td>
                        <td> <?= $row['structure_title'] ?> </td>
                        <td> <?= $row['domain_name'] ?> </td>

                        <td><a id="d" href="./professionalN.php?exerciseE=<?= $row['name']; ?>">Eliminar <span class='icon-remove-sign' title='eliminar'></span></a></td>
                    </tr>
                    <tr class="toggle2">
                        <td></td>

                    </tr> 
                    </table>
                    <?php
       }
    } else {
        ?><script>alertify.alert("Exercicio  não encontrado.", function () {
                alertify.message('ok');
                wind
            });</script><?php
    }
                ?>
        
    </div>
    <?php                mysql_close($ligacao);
}

//MEnu structure
function menuStructure() {
    ?>
    <div id="perfis">
        <h1>Escolha estrutura</h1>
        <?php
       
        
        ?>
    
   
        
        <a href="./professionalN.php?id=Escolha Múltipla&v=1"><img src="./img/multiple.jpg" style="border-radius: 14px;border: 2px solid #a1a1a1;width: 279;
                                                                     height: 187;  "></a>
                                                       
        <a href="./professionalN.php?id=Ordenação&v=2"><img title="Ordenação"src="./img/seq.jpg" style="border-radius: 14px;border: 2px solid #a1a1a1;width: 279;
                                                                      height: 187;  margin-left: 177px;"></a>
                                                          
         <a href="./professionalN.php?id=Associação&v=3"><img title="Associação" src="./img/square.jpg" style="border-radius: 14px;border: 2px solid #a1a1a1;width: 279;
                                                                       height: 187;"></a>
                                                           
         <a href="./professionalN.php?id=Correspondência&v=4"><img title="Correspondência" src="./img/phrase.jpg" style="border-radius: 14px;border: 2px solid #a1a1a1;width: 279;
                                                           height: 187;  margin-left: 177px;"></a>
       
       <a href="./professionalN.php?id=Pares&v=5"><img  title="Pares" src="./img/memoryP.jpg" style="border-radius: 14px;border: 2px solid #a1a1a1;width: 279;
                                                                      height: 187;"></a>

        
    </div>
    <?php
}

//mailbox
function mailbox() {

    $ligacao = connect();


    $professional = $_SESSION['professional'];

  $query=("SELECT Distinct  Po.name,Pa.message,Pa.send_date,Pa.send_time, Pa.subject, Pa.id
                                  FROM professional P, mailbox Pa,patient Po
                                  WHERE Pa.receiver = '$professional' and Pa.sender=Po.nif and Pa.status = 1" );


    $result = mysql_query($query, $ligacao);
    ?>  
    <h1>Mailbox</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Paciente</th>    
                    <th>Assunto</th>    
                    <th>Data</th>    
                    <th>Hora</th>    
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
    <?php
    while ($row = mysql_fetch_array($result)) {
        ?>
                    <tr>
                        <td> <?= $row[0] ?> </td>
                        <td> <?= $row[1] ?> </td>
                        <td> <?= $row[2] ?> </td>
                        <td> <?= $row[3] ?> </td>
                        <td><a id="d" href="./professional.php?mailboxd=<?= $row[4]; ?>&if=<?= $row[5]; ?>">  Ver    <span class='icon-search'  title='ver'></span></a><a href="./professional.php?id=<?= $row[5]; ?>">   Eliminar     <span class='icon-remove-sign' title='eliminar'></span></a></td>
                    </tr>
                    <tr class="toggle2">
                        <td></td>

                    </tr> 
        <?php
    }
    ?>
        </table>
    </div>
                <?php
            }
  function regMultiple($i,$v){
      ?><div id="perfis">
          <h1>Registo de exercício</h1>
          <fieldset>
          <form method="POST"  id="ExerciseForm" class="form-horizontal" role="form">
              <div class="form-group">
              <input type="hidden" name="structure" value="<?= $i;?>">
              <input type="hidden" name="structureid" value="<?= $v;?>">
            Nome:<br>
            <input type="text" value="" name="name">
            <br>
            Descrição: <br>
            <input type="text" value="" name="description">
            <br>
            Tarefa:<br>
            <input type="text" value="" name="instructions">
            <br>
                      <p>
                    <label> Nível: 
                        <select name="level"> 
                            <option value="1">Nível dificuldade baixo</option>
                            <option value="2">Nível dificuldade médio</option>
                            <option value="3">Nível dificuldade alto</option>
                        </select>
                    </label></p>
            <br>
   
     
            <input type="submit" value="Criar Exercício" name="subExercicio">
        </div>
            </form>
      </fieldset>
</div>
    <?php
        regExercise();
      
  } 
  
  function result($w){
      $i=mysql_fetch_array(listPatient(4, $_SESSION['patient']));
      $connection=  connect();
      ?>
    <div class="table-responsive">
    <h3>Resultado</h3>
    <fieldset>
        <div class="modal-body">
<?php if ($w==1){?>
                <p>Sessão:<?= $_GET['idSessao']; ?></p>
                <p>Exercício:<?= $_GET['id_exercicio']; ?></p>
                <p>Time:<?= $_GET['time']; ?></p>
                <p>Respostas Erradas:<?= $_GET['erradas']; ?></p>
                <p>Paciente:<?php echo $i[0]; 
                
               ?></p>


<?php
  //Fetching Values from URL
    $sessao = $_GET['idSessao'];
    $exercicio = $_GET['id_exercicio'];
    $time = $_GET['time'];
    $result = $_GET['erradas'];
//Insert query
    $ex="insert into report (result, sessions_completed, total_time,exercise_id) values ('$result', '$sessao', '$time','$exercicio')";
    $query = mysql_query($ex,$connection);
    if($query==TRUE){ ?><script>alertify.alert("Sucesso.", function () {
                    alertify.message('OK');
                });</script><?php
    }  else { ?><script>alertify.alert("Sem sucesso.", function () {
                    alertify.message('OK');
                });</script><?php
    
}


}  elseif ($w==2) {
    ?>
              
                <p>Time:<?= $_GET['time']; ?></p>
                <p>Respostas Erradas:<?= $_GET['erradas']; ?></p>
               
    
    
    <?php
    
}
  
    mysql_close($connection); // Connection Closed



?>


        </div>
    </fieldset>
</div>
    <?php
  } 
   
  
  function sessionBox() {

    $ligacao = connect();


    $professional = $_SESSION['patient'];

    $query = ("SELECT distinct Pa.patient_nif,Pa.date,Pa.done,Pa.id_exercise, Pa.professional_r,Pa.id_sessions
                                  FROM professional P, sessions Pa,patient Po
                                  WHERE Pa.patient_nif = '$professional' and Pa.professional_r=P.nif and Pa.done = 1" );


    $result = mysql_query($query, $ligacao);
    ?>  
    <h1>Sessões a realizar</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Data </th>    
                    <th>Exercício</th>    
                     <th>Opções</th>
                </tr>
            </thead>
            <tbody>
    <?php
    while ($row = mysql_fetch_array($result)) {
        ?>
                    <tr>
                      
                        <td> <?= $row[1] ?> </td>
                        
                        <td> <?=  $row[3];?> </td>
                        <td><a id="d" href="./patient.php?sessionsID=<?= $row[5]; ?>&idE=<?= $row[3]; ?>"> Realizar   <span class='icon-search'  title='ver'></span></a></td>
                    </tr>
                   
        <?php
    }
    ?>
        </table>
    </div>
                <?php
            }