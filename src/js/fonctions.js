function get_url(param)
{
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}




function afficher_liste_salle(data)
{
	 var text1='<a href="user-salle.html?salle=';
	 var text2= '" class="icones hvr-border-fade"><img src="images/';
	 var text3='" ><br><span>';
	var text4='<span></a>';
	document.getElementById("liste_salle").innerHTML="";
$.each(data, function (index, value) {
	if (value["danger"]==1)
	{
		var alerte='<img src="images/danger.png" style="position: absolute;top:-30px;right:-10px;height:40px;">';
	}
	else
	{
		var alerte="";
	}
  document.getElementById("liste_salle").innerHTML+=text1+value["id"]+text2+value["icone"]+text3+value["nom"]+alerte+text4;
});
$('.icones').button();
}

 function afficher_liste_groupe(data)
{
	  var text1='<a href="user-salle.html?salle=';
	 var text2= '" class="icones hvr-border-fade"><img src="images/';
	 var text3='" ><br><span>';
	var text4='<span></a>';
	document.getElementById("liste_groupe").innerHTML="";
$.each(data, function (index, value) {
	if (value["danger"]==1)
	{
		var alerte='<img src="images/danger.png" style="position: absolute;top:-30px;right:-10px;height:40px;">';
	}
	else
	{
		var alerte="";
	}
  document.getElementById("liste_groupe").innerHTML+=text1+value["id"]+text2+value["icone"]+text3+value["nom"]+alerte+text4;
});
$('.icones').button();
}

function afficher_liste_interrupteur(data)
{	
	 var text1="<a onclick=\"activer_interrupteur('#interrupteur-";
	 var text2="')\" class=\"icones hvr-border-fade ";
	 var text3="\" id=\"interrupteur-"
	 var text4="\"><img src=\"images/shut-down2.svg\"><br><span>";
	 var text5="<span></a>"
	 document.getElementById("liste_interrupteur").innerHTML="";

$.each(data, function (index, value) {
	if (value["etat"]==1)
	{
		var etat="vert";
	}
	else 
	{
		var etat="gris";
	}
  document.getElementById("liste_interrupteur").innerHTML+=text1+value["id"]+text2+etat+text3+value["id"]+text4+value["nom"]+text5;
});
$('.icones').button();
}
function rafraichir_details()
{
	var salle = get_url("salle");
$.post("BDD/afficher_liste_charge.php", {groupe : salle})
  .done(function( data ) {
   afficher_detail_charge(JSON.parse(data));
  });

}
function afficher_liste_charge(data)
{	
	 var text1="<a ";
	 var text2= "class=\"icones hvr-border-fade ";
	 var text3="\" id=\"charge-";
	
	var text4="\"><img src=\"images/";
	var text5="\" ><br><span>";
	var text6="<span></a>";
	document.getElementById("liste_charge").innerHTML="";
$.each(data, function (index, value) {
	if (value["etat"]==1)
	{
		var etat=value["couleur"];
	}
	else 
	{
		var etat="gris";
	}
	if (value["danger"]==1)
	{
		var alerte='<img src="images/danger.png" style="position: absolute;top:-30px;right:-10px;height:40px;">';
	}
	else
	{
		var alerte="";
	}
	if (value["pilotable"]==1)
	{
		var pilotable="onclick=\"activer_charge('switch-"+value["id"]+"','"+value["couleur"]+"')\"";
	}
	else
	{
		var pilotable="";
	}
  document.getElementById("liste_charge").innerHTML+=text1+pilotable+text2+etat+text3+value["id"]+text4+value["icone"]+text5+value["nom"]+alerte+text6;
});
$('.icones').button();
 document.getElementById("liste_charge").innerHTML+='<button id="more_charges">Visualiser toutes les charges</button>';
 $( "#more_charges" ).button();
  $( "#more_charges" ).click(function() {
      $( "#liste_charges" ).dialog( "open" );
    });
}
function switch_interrupteur(id)
{
	$( id).prop( "checked", function( i, val ) {
  return !val;
});
}
function afficher_detail_charge(data)
{
	$("#charges > tbody").html("");
	text1='<tr><td>';
	text2='</td><td><label id="switch-';
	text3='" class="switch ';
	text5='></label></td><td>';
	text6="kWh</td><td>";
	text7='</td><td><button onclick="afficher_programmation(3,4)" class="button_prog" class="ui-state-default ui-corner-all"> <img class="icon_clock" src="images/clock.svg"> </button></td></tr>';
	$.each(data, function (index, value) {
		if (value["etat"]==1)
	{
		var check=" on ";
	}
	else 
	{
		var check=" off ";
	}
	if (value["pilotable"]==1)
	{
		var actif='" onclick="activer_charge(this.id,\''+value["couleur"]+'\')\"';
	}
	else
	{
		var actif=' disabled"  ';
	}
	$("#charges > tbody:last").append(text1+value["nom"]+text2+value["id"]+text3+check+actif+text5+value["consommation"]+text6+value["source"]+text7);
});
}

