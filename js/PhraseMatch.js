function $(doc) {
    return document.getElementById(doc);
}
var idExercicio;
var idSessao;
var frasesEsquerda = [];
var frasesDireita = [];
var start;
var end;
var time;
var totalTime;
var idPecas = [];
var posicoes = [];
var correct = [];
var erradas = 0;

var idSelected = "";
var idPares = [];


function checkConnection(id) {
    if (idSelected == "") {
        idSelected = id;
        selectId(id);
        return false;
    }
    else if (idSelected == id) {
        unselectId(idSelected);
        idSelected = "";
        return false;
    }
    else if (checkSides(id)) {
        unselectId(idSelected);
        idSelected = "";
        return false;
    }
    else if (completelyExists(id)) {
        eraseLine(id);
        unselectId(idSelected);
        idSelected = "";
        return false
    }
    else if ((idExists(id))) {
        eraseLine(id);
        unselectId(idSelected);
        return true;
    }
    else if (!(idSelected == id) && !(idSelected == "") && !idExists(id)) {
        unselectId(idSelected);
        return true;
    }
}

function completelyExists(id) {
    var sigla = id.charAt(0);
    var par;
    if (sigla == "E") {
        par = ("" + id + idSelected);
    } else {
        par = ("" + idSelected + id);
    }
    var bool = false;
    for (var i = 0; i < idPares.length; i++) {
        if (idPares[i] == par) {
            bool = true;
        }
    }
    return bool;
}
function eraseLine(id) {
    var sigla = id.charAt(0);
    if (sigla == "E") {
        for (var i = 0; i < idPares.length; i++) {
            var sigla1 = idPares[i].substring(0, id.length);
            if (sigla1 == id) {
                $(idPares[i]).remove();
                idPares.splice(i, 1);
            }
        }
    } else {
        for (var i = 0; i < idPares.length; i++) {
            var index = idPares[i].indexOf("D");
            var sigla1 = idPares[i].substring(index, idPares[i].length);
            if (sigla1 == id) {
                $(idPares[i]).remove();
                idPares.splice(i, 1);
            }
        }
    }
}

function idExists(id) {
    var bool;
    var sigla = id.charAt(0);
    if (sigla == "E") {
        bool = checkLeftSide(id);
    } else {
        bool = checkRightSide(id);
    }
    if (bool == null) {
        bool = false;
    }
    return bool;
}

function checkLeftSide(id) {
    for (var i = 0; i < idPares.length; i++) {
        var sigla = idPares[i].substring(0, id.length);
        if (sigla == id) {
            return true;
        }
    }
    return false;
}
function checkRightSide(id) {
    for (var i = 0; i < idPares.length; i++) {
        var index = idPares[i].indexOf("D");
        var sigla = idPares[i].substring(index, idPares[i].length);
        if (sigla == id) {
            return true;
        }
    }
    return false;
}

function selectId(id) {
    $(id).className = "option selected";
}

function unselectId(id) {
    $(id).className = "option";
}

function checkSides(id) {
    var sigla = id.charAt(0);
    var sigla1 = idSelected.charAt(0);
    if (sigla == sigla1) {
        return true;
    }
    else {
        return false;
    }
}

function idPush(id) {
    var sigla = id.charAt(0);
    if (sigla == "E") {
        idPares.push("" + id + idSelected);
    } else {
        idPares.push("" + idSelected + id);
    }
}

function getXValue(id) {
    var sigla = id.substring(0, id.length - 1);
    if (sigla == "E") {
        return getLeftPosition(id);
    }
    else if (sigla == "D") {
        return getLeftPosition(id) + 7;
    }
    else {
        alert("Erro");
    }
}

function getYValue(id) {
    if ($(id).offsetHeight >= 50) {
        return getTopPosition(id) + 46;
    }
    else {
        return getTopPosition(id) + 35;
    }
}

