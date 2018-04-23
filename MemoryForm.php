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
            var estrutura;
            var idHipoteses = 2;
            var idHipoteses2 = 0;
            var ids = [];
            var contents = [];
            var doubleLine = false;

            function addBox() {
                contents.push(document.getElementById("hipotese1").value);
                contents.push(document.getElementById("hipotese2").value);
                for (var i = 0; i < ids.length; i++) {
                    contents.push(document.getElementById(ids[i]).value);
                }
                idHipoteses++;
                var doc = document.getElementById('hipoteses');
                doc.innerHTML += "<br>";
                doc.innerHTML += "Hipótese " + idHipoteses + "<br>";
                var box = document.createElement('input');
                box.setAttribute('type', "text");
                box.setAttribute('name', "hipotese" + idHipoteses);
                box.setAttribute('id', "hipotese" + idHipoteses);
                box.setAttribute('value', "");
                doc.appendChild(box);
               

                for (var i = 0; i < ids.length; i++) {
                    document.getElementById(ids[i]).value += contents[i + 2];
                }
                document.getElementById("hipotese1").value += contents[0];
                document.getElementById("hipotese2").value += contents[1];
                contents.splice(0, contents.length);
                ids.push(box.getAttribute('id'));
            }

            
        </script>
    </head>
    <body>
        <form method="POST" action="RegisterExercise.php" id="ExerciseForm">
            <input type="hidden" value="Pares">
            Nome:<br>
            <input type="text" value="" name="name">
            <br>
            Descrição: <br>
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
            <div id="hipoteses" style="margin:0px;">
                Hipótese 1:
                <br>
                <input type="text" value="" name="hipotese1" id="hipotese1">
                <br>
                Hipótese 2:
                <br>
                <input type="text" value="" name="hipotese2" id="hipotese2">
            </div>
            
            <br>
            <input type="button" value="Adicionar Hipótese" name="addbox" onclick="addBox();">
            <br>
            <input type="submit" value="Criar Exercício" name="Submit">
        </form>
    </body>
</html>
