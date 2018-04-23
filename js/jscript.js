


//Variabel for asynchronous loading function
var rootdomain="http://"+window.location.hostname


//Variaveis Menu dropdown mouseover
var timeout = 2000;
var closetimer = 0;
var ddmenuitem = 0;


//Variaveis funcao mudarimagem
var i = 0;
var imagem = new Array("./img/brain1.jpg","./img/brain4.jpg", "./img/brain2.jpg", "http://4.bp.blogspot.com/-WizTM6GX-Nk/T2Tpm-FqQsI/AAAAAAAACxg/I0nL0ns4N8k/s1600/br2fotografia-766189.JPG");


//Variaveis Mapa
var map;
var directionsDisplay;

function showValidNIF(nr) {
	// texto a mostrar enquanto o nif é alidado
	document.getElementById("txtValNIF").innerHTML="a validar...";
	if (nr=="") {
		// se não tivermos um nif a validar o texto do resultado da validação
		document.getElementById("txtValNIF").innerHTML="";
		return;
	}
	// testamos a compatibilidade do objecto XMLHttpRequest consoante o browser
	// e iniciamos o objecto XMLHttpRequest
	if (window.XMLHttpRequest) {
		// compatibilidade com IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // compatibilidade com for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	// quando temos dados devolvidos pelo objecto XMLHttpRequest
	// mostramos esse texto no elemento html txtValNIF
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("txtValNIF").innerHTML=xmlhttp.responseText;
		}
	}
	// invocamos o pedido ao nosso ficheiro val_nif.php usando método GET
	// passando no parametro o nif a validar.
	xmlhttp.open("GET","val_nif.php?q="+nr,true);
	xmlhttp.send();
}
function validacaoEmail(field) { usuario = field.value.substring(0, field.value.indexOf("@")); dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length); if ((usuario.length >=1) && (dominio.length >=3) && (usuario.search("@")==-1) && (dominio.search("@")==-1) && (usuario.search(" ")==-1) && (dominio.search(" ")==-1) && (dominio.search(".")!=-1) && (dominio.indexOf(".") >=1)&& (dominio.lastIndexOf(".") < dominio.length - 1)) { document.getElementById("msgemail").innerHTML="E-mail válido"; alert("E-mail valido"); } else{ document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>"; alert("E-mail invalido"); } }

function logout() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        document.location = 'index.php';
    }
    xhr.open('GET', 'destroySession.php', true);
 xhr.send();
    
}


//SLIDE DE IMAGEM
function mudarImagem()
{
    document.slide.src = imagem[i];
    if (i < imagem.length - 1)
        i++;
    else
        i = 0;
    setTimeout("mudarImagem()", 3000);
    return;
}
;