function afficher_programmation(groupe,id_charge)
{
	$.post("BDD/afficher_programmation_charge.php", {salle:3, charge:4})
  .done(function( data ) {
   afficher_prog(JSON.parse(data));
  });
}

function afficher_prog(data)
{
	var text1='<tr><td colspan=4 > <div class=prog_day> <button class="ui-state-default ui-corner-all"> <p> Lu </p> </button> <button class="ui-state-default ui-corner-all"> <p> Ma </p> </button> <button class="ui-state-default ui-corner-all"> <p> Me </p> </button> <button class="ui-state-default ui-corner-all"> <p> Je </p> </button> <button class="ui-state-default ui-corner-all"> <p> Ve </p> </button> <button class="ui-state-default ui-corner-all"> <p> Sa </p> </button> <button class="ui-state-default ui-corner-all"> <p> Di </p> </button> </div><p> </br> <span class=debut_prog>';
var text2 = '</span><span class=fin_prog>';
var text3 = '</span></p>  </td>';
   var text4 = '<td><button class="button_change_prog" class="ui-state-default ui-corner-all"> <img class="icon_gear_prog" src="images/gear.svg" </button></td></tr>';

        $.each(data, function (index, value) {
        $("#charges > tbody:last").append(text1+value["date_debut"]+text2+value['date_fin']+text3+text4);
});
}


function activer_charge(id_charge,couleur)
{
	var num_charge=id_charge.split("switch-")[1];
$.post("BDD/modifier_etat_charge.php", {id : num_charge})
  .done(function( data ) {
    $("#charge-"+num_charge).toggleClass(couleur);
    $("#charge-"+num_charge).toggleClass('gris');

	$( "#"+id_charge).toggleClass("on");
    $( "#"+id_charge).toggleClass("off");
});
}
function activer_interrupteur(id_interrupteur)
{
	var num_interrupteur=id_interrupteur.split("#interrupteur-")[1];
  $.post("BDD/modifier_etat_interrupteur.php", {id : num_interrupteur})
  .done(function( data ) {
  $(id_interrupteur).toggleClass('vert');

  $(id_interrupteur).toggleClass('gris');
});
}



function afficher_graph_jour(data)
{
	var ctx = document.getElementById("graph_jour").getContext("2d");
	var donnees="[";
	$.each(data, function (index, value) {
donnees+=value["consommation"]+",";
        });
	donnees+="0]";
	var data = {
    labels: ["0h00","0h15","0h30","0h45","1h00","1h15","1h30","1h45","2h00","2h15","2h30","2h45","3h00","3h15","3h30","3h45","4h00","4h15","4h30","4h45","5h00","5h15","5h30","5h45","6h00","6h15","6h30","6h45","7h00","7h15","7h30","7h45","8h00","8h15","8h30","8h45","9h00","9h15","9h30","9h45","10h00","10h15","10h30","10h45","11h00","11h15","11h30","11h45","12h00","12h15","12h30","12h45","13h00","13h15","13h30","13h45","14h00","14h15","14h30","14h45","15h00","15h15","15h30","15h45","16h00","16h15","16h30","16h45","17h00","17h15","17h30","17h45","18h00","18h15","18h30","18h45","19h00","19h15","19h30","19h45","20h00","20h15","20h30","20h45","21h00","21h15","21h30","21h45","22h00","22h15","22h30","22h45","23h00","23h15","23h30","23h45","24h00","24h15","24h30","24h45",],
 datasets: [
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: donnees
}
]
};
$("loader_jour").hide();
var myLineChart = new Chart(ctx).Line(data,{   pointDotRadius : 0,pointHitDetectionRadius : 2,scaleFontSize: 12.5});

}

function afficher_graph_semaine(data)
{
var ctx = document.getElementById("graph_semaine").getContext("2d");
var donnees="[";
	$.each(data, function (index, value) {
donnees+=value["consommation"]+",";
        });
	donnees+="0]";
	var data = {
    labels: ["Lundi", "Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"],
    datasets: [
        {
            label: "Consommation par jour",
            fillColor: "rgba(151,214,79,1)",/*barre*/
            strokeColor: "rgba(220,220,220,0.75)",/*contour*/
            highlightFill: "rgba(220,220,220,0.75)",/*hover barre*/
            highlightStroke: "rgba(220,220,220,1)",/*hover contour*/
            data:donnees
        }
       
    ]
};
$("loader_semaine").hide();
var myBarChart = new Chart(ctx).Bar(data);

}

function afficher_graph_an(data)
{
var ctx = document.getElementById("graph_an").getContext("2d");
var donnees="[";
	$.each(data, function (index, value) {
donnees+=value["consommation"]+",";
        });
	donnees+="0]";
	var data = {
    labels: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
    datasets: [
        {
            label: "Consommation par jour",
            fillColor: "rgba(151,214,79,1)",/*barre*/
            strokeColor: "rgba(220,220,220,0.75)",/*contour*/
            highlightFill: "rgba(220,220,220,0.75)",/*hover barre*/
            highlightStroke: "rgba(220,220,220,1)",/*hover contour*/
            data: donnees
        }
       
    ]
};
$("loader_an").hide();
var myBarChart = new Chart(ctx).Bar(data);

}