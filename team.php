<?php
require_once './include/functionH.php';
?>
 
<style>
    div.conteudogeralequipas{
        width: auto;
        margin: 0 auto; 
        text-align: left;
        background: #FFF; 
    }

    .aba1 {

        margin-top: 20px;
        white-space: nowrap;

    }
    #tabs-1,#tabs-2{

        background: #FFF 
    }
    #tabs ul li a{
        font-family: inherit;
        font-weight: bold;
        color: white;
    }
    #tabs li {
        background: #7e1515;
    }
    #tabs ul{
        background: #7e1515;
    }

    #pub ul{
        background-color: white;
    }
    #pub ul li {
        background-color: white;
    }
    #tabs  #pub ul li a{
        background-color: white;
        font-family: inherit;
        color: black;
    }

    #comunicacao ul{
        background-color: white;
    }
    #comunicacao ul li {
        background-color: white;
    }
    #comunicacao  #pub ul li a{
        background-color: white;
        font-family: inherit;
        color: black;
    } 
    #teses ul{
        background-color: white;
    }
    #teses ul li {
        background-color: white;
    }
    #tabs  #teses ul li a{
        background-color: white;
        font-family: inherit;
        color: black;
    }
    .aba2{
        position: absolute;
        margin-left: 276px;
        margin-top: -201px

    }

    .aba3{
        position: absolute;
        margin-left: 559px;
        margin-top: -221px;

    }/*

   
    */table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-left: auto;
        margin-right: auto;
        font-family: sans-serif;

    }


    th { 

        color: white; 
        font-weight: bold; 
        text-align: left;
    }
    td, th { 
        padding: 6px; 

        text-align: left; 

    }
    .d{
        border: 1px solid #ccc; 
          width: 150px;
  height: 137px;
  border-radius: 2px;
    }

</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>