//Redericionar pagina
function clickTo(id) {


    var link = new Array("./admin.php?reg1", "./admin.php?reg", "./index.php?conv", "./index.php?who", 
    "./professional.php?exerc", "./institution.php?instL", "./institution.php?addT", "./index.php?infra", 
    "./admin.php?reg2", "./admin.php?regL", "./admin.php?regI", 
    "./admin.php?reg1U", "./index.php?Paciente", "./index.php?contato","./admin.php?dataAdmin","./index.php?guest",
    "./admin.php?regPro","./patient.php?contactP","./patient.php?exercise1","./professional.php?pacient",
    "./patient.php?realizarE","./professional.php?session","./admin.php?listaPN", "./institution.php?Pinfo",
    "./professionalN.php?addPat","./index.php?forgotPass","./institution.php?editI","./institution.php?instPass","./professional.php?createS","./professionalN.php?profNData"
            ,"./professionalN.php?pathology","./professionalN.php?exercise","./professionalN.php?domain","./professionalN.php?exerc","./professional.php?ppro",
            "./professional.php?dataPr1","./professional.php?dataPr2","./institution.php?instM","./patient.php?patData","./patient.php?patPass"
            ,"./patient.php?patDados","./patient.php?checkResults","./professional.php?pac",
            "./professional.php?patList","./professional.php?reportList",
            "./professionalN.php?profNPass","./professionalN.php?profNDados",
            "./professionalN.php?exerciseList","./professionalN.php?addDomain",
            "./professional.php?patP","./professional.php?patR","./institution.php?set",
            "./professionalN.php?addDomainE","./professional.php?mailbox","./professional.php?afG","./guest.php?realizar","./patient.php?sessions");
   
    if (id == 'b') {
        var d = document.getElementById(id);
        d.href = link[0];
    }

    if (id == 'a') {
        var d = document.getElementById(id);
        d.href = link[1];
    }

    if (id == 'who') {
        var d = document.getElementById(id);
        d.href = link[3];
    }
    if (id == 'exercise') {
        var d = document.getElementById(id);
        d.href = link[4];
    }
    if (id == 'inst') {
        var d = document.getElementById(id);
        d.href = link[5];
    }
    if (id == 'inst1') {
        var d = document.getElementById(id);
        d.href = link[6];
    }
    if (id == 'structure') {
        var d = document.getElementById(id);
        d.href = link[7];
    }
    if (id == 'registo') {
        var d = document.getElementById(id);
        d.href = link[8];
    }
    if (id == 'lista') {
        var d = document.getElementById(id);
        d.href = link[9];
    }
    if (id == 'c') {
        var d = document.getElementById(id);
        d.href = link[10];
    }
    if (id == 'listau') {
        var d = document.getElementById(id);
        d.href = link[11];
    }
    if (id == 'talk') {
        var d = document.getElementById(id);
        d.href = link[12];
    }
    if (id == 'contato') {
        var d = document.getElementById(id);
        d.href = link[13];
    }if (id == 'pAdmin') {
        var d = document.getElementById(id);
        d.href = link[14];
    }if (id == 'guest') {
        var d = document.getElementById(id);
        d.href = link[15];
    }if (id == 'registo2') {
        var d = document.getElementById(id);
        d.href = link[16];
    }if (id == 'contactPro') {
        var d = document.getElementById(id);
        d.href = link[17];
    }if (id == 'exerciseP') {
        var d = document.getElementById(id);
        d.href = link[18];
    }if (id == 'pacient') {
        var d = document.getElementById(id);
        d.href = link[19];
    }if (id == 'exerciseR') {
        var d = document.getElementById(id);
        d.href = link[20];
    }if (id == 'session') {
        var d = document.getElementById(id);
        d.href = link[21];
    }if (id == 'lista2') {
        var d = document.getElementById(id);
        d.href = link[22];
    }if (id == 'pI') {
        var d = document.getElementById(id);
        d.href = link[23];
    }if (id == 'addPat') {
        var d = document.getElementById(id);
        d.href = link[24];
    }if (id == 'forgot') {
        var d = document.getElementById(id);
        d.href = link[25];
    }if (id == 'editI') {
        var d = document.getElementById(id);
        d.href = link[26];
    }if (id == 'instPass') {
        var d = document.getElementById(id);
        d.href = link[27];
    }
    if (id == 'createS') {
        var d = document.getElementById(id);
        d.href = link[28];
    }if (id == 'profNData') {
        var d = document.getElementById(id);
        d.href = link[29];
    }if (id == 'pathology') {
        var d = document.getElementById(id);
        d.href = link[30];
    }if (id == 'exercise') {
        var d = document.getElementById(id);
        d.href = link[31];
    }if (id == 'domain') {
        var d = document.getElementById(id);
        d.href = link[32];
    }if (id == 'exerc') {
        var d = document.getElementById(id);
        d.href = link[33];
    }if (id == 'ppro') {
        var d = document.getElementById(id);
        d.href = link[34];
    }if (id == 'dataPr1') {
        var d = document.getElementById(id);
        d.href = link[35];
    }if (id == 'dataPr2') {
        var d = document.getElementById(id);
        d.href = link[36];
    }if (id == 'instM') {
        var d = document.getElementById(id);
        d.href = link[37];
    }if (id == 'patData') {
        var d = document.getElementById(id);
        d.href = link[38];
    }if (id == 'patPass') {
        var d = document.getElementById(id);
        d.href = link[39];
    }if (id == 'patDados') {
        var d = document.getElementById(id);
        d.href = link[40];
    }if (id == 'checkResults') {
        var d = document.getElementById(id);
        d.href = link[41];
    }if (id == 'pac') {
        var d = document.getElementById(id);
        d.href = link[42];
    }if (id == 'patList') {
        var d = document.getElementById(id);
        d.href = link[43];
    }if (id == 'reportList') {
        var d = document.getElementById(id);
        d.href = link[44];
    }
    if (id == 'profNPass') {
        var d = document.getElementById(id);
        d.href = link[45];
    }if (id == 'profNDados') {
        var d = document.getElementById(id);
        d.href = link[46];
    }if (id == 'exerciseList') {
        var d = document.getElementById(id);
        d.href = link[47];
    }if (id == 'addDomain') {
        var d = document.getElementById(id);
        d.href = link[48];
    }if (id == 'patP') {
        var d = document.getElementById(id);
        d.href = link[49];
    }if (id == 'patR') {
        var d = document.getElementById(id);
        d.href = link[50];
    }if(id=='set'){
        var d=document.getElementById(id);
        d.href=link[51];
    }if(id=='addDomainE'){
        var d=document.getElementById(id);
        d.href=link[52];
    }if(id=='mailbox'){
        var d=document.getElementById(id);
        d.href=link[53];
    }if(id=='afG'){
        var d=document.getElementById(id);
        d.href=link[54];
    }if(id=='realizar'){
        var d=document.getElementById(id);
        d.href=link[55];
    }if(id=='sessions'){
        var d=document.getElementById(id);
        d.href=link[56];
    }
    else if (id == 'e') {
        var d = document.getElementById(id);
        d.href = link[2];
    }
    return false;
}
;