function init(stringEsquerda, stringDireita, instrucoes, resposta, id_exercicio, idSess) {
    idSessao = idSess;
    idExercicio = id_exercicio;
    var frase = stringEsquerda;
    var array = frase.split(";;");
    document.getElementById("instrucoes").innerHTML = instrucoes;
    for (var i = 0; i < array.length; i++) {
        frasesEsquerda.push(array[i]);
    }
    frase = stringDireita;
    array = frase.split(";;");
    for (var i = 0; i < array.length; i++) {
        frasesDireita.push(array[i]);
    }
    for (var i = 0; i < frasesEsquerda.length; i++) {
        addTable(i, "Esquerda");
    }
    for (var i = 0; i < frasesDireita.length; i++) {
        addTable(i, "Direita");
    }
    $("instrucoes").innerHTML += "</br>"
    prepareAnswer(resposta);
    var myTableDiv = document.getElementById("instrucoes");
    var button = document.createElement('input');
    button.type = 'button';
    button.id = 'Responder';
    button.value = 'Responder';
    button.name = 'Responder';
    button.onclick = function() {
        if (victory()) {
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
    start = new Date().getTime();
}


function addTable(tableid, side) {
    var frases;
    var sigla;
    if (side == "Esquerda") {
        frases = frasesEsquerda;
        sigla = "E";
    }
    else if (side == "Direita") {
        frases = frasesDireita;
        sigla = "D";
    }
    else {
        frases = null;
        sigla = null;
    }
    var myTableDiv = document.getElementById("all");

    var table = document.createElement('TABLE');
    table.border = '2';
    table.id = "" + sigla + tableid;
    idPecas.push(sigla + tableid);
    table.style.width = "300px";
    table.className = "option";
    if (side == "Esquerda") {
        myTableDiv = $('EsquerdaTab');
    }
    else if (side == "Direita") {
        myTableDiv = $('DireitaTab');
    }
    else {
        alert("left: " + getLeftPosition(table.id) + " top: " + getTopPosition(table.id));
    }
    table.onclick = function() {
        if (checkConnection(table.id)) {
            linedraw(getXValue(idSelected), getYValue(idSelected), getXValue(table.id), getYValue(table.id), table.id);
            idSelected = "";
        }

    }

    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);

    if (!(frases.length == 0)) {
        var tr = document.createElement('TR');
        tr.border = '0';
        tableBody.appendChild(tr);

        str = "frase";

        var td = document.createElement('TD');
        td.border = '0';
        td.id = "" + sigla + tableid + "1";
        td.width = '';
        td.appendChild(document.createTextNode("" + frases[tableid]));
        tr.appendChild(td);
    }
    myTableDiv.appendChild(table);
    var button = document.createElement('input');
    button.type = 'button';
    button.className = "circle";
    if (table.offsetHeight >= 50) {
        button.className = "circle extra";
    }
    if (side == "Esquerda") {
        myTableDiv = $('EsquerdaButton');
    }
    if (side == "Direita") {
        myTableDiv = $('DireitaButton');
    }
    myTableDiv.appendChild(button);
    myTableDiv.innerHTML += "</br>";
}

function getTopPosition(id) {
    var bodyRect = document.body.getBoundingClientRect();
    var elemRect = $("" + id).getBoundingClientRect();
    var offset = elemRect.top - bodyRect.top;
    return offset;
}

function getLeftPosition(id) {
    var bodyRect = document.body.getBoundingClientRect();
    var elemRect = $("" + id).getBoundingClientRect();
    var offset = elemRect.left - bodyRect.left;
    return offset;
}

function linedraw(x1, y1, x2, y2, id) {

    if (y1 < y2) {
        var pom = y1;
        y1 = y2;
        y2 = pom;
        pom = x1;
        x1 = x2;
        x2 = pom;
    }

    var a = Math.abs(x1 - x2);
    var b = Math.abs(y1 - y2);
    var c;
    var sx = (x1 + x2) / 2;
    var sy = (y1 + y2) / 2;
    var width = Math.sqrt(a * a + b * b);
    var x = sx - width / 2;
    var y = sy;

    a = width / 2;

    c = Math.abs(sx - x);

    b = Math.sqrt(Math.abs(x1 - x) * Math.abs(x1 - x) + Math.abs(y1 - y) * Math.abs(y1 - y));

    var cosb = (b * b - a * a - c * c) / (2 * a * c);
    var rad = Math.acos(cosb);
    var deg = (rad * 180) / Math.PI

    htmlns = "http://www.w3.org/1999/xhtml";
    div = document.createElementNS(htmlns, "div");
    div.setAttribute('style', 'border:1px solid black;width:' + width + 'px;height:0px;-moz-transform:rotate(' + deg + 'deg);-webkit-transform:rotate(' + deg + 'deg);position:absolute;top:' + y + 'px;left:' + x + 'px;');
    idPush(id);
    div.id = "" + idPares[idPares.length - 1];
    document.getElementById("all").appendChild(div);
}

function prepareAnswer(resposta) {
    var pares = resposta.split(";;");
    for (var i = 0; i < pares.length; i++) {
        addToCorrect(pares[i]);
    }
}

function addToCorrect(string) {
    var frases = string.split("---");
    var frase1 = "";
    var frase2 = "";
    var sigla1 = "";
    var sigla2 = "";
    if (!(frases.length == 2)) {

    }
    else {
        frase1 = frases[0];
        frase2 = frases[1];
    }
    for (var i = 0; i < idPecas.length; i++) {
        if (getTableContent(idPecas[i], "E") == frase1) {
            sigla1 = idPecas[i];
            break;
        }
    }
    for (var i = 0; i < idPecas.length; i++) {
        if (getTableContent(idPecas[i], "D") == frase2) {
            sigla2 = idPecas[i];
            break;
        }
    }
    var fim = "" + sigla1 + sigla2;
    correct.push(fim);
}

function getTableContent(id, l) {
    if (id.charAt(0) == l) {
        var td = $(id + "1");
        var y = td.childNodes[0];
        var txt = y.nodeValue;
        return txt;

    }
}

function victory() {
    var bool = true;

    for (var i = 0; i < correct.length; i++) {

        if (!(isInArray(correct[i], idPares))) {
            bool = false;
        }
    }
    return bool;
}

function isInArray(value, array) {
    return array.indexOf(value) > -1;
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
    for (var i = 0; i < idPares.length; i++) {
        $(idPares[i]).remove();
    }
    for (var i = 0; i < idPecas.length; i++) {
        $(idPecas[i]).remove();
    }
    $("Responder").remove();
    drawExitButton();
}

function drawExitButton() {
    var f = document.createElement("form");
    f.setAttribute('method', "post");
    f.setAttribute('action', "submitJogo.php");

    
    var i = document.createElement("input"); //input element, text
    i.setAttribute('type', "hidden");
    i.setAttribute('name', "time");
    i.setAttribute('id', 'time');
    i.setAttribute('value', time);
    i.disabled = true;
    f.appendChild(i);
    
    var i = document.createElement("input"); //input element, text
    i.setAttribute('type', "hidden");
    i.setAttribute('name', "erradas");
    i.setAttribute('id', 'erradas');
    i.setAttribute('value', erradas);
    i.disabled = true;
    f.appendChild(i);
    
    var i = document.createElement("input"); //input element, text
    i.setAttribute('type', "hidden");
    i.setAttribute('name', "id_exercicio");
    i.setAttribute('id', 'id_exercicio');
    i.setAttribute('value', idExercicio);
    i.disabled = true;
    f.appendChild(i);
    
    var i = document.createElement("input"); //input element, text
    i.setAttribute('type', "hidden");
    i.setAttribute('name', "idSessao");
    i.setAttribute('id', 'idSessao');
    i.setAttribute('value', idSessao);
    i.disabled = true;
    f.appendChild(i);
    
    f.innerHTML += "</br>";
    var s = document.createElement("input"); //input element, Submit button
    s.setAttribute('type', "Submit");
    s.setAttribute('value', "Sair");
    f.appendChild(s);

    document.getElementById('all').appendChild(f);
}
