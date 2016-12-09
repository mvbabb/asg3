window.onload = function(){
popover();
    
    
    function displayPaintings(name,value,title){
    $(".filterTitle").text(name.toUpperCase() + "=" + title.toUpperCase());
       $(".paintingSection").empty();
  $.get("service-painting.php?" + name + "id=" + value, function (data) {
              data = JSON.parse(data);
                $(data).each(function (index) {
        var cost = data[index]['cost'];
        var item = '';   
        var image = '<img src="' + data[index]['imagePath'] + '" class="image" title="'+ data[index]['Title'] +'" alt="' + data[index]['Title'] + '">';       
                    
                    
                    
		item = "<div class='item'><br>";
		item += "<div class='ui image paintingPreview'>";
		item += "<a href='" + data[index]['link'] + "'>"+ image + "</a>";
	    item += "</div><div class='middle aligned content'>";
                    
                    
		item += "<h3 class='ui header'>" + data[index]['Title'] + "<em class='sub header'>" + data[index]['firstName'] + " " + data[index]['lastName']  + "</em></h3>";
                    
		item += "<br />" + data[index]['excerpt'] + "<br />";
                  
		item += "<div class='ui divider'></div><strong>" + "$ "+ cost + "</strong><br /><div class='ui ten column grid'>";
       
        item += '<div class="column"><form method="post" action="view-cart.php"><button type="submit" name="addtocart" class="ui orange button" value='+ data[index]['paintingID'] +'><i class="cart icon"></i></button></form></div><span></span>';
       
        
		item += '<div class="column"><form method="post" action="view-favorites.php"><button type="submit" name="addfavp" class="ui button" value='+ data[index]['paintingID'] + '><i class="favorite icon"></i></button></form></div>';
		item +="</div></div></div><div class='ui divider'></div>";        
                  
                    
         $(item).appendTo(".paintingSection"); 
    popover();
});        
  });}
    
    
$(".dropdown").on("change", function(){
    var name = $(this).find("select").attr("id");
    var value = $("option:selected", this).val();
    var title = $("option:selected", this).text();
    //displayPaintings(name,value,title);
    $(".paintingSection").transition('slide left', {duration   : '2s'}).delay(1900).queue(function (){
        $(".dim").dimmer("show").delay(1000).queue(function(){
            alert("hello");
            if($(".paintingSection").hasClass("hidden")){
            $(".paintingSection").removeClass("hidden");
            }
            displayPaintings(name, value,title); 
            //$(".dim").dimmer("hide");
        }).transition("slide right");//$(".paintingSection").transition("reset");
        
    });
    
    
});

  
  
    
        




    
    
    
    function popover(){
        $(".paintingPreview img").on("mouseover",function(){
        $(".paintingPopOver").remove();
        $("<div class='paintingPopOver ui modal'></div>").prependTo(".paintingPreview");
        var fileName = $(this).attr("src");
        
        
        fileName = fileName.slice(31, fileName.length-4);
        
        $("<img src='images/art/works/average/" + fileName + ".jpg' class='image'>").appendTo(".paintingPopOver");

        $(".modal").css({"max-width":"20%", "margin":"5%", "top":"15%"});
        $(".modal img").css({"margin":"auto", "padding":"5%", "max-width":"100%"});
        $(".paintingPopOver").show();
    // REMOVING THE MODAL POP UP WHEN THE MOUSE IS TAKEN OFF THE IMAGE
    $(".paintingPreview img").on("mouseout", function(){
       $(".paintingPopOver").remove();     
        });
});
    }
    
    
    
    
    





}
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
/*
$.get("service-painting.php?artistid=135", function (data) {
              data = JSON.parse(data);
                //alert("Data Loaded" + data[0].Title);
          $("<br><br><select id='citiesDropDown'></select>").insertAfter("#countriesDropDown");
                $(data).each(function (index) {
                    $("<option value='" + data[index]['paintingID'] + "'>" + data[index]['Title'] + "</option>").appendTo("#citiesDropDown");
                    
                    
                    
                    
                    */