<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1" style="cursor: pointer;"><span class="icon-briefcase"></span> Equipa</a></li>
        <li><a href="#tabs-2" style="cursor: pointer;"><span class="glyphicon glyphicon-book"></span> Produção científica</a></li>
    </ul>
    <div id="tabs-1">
        <div class="conteudogeralequipas">
            <?php
            $ligacao = connect();
            $diretor = "SELECT * FROM team WHERE role='Diretor' or role='Co-Diretor'" or die(mysql_error());
            $query_dir = mysql_query($diretor, $ligacao) or die(mysql_error());
            if (mysql_num_rows($query_dir) > 0) {
                $index = 0;
                ?> <h3>Diretores</h3>
                <?php
                while ($row = mysql_fetch_array($query_dir)) {
                    $boxid = ($index % 3) + 1;

                    if ($index == 3) {

                        echo "<br/><br/></br>";
                        $index = 0;
                    }

                    $index++;
                    echo '<table class="table">';
                    echo '<tr class="aba' . $boxid . '">';
                    echo '<td class="box' . $boxid . '"> <img class="d" src="' . $row['image'] . '" width="100px" height="100px"/>&nbsp ' . '<br>' . $row['name'] . ' </td>';

                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?> 
        </div>

        <div class="conteudogeralequipas">
            <?php
            $investigadores = "SELECT * FROM team WHERE role='Researchers'" or die(mysql_error());
            $query_inv = mysql_query($investigadores, $ligacao) or die(mysql_error());
            if (mysql_num_rows($query_inv) > 0) {
                $index = 0;
                echo '<h3>Investigadores</h3>';
                while ($row = mysql_fetch_array($query_inv)) {
                    $boxid = ($index % 3) + 1;

                    if ($index == 3) {


                        $index = 0;
                    }

                    $index++;
                    echo '<table class="table">';

                    echo '<tr class="aba' . $boxid . '">';
                    echo '<td class="box' . $boxid . '"> <img class="d"  src="' . $row['image'] . '" width="100px" height="100px"/>&nbsp ' . '<br>' . $row['name'] . ' </td>';


                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?></div>
        <br><br>
        <div class="conteudogeralequipas">
            <?php
            $phd = "SELECT * FROM team WHERE role='PhD Students'" or die(mysql_error());
            $query_phd = mysql_query($phd, $ligacao) or die(mysql_error());
            if (mysql_num_rows($query_phd) > 0) {
                $index = 0;
                echo '<h3>Estudantes</h3>';
                while ($row = mysql_fetch_array($query_phd)) {
                    $boxid = ($index % 3) + 1;

                    if ($index == 3) {

                        echo "<br/><br/></br>";
                        $index = 0;
                    }

                    $index++;
                    echo '<table class="table">';
                    echo '<tr class="aba' . $boxid . '">';
                    echo '<td class="box' . $boxid . '"> <img class="d"  src="' . $row['image'] . '" width="100px" height="100px"/>&nbsp ' . '<br>' . $row['name'] . ' </td>';
                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?>
        </div>
        <br><br><br><br>
        <div class="conteudogeralequipas">
            <?php
            $assis = "SELECT * FROM team WHERE role='Research Assistant'" or die(mysql_error());
            $query_assis = mysql_query($assis, $ligacao) or die(mysql_error());
            if (mysql_num_rows($query_assis) > 0) {
                $index = 0;
                echo '<h3>Investigador assistente</h3>';
                while ($row = mysql_fetch_array($query_assis)) {
                    $boxid = ($index % 3) + 1;

                    if ($index == 3) {

                        echo "<br/><br/></br>";
                        $index = 0;
                    }

                    $index++;
                    echo '<table class="table">';
                    echo '<tr class="aba' . $boxid . '">';
                    echo '<td class="box' . $boxid . '"> <img class="d"      src="' . $row['image'] . '" width="100px" height="100px"/>&nbsp ' . '<br>' . $row['name'] . ' </td>';

                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?>
        </div>
        <div class="conteudogeralequipas">
            <?php
            $col = "SELECT * FROM team WHERE role = 'Collaborators'" or die(mysql_error());
            $query_col = mysql_query($col, $ligacao) or die(mysql_error());
            if (mysql_num_rows($query_col) > 0) {
                $index = 0;
                echo '<h3>Colaboradores</h3>';
                while ($row = mysql_fetch_array($query_col)) {
                    $boxid = ($index % 3) + 1;

                    if ($index == 3) {

                        echo "<br/><br/></br>";
                        $index = 0;
                    }

                    $index++;
                    echo '<table class="table">';
                    echo '<tr class="aba' . $boxid . '">';
                    echo '<td class="box' . $boxid . '"> <img class="d"             src="' . $row['image'] . '" width="100px" height="100px"/>&nbsp ' . '<br>' . $row['name'] . ' </td>';

                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?></div>
        <br><br>
        <div class="conteudogeralequipas">
            <?php
            $lab = "SELECT * FROM team WHERE role = 'Lab Technician'" or die(mysql_error());
            $query_lab = mysql_query($lab, $ligacao) or die(mysql_error());
            if (mysql_num_rows($query_lab) > 0) {
                $index = 0;
                echo '<h3>Técnico de laboratório</h3>';
                while ($row = mysql_fetch_array($query_lab)) {
                    $boxid = ($index % 3) + 1;

                    if ($index == 3) {

                        echo "<br/><br/></br>";
                        $index = 0;
                    }

                    $index++;
                    echo '<table class="table">';
                    echo '<tr class="aba' . $boxid . '">';
                    echo '<td class="box' . $boxid . '"> <img class="d"          src="' . $row['image'] . '" width="100px" height="100px"/>&nbsp ' . '<br>' . $row['name'] . ' </td>';

                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?>
        </div>
    </div>
    <div id="tabs-2">
        <h3 onclick="showDiv('#pub')" style="cursor: pointer;">Publicações</h3>
        <div id="pub" style="display: none;">
            <p>Nesta página poderá encontrar uma lista da actividade científica dos membros da equipa do NEP-UM no âmbito deste projeto.</p>
            <ul>
                <li>
                    <p> Alves, J., Magalhães, R., Thomas, R. E., Gonçalves, O. F., Petrosyan, A. & Sampaio, A. (2013). <a href="http://journals.lww.com/alzheimerjournal/Pages/default.aspx?PAPNotFound=true" style="cursor:pointer;">Is there evidence for cognitive intervention in Alzheimer's disease? A systematic review of efficacy, feasibility and cost-effectiveness</a>. Alzheimer Disease and Associated Disorders.
                    </p>

                </li>

                <li>
                    <p>  Alves, J., Magalhães, R., Castiajo, P., Arantes, M., Sampaio, A. & Gonçalves, O. F. (2012). <a href="http://neuro.psychiatryonline.org/doi/abs/10.1176/appi.neuropsych.11060128">Domain-specific and generalization effects of cognitive intervention in diffuse axonal injury: a case report</a>. Journal of Neuropsychiatry and Clinical Neurosciences, 24, e19-e20.
                    </p>
                </li>

                <li>
                    <p>
                        Alves, J., Magalhães, R., Sampaio, A. & Gonçalves, O. F. (2011). <a href="http://www.sciencedirect.com/science/article/pii/S1552526011029062">Cognitive intervention in Alzheimer’s disease: a treatment option to consider</a>Alzheimer's & Dementia: The Journal of the Alzheimer's Association, 7(4), e44.
                    </p>
                </li>

                <li>
                    <p>
                        Alves, J., Magalhães, R., Cruz, S., Sampaio, A. & Gonçalves, O. F. (2011). <a href="http://www.sciencedirect.com/science/article/pii/S1552526011029050">Cognitive intervention in a variant of Alzheimer's disease: a case report</a>. Alzheimer's & Dementia: The Journal of the Alzheimer's Association, 7(4), e44.
                    </p>
                </li>

                <li>
                    <p>
                        Capitão, L., Sampaio, A., Férnandez, M., Sousa, N., Pinheiro, A., & Gonçalves, O. (2011). Williams Syndrome hypersociability: a Neuropsychological study of the Amygdala and Prefrontal Hypothesis. Research in Developmental Disabilities, 32(3):1169-79.
                    </p>
                </li>

                <li>
                    <p>
                        Fernández, M., Sampaio, A., Lens, M., Carracedo, A., Gonçalves, O.F. Longitudinal Assessment of Narrative Profile in a Williams Syndrome Patient. British Journal of Developmental Disabilities, In Press.
                    </p>
                </li>

                <li>
                    <p>
                        Elena Garayzábal, Magdalena Capó, Esther Moruno, Óscar F. Gonçalves, Montserrat Férnandez, María Lens, Adriana Sampaio. Is There a Common Narrative Production Phenotype in Uncommon Genetic Syndromes? A Preliminary Study with Williams, Smith-Magenis and Prader-Willi Syndromes. British Journal of Developmental Disabilities, In Press.
                    </p>
                </li>

                <li><p>
                        Pinheiro, A., Galdo-Álvarez, S., Sampaio, A., Niznikiewicz, M., & Gonçalves, O.F. Electrophysiological correlates of semantic processing in Williams syndrome, Research in Developmental Disabilities, 31 (2010) 1412–1425.
                    </p>
                </li>

                <li><p>
                        Pinheiro, A., Galdo-Álvarez, S., Rauber, A., Sampaio, A., Niznikiewicz, M., & Gonçalves, O.F. (2011). Abnormal processing of emotional prosody in Williams syndrome: An event-related potentials study. Research in Developmental Disabilities, 32(1):133-47.
                    </p>
                </li>

                <li>
                    <p>
                        Gonçalves, O., Pinheiro, A., Sampaio, A., Sousa, N., Férnandez, M., & Rangel, M. Autobiographical Narratives in Williams Syndrome: Structural, Process and Content Dimensions. Journal of Developmental and Physical Disabilities, In Press.
                    </p>
                </li>

                <li>
                    <p>
                        Natalia Rossi, Célia Giacheti, Elena Garazayzábal-Heinze, Adriana Sampaio, Óscar F. Gonçalves. (2012). Psycholinguistic Abilities of Williams Syndrome. Research in Developmental Disabilities, 33, 819–824.
                    </p>
                </li>
            </ul>
            <br><br>
        </div>
        <h3 onclick="showDiv('#comunicacao')" style="cursor: pointer;">Comunicações</h3>
        <div id="comunicacao" style="display: none;">
            <ul>
                <li>
                    <P> Alves, J., Soares, J. M., Sampaio, A. & Gonçalves, O. F. (2012, June). Cognitive profile and cerebral morphometry of Posterior Cortical Atrophy and Alzheimer's disease. Oral communication presented at 26ª Reunião do Grupo de Estudo de Envelhecimento Cerebral e Demências, Tomar, Portugal.
                    </p>
                </li>

                <li>
                    <p>
                        Alves, J., Magalhães, R., Gonçalves, O. F. & Sampaio, A. (2012, June). Psychosocial therapies for Alzheimer's disease: Is there evidence for Cognitive Intervention Poster session presented at 26ª Reunião do Grupo de Estudo de Envelhecimento Cerebral e Demências, Tomar, Portugal.
                    </p>
                </li>

                <li>
                    Alves, J., Magalhães, R., Gonçalves, O. F. & Sampaio, A. (2012, June). Custo-efetividade e viabilidade da reabilitação neuropsicológica na demência do tipo Alzheimer. Poster session presented at 26ª Reunião do Grupo de Estudo de Envelhecimento Cerebral e Demências, Tomar, Portugal.
                </li>

                <li>
                    Sampaio, A., Magalhães, R., Alves, J., Paiva, S., Machado, A., Palavra, F., Gonçalves, J.G., Gonçalves, O.G. (2012, May). Treino cognitivo em perturbações cerebrais: avaliação neuropsicológica e neuroimagiológica. Oral communication presented at NEURO 2012 (organized by the Portuguese Societies of Neurology and Neurosurgery), Porto, Portugal.
                </li>

                <li>
                    Alves, J., Magalhães, R., Arantes, M., Cruz, S., Gonçalves, O. F. & Sampaio, A. (2012, March). Avaliação e Intervenção em Problemas Visuais decorrentes de Doença Neurodegenerativa: Relato de um Caso. Oral communication presented at the Congresso Português de Reabilitação Visual, Aveiro, Portugal.
                </li>

                <li>
                    <p>  Alves, J., Magalhães, R., Castiajo, P., Gonçalves, O.F. & Sampaio, A. (2011, November). Towards an evidence-based practice of cognitive intervention: integrating research and practice. Oral communication presented at the II International Symposium on Neuropsychology and Rehabilitation, Vila Nova de Gaia, Portugal.
                    </p> </li>

                <li>
                    <p> Alves, J., Gonçalves, O. F., Magalhães, R. & Sampaio, A. (2011, September). Computer-based cognitive intervention in Alzheimer’s disease. Poster session presented at the Global Alzheimer’s Research Summit, Madrid, Spain.
                    </p>
                </li>

                <li>
                    <p> Alves, J., Magalhães, R., Sampaio, A. & Gonçalves, O. F. (2011, July). Cognitive intervention in Alzheimer’s disease: a treatment option to consider? Poster presented at AAIC 2011 - Alzheimer's Association 2011 International Conference, Paris, France.
                    </p>
                </li>

                <li>
                    <p> Alves, J., Magalhães, R., Cruz, S., Sampaio, A. & Gonçalves, O. F. (2011, July). Cognitive intervention in a variant of Alzheimer's disease: a case report. Poster presented at AAIC 2011 - Alzheimer's Association 2011 International Conference, Paris, France.
                    </p> </li>

                <li>
                    <p> Alves, J., Gonçalves, O. F., Magalhães, R. & Sampaio, A. (2010, October).La computadora en la intervención en la demencia de Alzheimer. Poster session presented at the IV Congreso Nacional de Alzheimer/IV Conferencia Iberoamericana sobre la enfermedad de Alzheimer, Seville, Spain.</p>
                </li>
            </ul>
            <br><br>
        </div>
        <h3 onclick="showDiv('#teses')" style="cursor: pointer;">Teses</h3>
        <div id="teses" style="display: none;">
            <ul>
                <li>
                    Pinheiro, A. (2010). Language and communication abnormalities in Williams Syndrome and Schizophrenia: Event-related potentials (ERP) evidence. Dissertação de Doutoramento: Universidade do Minho.
                </li>

                <li>
                    Coelho, J. (2011). Avaliação longitudinal das competências narrativas em crianças com Síndrome de Williams. Tese de Mestrado: Universidade Católica Portuguesa.
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
mysql_free_result($query_dir) or die(mysql_error());
mysql_free_result($query_assis) or die(mysql_error());
mysql_free_result($query_col) or die(mysql_error());
mysql_free_result($query_inv) or die(mysql_error());
mysql_free_result($query_lab) or die(mysql_error());
mysql_free_result($query_phd) or die(mysql_error());
mysql_close($ligacao);
?>