function MajPerso(){
  
  $("#modForce").val(Math.floor(($("#caracFOR").val()-10)/2));
  $("#modDex").val(Math.floor(($("#caracDEX").val()-10)/2));
  $("#modCon").val(Math.floor(($("#caracCON").val()-10)/2));
  $("#modInt").val(Math.floor(($("#caracINT").val()-10)/2));
  $("#modSag").val(Math.floor(($("#caracSAG").val()-10)/2));
  $("#modCha").val(Math.floor(($("#caracCHA").val()-10)/2));

  let modForce = parseInt($("#modForce").val());
  let modDex = parseInt($("#modDex").val());
  let modCon = parseInt($("#modCon").val());
  let modInt = parseInt($("#modInt").val());
  let modSag = parseInt($("#modSag").val());
  let modCha = parseInt($("#modCha").val());

  
  
  $("#pe_total").val(parseInt($("#pe_total").attr("data-classe"))+parseInt($("#modCon").val()));
  $("#pv_total").val(parseInt($("#pv_total").attr("data-classe"))+parseInt($("#pv_total").attr("data-race")));
  

  $(".mod_carac").each(function(){
    if($(this).attr("data-carac")=="FOR"){
      $(this).val(modForce);
    }else if($(this).attr("data-carac")=="DEX"){
      $(this).val(modDex);
    }else if($(this).attr("data-carac")=="CON"){
      $(this).val(modCon);
    }else if($(this).attr("data-carac")=="INT"){
      $(this).val(modInt);
    }else if($(this).attr("data-carac")=="SAG"){
      $(this).val(modSag);
    }else if($(this).attr("data-carac")=="CHA"){
      $(this).val(modCha);
    }
  });

  $(".line_competence").each(function(){
    let total_carac = $(this).find(".total_carac");
    let rang = parseInt($(this).find(".rang").val());
    let bonus_class = parseInt($(this).find(".bonus_class").val());
    let mod_carac = parseInt($(this).find(".mod_carac").val());

    total_carac.val(rang+bonus_class+mod_carac);
  });

  $("#dex_cae").val(modDex); 
  $("#dex_cac").val(modDex); 

  $("#cae").val(10+parseInt(modDex));
  $("#cac").val(10+parseInt(modDex));

  $("#con_vigueur").val(modCon);
  $("#dex_reflexe").val(modDex);
  $("#sag_volonte").val(modSag);

  $("#vigueur").val(parseInt($("#jds_vigueur").val())+modCon);
  $("#reflexe").val(parseInt($("#jds_reflexe").val())+modDex);
  $("#volonte").val(parseInt($("#jds_volonte").val())+modSag);

  $("#for_cac").val(modForce);
  $("#for_dist").val(modForce);
  $("#for_lancer").val(modForce);

  $("#bonus_cac").val(parseInt($("#bba_cac").val())+modForce);
  $("#bonus_dist").val(parseInt($("#bba_dist").val())+modForce);
  $("#bonus_lancer").val(parseInt($("#bba_lancer").val())+modForce);
}

function startLoading(){
  //on ferme la modal
  $("button[data-bs-dismiss=modal]").trigger("click");
  //on revient en haut de page
  $("html, body").scrollTop(0);
  //apparition de l'animation de chargement
  $("#loadingBackground").addClass("lds-roller");
  //on bloque le scroll
  $("body").addClass("loading");
}

function endLoading(){
  //fin de l'animation de chargement
  $("#loadingBackground").removeClass("lds-roller");
  //on débloque le scroll
  $("body").removeClass("loading");
}

function changeValue(){

}


