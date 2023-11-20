$( document ).ready(function() {
    $(".delete_personnage").click(function(){
        var id = $(this).attr("data-id");
        var content = $(this).closest(".card");
        $.ajax({
            url: "/deletePersonnage/"+id,
            
          }).done(function(){
            content.remove();
          })
    });
  
    
  });