//JavaScript Functions
window.onload = function(){
    
  //  MODAL POP UP FOR WHEN AN IMAGE IS WENT OVER
    $(".paintingPreview img").on("mouseover",function(){
        $(".paintingPopOver").remove();
        $("<div class='paintingPopOver ui modal'></div>").prependTo(".paintingPreview");
        var fileName = $(this).attr("src");
        
        
        fileName = fileName.slice(31, fileName.length-4);
        
        $("<img src='images/art/works/average/" + fileName + ".jpg' class='image'>").appendTo(".paintingPopOver");

        $(".modal").css({"max-width":"20%", "margin":"5%", "top":"15%"});
        $(".modal img").css({"margin":"auto", "padding":"5%", "max-width":"100%"});
        $(".paintingPopOver").show();
   
        //alert(fileName);
    // REMOVING THE MODAL POP UP WHEN THE MOUSE IS TAKEN OFF THE IMAGE
    $(".paintingPreview img").on("mouseout", function(){
       $(".paintingPopOver").remove();     
        });
    
    
    });
    
    
    
    
    
    
};