$(".carac,.jds,.bba").change(function(){
  MajPerso();
})
//selection de la classe
$(".chooseClasse").click(function(){
  $(".chooseClasse").removeClass("active");
  $(this).addClass("active");
})
$("#saveClasse").click(function(){
  var classe = $(".chooseClasse.active").attr("data-id");
    $.ajax({
        url: "/getclasse/"+classe,
        beforeSend : function(){
          startLoading();
          
        }
      }).done(function(data){
        
      
        //raz des valeur
        
        $("#pv_total").val(parseInt($("#pv_total").val())-parseInt($("#pv_total").attr("data-classe")));
       

        //ajout nouvelles valeurs
        $("#pe_total").attr("data-classe",data.pe);
        $("#pv_total").attr("data-classe",data.pv);

        //modification infos classe
        $("#chooseClasseBtn").text(data.titre);
        $("#inputClasse").val(data.id);

        MajPerso();
        endLoading();
      })
});
//selection de la race
$(".chooseRace").click(function(){
  $(".chooseRace").removeClass("active");
  $(this).addClass("active");
})
$("#saveRace").click(function(){
  var race = $(".chooseRace.active").attr("data-id");
  $.ajax({
    url: "/getrace/"+race,
    beforeSend : function(){
      startLoading();
      
    }
  }).done(function(data){
    
    //raz des valeur
    $("#caracFOR").val(parseInt($("#caracFOR").val())-parseInt($("#caracFOR").attr("data-race")));
    $("#caracDEX").val(parseInt($("#caracDEX").val())-parseInt($("#caracDEX").attr("data-race")));
    $("#caracCON").val(parseInt($("#caracCON").val())-parseInt($("#caracCON").attr("data-race")));
    $("#caracINT").val(parseInt($("#caracINT").val())-parseInt($("#caracINT").attr("data-race")));
    $("#caracSAG").val(parseInt($("#caracSAG").val())-parseInt($("#caracSAG").attr("data-race")));
    $("#caracCHA").val(parseInt($("#caracCHA").val())-parseInt($("#caracCHA").attr("data-race")));

    $("#pv_total").val(parseInt($("#pv_total").val())-parseInt($("#pv_total").attr("data-race")));

    //ajout des nouvelles valeurs

    $("#caracFOR").val(parseInt($("#caracFOR").val())+parseInt(data.for)).attr("data-race",parseInt(data.for));
    $("#caracDEX").val(parseInt($("#caracDEX").val())+parseInt(data.dex)).attr("data-race",parseInt(data.dex));
    $("#caracCON").val(parseInt($("#caracCON").val())+parseInt(data.con)).attr("data-race",parseInt(data.con));
    $("#caracINT").val(parseInt($("#caracINT").val())+parseInt(data.int)).attr("data-race",parseInt(data.int));
    $("#caracSAG").val(parseInt($("#caracSAG").val())+parseInt(data.sag)).attr("data-race",parseInt(data.sag));
    $("#caracCHA").val(parseInt($("#caracCHA").val())+parseInt(data.cha)).attr("data-race",parseInt(data.cha));

    $("#pv_total").attr("data-race",data.pv);

    //modification infos race
    $("#chooseRaceBtn").text(data.titre);
    $("#inputRace").val(data.id);

    MajPerso();
    endLoading();
  })
});

//Selection du theme
$(".chooseTheme").click(function(){
  $(".chooseTheme").removeClass("active");
  $(this).addClass("active");
})
$("#saveTheme").click(function(){
  var theme = $(".chooseTheme.active").attr("data-id");
  $.ajax({
    url: "/gettheme/"+theme,
    beforeSend : function(){
      startLoading();
      
    }
  }).done(function(data){
    
    //raz des valeur
    $("#caracFOR").val(parseInt($("#caracFOR").val())-parseInt($("#caracFOR").attr("data-theme")));
    $("#caracDEX").val(parseInt($("#caracDEX").val())-parseInt($("#caracDEX").attr("data-theme")));
    $("#caracCON").val(parseInt($("#caracCON").val())-parseInt($("#caracCON").attr("data-theme")));
    $("#caracINT").val(parseInt($("#caracINT").val())-parseInt($("#caracINT").attr("data-theme")));
    $("#caracSAG").val(parseInt($("#caracSAG").val())-parseInt($("#caracSAG").attr("data-theme")));
    $("#caracCHA").val(parseInt($("#caracCHA").val())-parseInt($("#caracCHA").attr("data-theme")));

    //ajout des nouvelles valeurs
    $("#caracFOR").val(parseInt($("#caracFOR").val())+parseInt(data.for)).attr("data-theme",parseInt(data.for));
    $("#caracDEX").val(parseInt($("#caracDEX").val())+parseInt(data.dex)).attr("data-theme",parseInt(data.dex));
    $("#caracCON").val(parseInt($("#caracCON").val())+parseInt(data.con)).attr("data-theme",parseInt(data.con));
    $("#caracINT").val(parseInt($("#caracINT").val())+parseInt(data.int)).attr("data-theme",parseInt(data.int));
    $("#caracSAG").val(parseInt($("#caracSAG").val())+parseInt(data.sag)).attr("data-theme",parseInt(data.sag));
    $("#caracCHA").val(parseInt($("#caracCHA").val())+parseInt(data.cha)).attr("data-theme",parseInt(data.cha));

    //modification infos thème
    $("#chooseThemeBtn").text(data.titre);
    $("#inputTheme").val(data.id);

    MajPerso();
    endLoading();
  })
});


//cocher une compétence
$(".check_competence").click(function(){
  let line = $(this).closest(".line_competence");
  let rang = parseInt(line.find(".rang").val());
  if($(this).is(':checked') && rang>0){
    line.find(".bonus_class").val(3);
  }else{
    line.find(".bonus_class").val(0);
  }
  MajPerso();
})
//changement rang
$(".rang").change(function(){
  let val = parseInt($(this).val());
  let line = $(this).closest(".line_competence");
  let bonus_class = line.find(".bonus_class");
  let check = line.find(".check_competence");
  if(check.is(':checked')){
    if(val==0){
      bonus_class.val(0);
    }else{
      bonus_class.val(3);
    }
  }
  
  MajPerso();
});
//navigation feuille perso
$(".nav-tabs .nav-item .nav-link").click(function(){
  $(this).closest(".nav-item").siblings().find(".nav-link").removeClass("active");
  $(this).addClass("active");
  
  $('.bloc_infos .bloc_form').removeClass("active");
  var bloc = $(this).attr("data-bloc");
  console.log(bloc);
  $("#"+bloc).addClass("active");
})

$( document ).ready(function() {
  MajPerso();
});