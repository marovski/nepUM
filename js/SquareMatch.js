function $(doc) {
    return document.getElementById(doc);
}
var idExercicio;
var idSessao;
var frases = [];
var imagens = [];
var start;
var end;
var totalTime;
var idPecas = [];
var erradas = 0;
var preparador = [];
var boxes = [];
var time;

var idSelected = "";

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

function preparePreparador() {
    if (frases.length >= imagens.length) {
        for (var i = 0; i < frases.length; i++) {
            preparador.push(frases[i]);
        }
        addExtra();
    }
    else if (imagens.length > 0) {
        for (var i = 0; i < imagens.length; i++) {
            preparador.push(imagens[i]);
        }
        addExtra();
    }
}

function addExtra() {
    for (var i = (preparador.length); i < 9; i++) {
        preparador.push("");
    }
    shuffle(preparador);
}

function createScreen() {
    var table = document.createElement('div');
    table.id = "Table";
    table.style.height = "300px";
    table.style.width = "300px";
    table.className = "Square";
    $('jogo').appendChild(table);

    for (var i = 0; i < 9; i++) {
        createTable(i);
    }
}

function createTable(id) {
    var myTableDiv = $("Table");

    var table = document.createElement('TABLE');
    table.border = '2';
    table.id = id;
    table.style.width = "100px";
    table.style.height = "100px";
    table.style.margin = "0px";
    table.className = "option1";
    table.onclick = function() {
        switchTableCss(id);
    }

    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);

    if (!(imagens.length == 0)) {
        var tr = document.createElement('TR');
        tr.border = '0';
        tableBody.appendChild(tr);

        var td = document.createElement('TD');
        td.border = '0';
        td.id = id + "td0";
        var img = document.createElement('img');
        img.src = imagens[id];
        img.className = "GameImg";
        td.appendChild(img);
        idPecas.push([td.id, preparador[id]]);
        tr.appendChild(td);
    }
    if (!(frases.length == 0)) {
        var tr = document.createElement('TR');
        tr.border = '0';
        tableBody.appendChild(tr);

        str = "frase";

        var td = document.createElement('TD');
        td.border = '0';
        td.id = id + "td1";
        td.appendChild(document.createTextNode("" + preparador[id]));
        idPecas.push([td.id, preparador[id]]);
        tr.appendChild(td);
    }
    myTableDiv.appendChild(table);
}

function createBox() {
    var size = 0;
    var doc = $('jogo');
    var box = document.createElement('div');
    box.id = "box";
    box.style.height = "100px";
    box.className = "box";
    doc.appendChild(box);
    box.setAttribute("border", "2");
    for (var i = 0; i < idPecas.length; i++) {
        if (!(idPecas[i][1] == "")) {
            addTable(i);
            size++;
        }
    }
    box.style.width = size * 100 + "px";
}

function addTable(id) {
    var doc = $('box');
    var box = document.createElement('table');
    box.id = "box" + id;
    box.style.height = "100px";
    box.style.width = "100px";
    box.style.margin = "0px";
    box.className = "option1";
    box.onclick = function() {
        switchCss(id);
    }
    boxes.push(id);
    var tblBody = document.createElement("tbody");
    var row = document.createElement("tr");
    row.style.height = "100px";

    var cell = document.createElement("td");
    cell.id = "box" + id + "td" + "0";
    cell.style.height = "100px";
    if (frases.length >= imagens.length) {
        var cellText = document.createTextNode("" + idPecas[id][1]);
    }
    else {
        var cellText = document.createElement('img');
        cellText.src = imagens[id];
        cellText.className = "GameImg";
    }
    cell.appendChild(cellText);
    row.appendChild(cell);

    tblBody.appendChild(row);
    box.appendChild(tblBody);
    doc.appendChild(box);
    box.setAttribute("border", "2");
}

