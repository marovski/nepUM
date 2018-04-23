<?php 
$exercicio = $_GET['idE'];
$string = "Pera;;Melancia;;Banana;;Kiwi";
$imagens = "../img/fruit3.jpg;;../img/fruit2.jpg;;../img/fruit1.jpg;;../img/fruit4.jpg";
$instrucoes = "Ordene por ordem alfabética";
$resposta = "Banana;;Kiwi;;Melancia;;Pera";
$idSessao = $_GET['sessionsID'];
?>
<html>
<head>

        <meta charset="UTF-8">
        <style>#jogo{
}
#all{
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    width: 750px;
    z-index: -1;
}
#all table{
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}
#Exercicio table:hover{
    
}

td, th {
    border: none;
    background-color: white;
}

.selected{
    margin-top: 10px;
    margin-bottom: 30px;
    border-color: limegreen;
    border-width: 5px;
    border-radius: 10px;
    z-index: 8;
}

.selected:hover{
    cursor:pointer; cursor: hand;
}

.correct{
    border:3px solid limegreen; 
    border-radius: 10px;
}

.wrong{
    border:3px solid red; 
    border-radius: 10px;
}

.option{
    margin-top: 10px;
    margin-bottom: 30px;
    border-width: 5px;
    z-index: 8;
}
.option:hover{
    cursor:pointer; cursor: hand;
}

.dragged {
    cursor:pointer; cursor: hand;
    position: absolute;
    background-color: white;
    opacity: 100;
    z-index: 2;
}</style>
        <script type="text/javascript">
            var str = <?php echo json_encode($string) ?>;
            var img = <?php echo json_encode($imagens) ?>;
            var instrucoes = <?php echo json_encode($instrucoes) ?>;
            var resposta = <?php echo json_encode($resposta) ?>;
            var id = <?php echo json_encode($exercicio) ?>;
            var idSess = <?php echo json_encode($idSessao) ?>;
            function $(doc) {
    return document.getElementById(doc);
}
var idExercicio;
var idSessao;
var frases = [];
var start;
var end;
var totalTime;
var idPecas = [];
var imagens = [];
var correct = "";
var erradas = 0;
var time;

var idSelected = "AA";

function transformCorrect() {
    var str = correct;
    var array = str.split(";;");
    str = "";
    for (var i = 0; i < array.length; i++) {
        var img = document.createElement('img');
        img.src = array[i];
        img.id = "GameCheck";
        $('jogo').appendChild(img);
        str += $('GameCheck').src;
        $('GameCheck').remove();
    }
    correct = str;
}

function init(string, img, instrucoes, resposta, id_exercicio, idSess) {
    idSessao = idSess;
    idExercicio = id_exercicio;
    var frase = string;
    var array = frase.split(";;");
    document.getElementById("instrucoes").innerHTML = instrucoes;
    if (frase.length > 0) {
        for (var i = 0; i < array.length; i++) {
            frases.push(array[i]);
        }
    }

    frase = img;
    if (frase.length > 0) {
        var array = frase.split(";;");
        for (var i = 0; i < array.length; i++) {
            imagens.push(array[i]);
        }
    }

    if (frases.length >= imagens.length) {
        for (var i = 0; i < frases.length; i++) {
            addTable(i);
        }
    }
    else {
        for (var i = 0; i < imagens.length; i++) {
            addTable(i);
        }
    }

    correct = resposta;
    $("instrucoes").innerHTML += "</br>";
    var myTableDiv = document.getElementById("instrucoes");
    var button = document.createElement('input');
    button.type = 'button';
    button.id = 'Responder';
    button.value = 'Responder';
    button.name = 'Responder';
    button.onclick = function() {
        if (answer()) {
            $("all").className = "correct";
            end = new Date().getTime();
            time = end - start;
            removeAll();
            showTime(time);
        } else {
            $("all").className = "wrong";
            erradas++;
        }
    }
    button.style.margin = "0px";
    myTableDiv.innerHTML += "</br>"
    myTableDiv.appendChild(button);
    resize_images(300, 300, 300, 300);
    start = new Date().getTime();
}

function addTable(tableid) {

    var myTableDiv = document.getElementById("jogo");

    var table = document.createElement('TABLE');
    table.border = '2';
    table.id = "" + tableid;
    table.style.width = "300px";
    table.className = "option";
    table.onclick = function() {
        checkSwitch(tableid);
    };
    idPecas.push(tableid);
    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);

    if (!(imagens.length == 0)) {
        var tr = document.createElement('TR');
        tr.border = '0';
        tableBody.appendChild(tr);


        var td = document.createElement('TD');
        td.border = '0';
        td.id = "" + tableid + "0";
        td.width = '';
        var img = document.createElement('img');
        img.src = imagens[tableid];
        img.className = "GameImg";
        td.appendChild(img);
        tr.appendChild(td);
    }
    if (!(frases.length == 0)) {
        var tr = document.createElement('TR');
        tr.border = '0';
        tableBody.appendChild(tr);

        var td = document.createElement('TD');
        td.border = '0';
        td.id = "" + tableid + "1";
        td.width = '';
        td.appendChild(document.createTextNode("" + frases[tableid]));
        tr.appendChild(td);
    }


    myTableDiv.appendChild(table);

}

function checkSwitch(id) {
    if (idSelected == "AA") {
        idSelected = id;
        selectId(idSelected);
        return false;
    }
    else if (idSelected == id) {
        unselectId(idSelected);
        idSelected = "AA";
        return false;
    }
    else if (!(idSelected == id)) {
        var nova;
        if (frases.length > 0) {
            nova = getTableContent(id);
            setTableContent(id, getTableContent(idSelected));
            setTableContent(idSelected, nova);
        }
        if (imagens.length > 0) {
            nova = getTableContent2(id);
            setTableContent2(id, getTableContent2(idSelected));
            setTableContent2(idSelected, nova);
        }
        unselectAll();
        return true;
    } else {
        unselectId(idSelected);
        idSelected = "AA";
        return false;
    }
}

