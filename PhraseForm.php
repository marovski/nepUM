<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            var idHipoteses = 2;
            var idHipoteses2 = 2;
            var ids = [];
            var ids2 = [];
            var contents = [];
            var contents2 = [];
            var doubleLine = false;

            function addBox() {
                contents.push(document.getElementById("ehipotese1").value);
                contents.push(document.getElementById("ehipotese2").value);
                for (var i = 0; i < ids.length; i++) {
                    contents.push(document.getElementById(ids[i]).value);
                }
                idHipoteses++;
                var doc = document.getElementById('hipoteses');
                doc.innerHTML += "<br>";
                doc.innerHTML += "Hipótese " + idHipoteses + "<br>";
                var box = document.createElement('input');
                box.setAttribute('type', "text");
                box.setAttribute('name', "ehipotese" + idHipoteses);
                box.setAttribute('id', "ehipotese" + idHipoteses);
                box.setAttribute('value', "");
                doc.appendChild(box);


                for (var i = 0; i < ids.length; i++) {
                    document.getElementById(ids[i]).value += contents[i + 2];
                }
                document.getElementById("ehipotese1").value += contents[0];
                document.getElementById("ehipotese2").value += contents[1];
                contents.splice(0, contents.length);
                ids.push(box.getAttribute('id'));
                addBox2();
            }

            function addBox2() {
                contents2.push(document.getElementById("dhipotese1").value);
                contents2.push(document.getElementById("dhipotese2").value);
                for (var i = 0; i < ids2.length; i++) {
                    contents2.push(document.getElementById(ids2[i]).value);
                }
                idHipoteses2++;
                var doc = document.getElementById('hipoteses2');
                doc.innerHTML += "<br>";
                doc.innerHTML += "Hipótese " + idHipoteses2 + "<br>";
                var box = document.createElement('input');
                box.setAttribute('type', "text");
                box.setAttribute('name', "dhipotese" + idHipoteses2);
                box.setAttribute('id', "dhipotese" + idHipoteses2);
                box.setAttribute('value', "");
                doc.appendChild(box);


                for (var i = 0; i < ids2.length; i++) {
                    document.getElementById(ids2[i]).value += contents2[i + 2];
                }
                document.getElementById("dhipotese1").value += contents2[0];
                document.getElementById("dhipotese2").value += contents2[1];
                contents2.splice(0, contents2.length);
                ids2.push(box.getAttribute('id'));
            }

            function selectAnswer() {
                var doc = document.getElementById('answerE');
                doc.innerHTML = "Coloque as palavras que deverão fazer ligação <br>"

                for (var j = 0; j < idHipoteses; j++) {
                    if (!(document.getElementById("ehipotese" + (j + 1)).value == "")) {
                        var select = document.createElement('SELECT');
                        select.id = "cases" + j;
                        select.name = "cases" + j;
                        var label = document.createElement('LABEL');
                        label.setAttribute('for', "cases" + j);
                        label.innerHTML = document.getElementById("ehipotese" + (j + 1)).value + " ->";
                        for (var i = 0; i < (idHipoteses2); i++) {
                            if (!(document.getElementById("dhipotese" + (i + 1)).value == "")) {
                                var option = document.createElement('OPTION');
                                option.value = document.getElementById("dhipotese" + (i + 1)).value;
                                option.innerHTML = document.getElementById("dhipotese" + (i + 1)).value;
                                select.appendChild(option);
                            }
                        }
                        doc.innerHTML += "<br>";
                        doc.appendChild(label);
                        doc.appendChild(select);

                    }
                }
                document.getElementsByName('addbox')[0].remove();
                document.getElementById('answerButton').remove();
            }

        </script>
    </head>
    <body>
        <form method="POST" action="RegisterExercise.php" id="ExerciseForm">
            <input type="hidden" value="Correspondência">
            Nome:<br>
            <input type="text" value="" name="name">
            <br>
            Descrição:<br>
            <input type="text" value="" name="description">
            <br>
            Tarefa:<br>
            <input type="text" value="" name="instructions">
            <br>
            Domínio:
            <br>
            <!-- Código de domínio -->
            <br>
            Nível:<br>
            <input type="number" value="" name="level">
            <br>
            <div id="hip" style="display: inline-block;">
                <div id="hipoteses" style="margin:0px; float: left;">
                    Coluna da esquerda:
                    <br>
                    Hipótese 1:
                    <br>
                    <input type="text" value="" name="ehipotese1" id="ehipotese1">
                    <br>
                    Hipótese 2:
                    <br>
                    <input type="text" value="" name="ehipotese2" id="ehipotese2">
                </div>
                <div id="hipoteses2" style="margin: 0px; float: left;">
                    Coluna da direita:
                    <br>
                    Hipótese 1:
                    <br>
                    <input type="text" value="" name="dhipotese1" id="dhipotese1">
                    <br>
                    Hipótese 2:
                    <br>
                    <input type="text" value="" name="dhipotese2" id="dhipotese2">
                </div>
            </div>
            <br>

            <div style="float: none; width:100%;">
                <br>
                <input type="button" value="Adicionar Hipótese" name="addbox" onclick="addBox();">
                <br>
                <input type="button" id="answerButton" onclick="selectAnswer();" value="Selecionar Resposta">
                <div id="answerE"></div>
                <input type="submit" value="Criar Exercício" name="Submit">
            </div>
        </form>
    </body>
</html>