function init(string, instrucoes, imag, id_exercicio, idSess) {
    idSessao = idSess;
    idExercicio = id_exercicio;
    document.getElementById("instrucoes").innerHTML = instrucoes;
    var frase = string;
    if (frase.length > 0) {
        var array = frase.split(";;");
        for (var i = 0; i < array.length; i++) {
            frases.push(array[i]);
        }
    }

    frase = imag;
    if (frase.length > 0) {
        array = frase.split(";;");
        for (var i = 0; i < array.length; i++) {
            imagens.push(array[i]);
        }
    }
    preparePreparador();
    createScreen();
    createBox();

    var myTableDiv = document.getElementById("instrucoes");
    var button = document.createElement('input');
    button.type = 'button';
    button.id = 'Responder';
    button.value = 'Responder';
    button.name = 'Responder';
    button.onclick = function() {
        if (victory()) {
            $("Exercicio").className = "correct";
            end = new Date().getTime();
            time = end - start;
            removeAll();
            showTime(time);
        } else {
            $("Exercicio").className = "wrong";
            erradas++;
        }
    }
    button.disabled = true;
    button.style.margin = "0px";
    myTableDiv.innerHTML += "</br>"
    myTableDiv.appendChild(button);
    resize_images(300, 300, 300, 300);
    setTimeout(function() {
        emptyTable();
    }, 3 * 1000);
    
    start = new Date().getTime();
}

function getTableContent(id) {
    var td = $(id + "td1");
    var y = td.childNodes[0];
    var txt = y.nodeValue;
    return txt;
}

function getTableContent2(id) {
    var td = $(id + "td0");
    var y = td.childNodes[0];
    var txt = y.nodeValue;
    return txt;
}

function getTableContent3(id) {
    var td = $(id + "td0");
    var y = td.childNodes[0];
    var txt = y.src;
    return txt;
}

function setTableContent(id, string) {
    var td = $(id + "td1");
    var y = td.childNodes[0];
    y.nodeValue = string;
}
function setTableContent2(id, string) {
    var td = $(id + "td0");
    var y = td.childNodes[0];
    y.nodeValue = string;
}
function setTableContent3(id, string) {
    var td = $(id + "td0");
    var y = td.childNodes[0];
    y.src = string;
}


function sleep(ms) {
    ms += new Date().getTime();
    while (new Date() < ms) {
    }
    return true;
}

function showTime(time) {
    end = new Date().getTime();
    time = end - start;
    var myDiv = document.getElementById("Exercicio");
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
    $("Exercicio").className = "correct";
}

function removeAll() {
    for (var i = 0; i < 9; i++) {
        $(i).remove();
    }
    for (var i = 0; i < boxes.length; i++) {
        $("box" + boxes[i]).remove();
    }
    $('Table').remove();
    $('box').remove();
    $("jogo").remove();
    drawExitButton();
}

function printArray(array) {
    for (var i = 0; i < array.length; i++) {
        $("instrucoes").innerHTML += "</br>";
        $("instrucoes").innerHTML += i + ": " + array[i];
    }
}

function switchCss(id) {
    idSelected = "";
    for (var i = 0; i < boxes.length; i++) {
        $("box" + boxes[i]).className = "option1";
    }
    $("box" + id).className = "option";
    idSelected = "box" + id;
}

function switchTableCss(id) {
    if (!(idSelected == "")) {
        for (var i = 0; i < 9; i++) {
            $(i).className = "option1";
        }
        $(id).className = "option";
        if (frases.length > imagens.length) {
            setTableContent(id, getTableContent2(idSelected));
        }
        else{
            setTableContent3(id, getTableContent2(idSelected));
        }
        unselectAll();
    }
    else {
        if (frases.length > imagens.length) {
            setTableContent(id, "");
        }
        else{
            setTableContent3(id, "");
        }
    }
}

function unselectAll() {
    for (var i = 0; i < 9; i++) {
        $(i).className = "option1";
    }
    idSelected = "";
    for (var i = 0; i < boxes.length; i++) {
        $("box" + boxes[i]).className = "option1";
    }
}

function emptyTable() {
    for (var i = 0; i < 9; i++) {
        if (!($(i + "td1") == null)) {
            setTableContent(i, "");
        }
        else {
            setTableContent3(i, "");
        }
    }
    $("Responder").disabled = false;
}

function victory() {
    var array = [];
    var bool = false;
    if (frases.length > imagens.length) {
        for (var i = 0; i < 9; i++) {
            array.push(getTableContent(i));
        }
    }
    else {
        for (var i = 0; i < 9; i++) {
            array.push(getTableContent3(i));
        }
    }
    for (var i = 0; i < array.length; i++) {
        if (array[i] == preparador[i]) {

            bool = true;
        }
        else {
            bool = false;
            break;
        }
    }
    return bool;
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

    document.getElementById('Exercicio').appendChild(f);
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