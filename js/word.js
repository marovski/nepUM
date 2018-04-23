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
    button.onclick = function () {
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
    table.onclick = function () {
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
  
    f.setAttribute('name', "word");
    f.setAttribute('action', "../submitJogo.php");


    var w = document.createElement("input"); //input element, text
    w.setAttribute('type', "hidden");
    w.setAttribute('name', "time");
    w.setAttribute('value', time);
    f.appendChild(w);

    var r = document.createElement("input"); //input element, text
    r.setAttribute('type', "hidden");
    r.setAttribute('name', "erradas");
    r.setAttribute('value', erradas);
    f.appendChild(r);

    var i = document.createElement("input"); //input element, text
    i.setAttribute('type', "hidden");
    i.setAttribute('name', "id_exercicio");
    i.setAttribute('value', idExercicio);
    f.appendChild(i);

    var e = document.createElement("input"); //input element, text
    e.setAttribute('type', "hidden");
    e.setAttribute('name', "idSess");
    e.setAttribute('value', idSessao);
    f.appendChild(e);

    f.innerHTML += "</br>";
    var s = document.createElement("input"); //input element, Submit button
    s.setAttribute('type', "Submit");
    s.setAttribute('name', "sair");
    s.setAttribute('value', "Sair");

    f.appendChild(s);

    document.getElementById('all').appendChild(f);
}

function resize_images(maxht, maxwt, minht, minwt) {
    var imgs = document.getElementsByClassName('GameImg');

    var resize_image = function (img, newht, newwt) {
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