//FUNÇão PARA DROPDOWN MENU onclick
//Dynamic function to show hiding divs
function showDiv(Div_id) {
    if (false == $(Div_id).is(':visible')) {
      
        $(Div_id).show(250);
        
    }
    else {
  
        $(Div_id).hide(250);
    }
}
;

//Mapa 
//Inicializar mapa
function initialize() {
 
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    var latlng = new google.maps.LatLng(41.452275, -8.291052);
    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("desenharmapa"), options);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("trajeto"));
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {

            pontoPadrao = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(pontoPadrao);
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    $("#txtEnderecoPartida").val(results[0].formatted_address);
                }
            });
        });
    }
}


//FUNCAO PARA SUBMETER OS DADOS DE PROCURA NO MAPA
function submitMap(){
$("#map").submit(function(event) {
    event.preventDefault();
    var enderecoPartida = $("#txtEnderecoPartida").val();
    var enderecoChegada = 'Campus de Gualtar 4710 - 057 Braga';
    var request = {
        origin: enderecoPartida,
        destination: enderecoChegada,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
        }
    });
});

//Mostrar Trajecto
$(document).ready(function() {
    $('.active-links').click(function() {
//Conditional states allow the dropdown box appear and disappear 
        if ($('#signin-dropdown').is(":visible")) {
            $('#signin-dropdown').hide()
            $('#session').removeClass('active'); // When the dropdown is not visible removes the class "active"
        } else {
            $('#signin-dropdown').show()
            $('#session').addClass('active'); // When the dropdown is visible add class "active"
        }
        return false;
    });
//Allow to hide the dropdown box if you click anywhere on the document.
    $('#signin-dropdown').click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('#signin-dropdown').hide();
        $('#session').removeClass('active');
    });
})};

function greetingP(profile) {
    datetoday = new Date();
    timenow = datetoday.getTime();
    datetoday.setTime(timenow);
    thehour = datetoday.getHours();
    
    if (profile == 1) {
        p = " Administrador"

    }
    if (profile == 2) {
        p = " Director Institucional";
    }
    if (profile == 3) {
        p = " Profissional de Saúde";
    }
    if (profile == 4) {
        p = " Paciente";
    }if (profile == 5) {
        p = " Convidado";
    }
    if (thehour > 18) {
        dd = "Boa ";
        display = "Noite";
    }
    else if (thehour > 12) {
        display = "Tarde";
        dd = "Boa ";
    }
    else {
        dd = "Bom "
        display = "Dia ";
    }
    var greeting = (dd + display + " Caro" + p + "!");
    document.write(greeting);
}
;



//asynchronous loading for urls
function ajaxinclude(url) {
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.open('GET', url, false) //get page synchronously 
page_request.send(null)
writecontent(page_request)
}

function writecontent(page_request){
if (window.location.href.indexOf("http")==-1 || page_request.status==200)
document.write(page_request.responseText)
}
