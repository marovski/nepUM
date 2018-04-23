function $(doc) {
    return document.getElementById(doc);
}
//variáveis para definir o tamanho da tag canvas
var jogoWidth = 650;
var jogoHeight = 650;

var frases = [];
var imagens = [];
var correct;
var start;
var end;
var time;
var erradas = 0;
var idExercicio;
var idSessao;

function loadEscolhas(string, img, instrucoes, resposta, id_exercicio, idSess) {
    idSessao = idSess;
    idExercicio = id_exercicio;
    var frase = string;
    var array = frase.split(";;");
    document.getElementById("instrucoes").innerHTML = instrucoes;
    if (frase.length > 0) {
        for (var i = 0; i < array.length; i++) {
            frases.push(array[i]);
        }
        for (var i = 0; i < frases.length; i++) {
            if (frases[i] == resposta) {
                correct = i;
                break;
            }
        }
    }
    frase = img;
    array = frase.split(";;");
    if (frase.length > 0) {
        for (var i = 0; i < array.length; i++) {
            imagens.push(array[i]);
        }
        if (imagens.length > frases.length) {
            for (var i = 0; i < imagens.length; i++) {
                if (imagens[i] == resposta) {
                    correct = i;
                    break;
                }
            }
        }
    }
    //desenhar tabelas consuante pares.lenght
    if (frases.length > 0) {
        for (var i = 0; i < frases.length; i++) {
            addTable(i);
        }
    }
    else if (imagens.length > 0) {
        for (var i = 0; i < imagens.length; i++) {
            addTable(i);
        }
    }
    var myTableDiv = document.getElementById("jogo");

    var button = document.createElement('input');
    button.type = 'button';
    button.value = 'Answer';
    button.name = 'Answer';
    button.onclick = function() {
        var answer;
        for (var i = 0; i < frases.length; i++) {
            if (document.getElementById("" + i).className == "selected") {
                answer = i;
            }
        }
        if (imagens.length >= frases.length) {
            for (var i = 0; i < imagens.length; i++) {
                if (document.getElementById("" + i).className == "selected") {
                    answer = i;
                }
            }
        }
        if (answer == correct) {
            document.getElementById('Exercicio').className = "correct";
            end = new Date().getTime();
            time = end - start;
            removeAll();
            showTime(time);
        }
        else {
            document.getElementById('jogo').className = "wrong";
            erradas++;
        }
        
    }
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
        if (frases.length > imagens.length) {
            for (var i = 0; i < frases.length; i++) {
                document.getElementById("" + i).className = "option";
            }
        }
        else {
            for (var i = 0; i < imagens.length; i++) {
                document.getElementById("" + i).className = "option";
            }
        }
        table.className = "selected";
    };

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

        str = "frase";

        var td = document.createElement('TD');
        td.border = '0';
        td.id = "" + tableid + "1";
        td.width = '';
        td.appendChild(document.createTextNode("" + frases[tableid]));
        tr.appendChild(td);
    }


    myTableDiv.appendChild(table);

}


function showTime(time) {
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
}

function removeAll() {
    for (var i = 0; i < frases.length; i++) {
        $(i).remove();
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