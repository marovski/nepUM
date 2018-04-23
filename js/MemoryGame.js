function $(doc) {
    return document.getElementById(doc);
}
var idSessao;
var idExercicio;
var frases = [];
var imagens = [];
var start;
var end;
var totalTime;
var idPecas = [];
var erradas = 0;
var time;

var linhas = 0;
var colunas = 0;
var pieceWidth = 0;

var idSelected = "AA";

var idViradas = [];
var pecasViradas = 0;

function createLinesColumns() {
    var pecas = 0;
    if (!(frases.length == 0)) {
        pecas = frases.length;
        if (imagens.length > frases.length) {
            pecas = imagens.length;
        }
    }
    else if (!(imagens.length == 0)) {
        pecas = imagens.length;
    }
    var i = 0;
    var j = 0;
    while ((i * j) < (pecas * 2)) {
        if (j == i) {
            if (i == 8) {
                j++;
            }
            else {
                i++;
            }
        }
        else {
            j++;
        }
    }
    linhas = j;
    colunas = i;
    prepareFullPiecesArray();
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function prepareFullPiecesArray() {
    var array = [];
    if (frases.length > 0) {
        for (var i = 0; i < frases.length; i++) {
            array.push(frases[i]);
        }
        for (var i = 0; i < frases.length; i++) {
            array.push(frases[i]);
        }
        shuffle(array);
        frases = array;
    }
    if (imagens.length > 0) {
        for (var i = 0; i < imagens.length; i++) {
            array.push(imagens[i]);
        }
        for (var i = 0; i < imagens.length; i++) {
            array.push(imagens[i]);
        }
        shuffle(array);
        imagens = array;
    }
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

function createColumns() {
    for (var i = 0; i < colunas; i++) {
        var myTableDiv = $("jogo");

        var div = document.createElement('div');
        div.id = "C" + i;
        var wid = 750 / colunas - 10;
        if (wid > 100) {
            wid = 100;
        }
        div.style.width = wid + "px";
        div.className = "Coluna";
        var margin = (((750 - (wid * colunas)) / colunas) / 2);
        div.style.marginRight = margin + "px";
        div.style.marginLeft = margin + "px";
        myTableDiv.appendChild(div);
        myTableDiv.style.height = ((wid + 55) * linhas) + "px";
    }
}

function addTable(tableid, linha, coluna) {
    if ((tableid < frases.length) || (tableid < imagens.length)) {
        var myTableDiv = $("C" + coluna);

        var table = document.createElement('TABLE');
        table.border = '2';
        table.id = "L" + linha + "C" + coluna + "T" + tableid;
        var wid = 750 / colunas - 10;
        if (wid > 100) {
            wid = 100;
        }
        table.style.width = wid + "px";
        table.style.height = wid + "px";
        table.className = "option1";
        table.onclick = function() {
            if (!(idViradas == 2)) {
                switchCss("L" + linha + "C" + coluna + "T" + tableid);
                setTimeout(function() {
                    victory();
                }, 1050);
            }
        };
        idPecas.push("L" + linha + "C" + coluna + "T" + tableid);
        var tableBody = document.createElement('TBODY');
        table.appendChild(tableBody);

        if (!(imagens.length == 0)) {
            var tr = document.createElement('TR');
            tr.border = '0';
            tableBody.appendChild(tr);

            var td = document.createElement('TD');
            td.border = '0';
            td.id = "L" + linha + "C" + coluna + "T" + tableid + "0";
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

            str = "frase";

            var td = document.createElement('TD');
            td.border = '0';
            td.id = "L" + linha + "C" + coluna + "T" + tableid + "1";
            td.width = '';
            td.appendChild(document.createTextNode("" + frases[tableid]));
            tr.appendChild(td);
        }
        myTableDiv.appendChild(table);
    }
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
    createLinesColumns();

    //metodo para addTable
    createColumns();
    for (var i = 0; i < linhas; i++) {
        for (var j = 0; j < colunas; j++) {
            addTable((j + (i * colunas)), i, j);
        }
    }


    $("instrucoes").innerHTML += "</br>";
    resize_images(200, 200, 200, 200);
    start = new Date().getTime();
}

function printArray() {
    $("instrucoes").innerHTML += "</br>";
    $("instrucoes").innerHTML += "lines: " + linhas;
    $("instrucoes").innerHTML += "</br>";
    $("instrucoes").innerHTML += "columns: " + colunas;
    for (var i = 0; i < frases.length; i++) {
        $("instrucoes").innerHTML += "</br>";
        $("instrucoes").innerHTML += i + ": " + frases[i];
    }
}

function switchCss(id) {
    var doc = $(id);
    if (idViradas.length == 2) {

    }
    else if (doc.className == "option2") {

    }
    else {
        doc.className = "option";
        idViradas.push(id);
        if (idViradas.length == 2) {
            setTimeout(function() {
                confirmMove();
            }, 1050);
        }
    }

}

function viradasRemove(id) {
    idViradas.splice(idViradas.indexOf(id), 1);
}

function confirmMove() {
    var primeiro = idViradas[0];
    var segundo = idViradas[1];
    if (frases.length >= imagens.length) {
        if (getTableContent(primeiro) == getTableContent(segundo)) {
            $(primeiro).className = "option2";
            $(segundo).className = "option2";
            pecasViradas += 2;
        }
        else {
            $(primeiro).className = "option1";
            $(segundo).className = "option1";
            erradas++;
        }
    }
    else {
        if (getTableContent2(primeiro) == getTableContent2(segundo)) {
            $(primeiro).className = "option2";
            $(segundo).className = "option2";
            pecasViradas += 2;
        }
        else {
            $(primeiro).className = "option1";
            $(segundo).className = "option1";
            erradas++;
        }
    }
    idViradas.splice(0, 2);
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

function sleep(ms) {
    ms += new Date().getTime();
    while (new Date() < ms) {
    }
    return true;
}

function victory() {
    if (idPecas.length == pecasViradas) {
        showTime();
        removeAll();
    }
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
    for (var i = 0; i < idPecas.length; i++) {
        $(idPecas[i]).remove();
    }
    for (var i = 0; i < colunas; i++) {
        $("C" + i).remove();
    }
    $("jogo").remove();
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
    s.setAttribute('name', "exercicio");
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