function unselectAll() {
    for (var i = 0; i < idPecas.length; i++) {
        $(idPecas[i]).className = "option";
    }
    idSelected = "AA";
}
function selectId(id) {
    for (var i = 0; i < idPecas.length; i++) {
        $(idPecas[i]).className = "option";
    }
    $(id).className = "selected";
}

function unselectId(id) {
    $(id).className = "option";
}

function getTableContent(id) {
    var td = $(id + "1");
    var y = td.childNodes[0];
    var txt = y.nodeValue;
    return txt;
}

function setTableContent(id, string) {
    var td = $(id + "1");
    var y = td.childNodes[0];
    y.nodeValue = string;
}

function getTableContent2(id) {
    var td = $(id + "0");
    var y = td.childNodes[0];
    var txt = y.src;
    return txt;
}

function setTableContent2(id, string) {
    var td = $(id + "0");
    var y = td.childNodes[0];
    y.src = string;
}

function answer() {
    var resp = "";
    if (frases.length >= imagens.length) {
        for (var i = 0; i < idPecas.length; i++) {
            resp += getTableContent(idPecas[i]) + ";;";
        }
    } else {
        transformCorrect();
        var imgs = img_find();
        for (var i = 0; i < imgs.length; i++) {
            resp += getTableContent2(imgs[i]) + ";;";
        }
    }
    var ans = resp.substring(0, resp.length - 2);
    return (ans == correct);
}

function img_find() {
    var imgs = document.getElementsByClassName("GameImg");
    var imgSrcs = [];

    for (var i = 0; i < imgs.length; i++) {
        imgSrcs.push(imgs[i].src);
    }

    return imgSrcs;
}

function showTime(time) {
    var myDiv = document.getElementById("all");
    var doc = document.getElementById("h2answer");
    if (!(doc == null)) {
        myDiv.removeChild(doc);
    }
    var h2 = document.createElement('h2');
    h2.innerHTML = "Respostas erradas: " + erradas;
    h2.id = "h2answer";
    myDiv.appendChild(h2);
    var seconds = Math.floor((time / 1000) % 60);
    var minutes = Math.floor(((time - seconds) / 1000) / 60);
    document.getElementById("instrucoes").innerHTML = "" + minutes + " minutos e " + seconds + " segundos";
}

function removeAll() {
    for (var i = 0; i < idPecas.length; i++) {
        $(idPecas[i]).remove();
    }
    $("Responder").remove();
    drawExitButton();
}

function drawExitButton() {
    var f = document.createElement("form");
    f.setAttribute('method', "get");
    f.setAttribute('action', "");


    var i = document.createElement("input"); //input element, text
    i.setAttribute('type', "hidden");
    i.setAttribute('name', "time");
    i.setAttribute('id', 'time');
    i.setAttribute('value', Math.floor((time / 1000) % 60));
    
    f.appendChild(i);

    var a= document.createElement("input"); //input element, text
    a.setAttribute('type', "hidden");
    a.setAttribute('name', "erradas");
    a.setAttribute('id', 'erradas');
    a.setAttribute('value', erradas);
    
    f.appendChild(a);

    var e = document.createElement("input"); //input element, text
    e.setAttribute('type', "hidden");
    e.setAttribute('name', "id_exercicio");
    e.setAttribute('id', 'id_exercicio');
    e.setAttribute('value', idExercicio);
    
    f.appendChild(e);

    var d = document.createElement("input"); //input element, text
    d.setAttribute('type', "hidden");
    d.setAttribute('name', "idSessao");
    d.setAttribute('id', 'idSessao');
    d.setAttribute('value', idSessao);
    
    f.appendChild(d);

    f.innerHTML += "</br>";
    var s = document.createElement("input"); //input element, Submit button
    s.setAttribute('type', "Submit");
    s.setAttribute('name', "exercicio");
    s.setAttribute('value', "Sair");
    f.appendChild(s);

    document.getElementById('all').appendChild(f);
}

function resize_images(maxht, maxwt, minht, minwt) {
    var imgs = document.getElementsByClassName('GameImg');

    var resize_image = function(img, newht, newwt) {
        img.height = newht;
        img.width = newwt;
    };

    for (var i = 0; i < imgs.length; i++) {
        var img = imgs[i];
        if (img.height > maxht || img.width > maxwt) {
            // Use Ratios to constraint proportions.
            var old_ratio = img.height / img.width;
            var min_ratio = minht / minwt;
            // If it can scale perfectly.
            if (old_ratio === min_ratio) {
                resize_image(img, minht, minwt);
            }
            else {
                var newdim = [img.height, img.width];
                newdim[0] = minht;  // Sort out the height first
                // ratio = ht / wt => wt = ht / ratio.
                newdim[1] = newdim[0] / old_ratio;
                // Do we still have to sort out the width?
                if (newdim[1] > maxwt) {
                    newdim[1] = minwt;
                    newdim[0] = newdim[1] * old_ratio;
                }
                resize_image(img, newdim[0], newdim[1]);
            }
        }
    }
}
        </script>
   
    
</head>
<body onload="init(str, img, instrucoes, resposta, id, idSess);">
    <div id="all">
            <h1>Clique nos blocos para os trocar</h1>
            <h2 id="instrucoes"></h2>
            <div id="jogo">

            </div>
        </div>
</body>
</html>