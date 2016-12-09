window.onload = function(){
    
    function updateSubTotal(x){
        var basePrice = $(x).closest(".item").find(".basePrice").text().substr(1,$(x).closest(".item").find(".basePrice").text().length);
        var frameCost = $(x).closest(".item").find(".frameCost").text().substr(1,$(x).closest(".item").find(".frameCost").text().length);
        var glassCost = $(x).closest(".item").find(".glassCost").text().substr(1,$(x).closest(".item").find(".glassCost").text().length);
        var matteCost = $(x).closest(".item").find(".matteCost").text().substr(1,$(x).closest(".item").find(".matteCost").text().length);
        var subtotal = parseInt(basePrice) + parseInt(frameCost) + parseInt(glassCost) + parseInt(matteCost);
        return subtotal;  
    }
    
    
    
    function updateWithShipping(shipMethod){  //UPDATES THE FINAL TOTAL INCLUDING SHIPPING
        var subtotals = $(".subtotal");
        var total = 0;
        var totalQuantity = 0;
        var quantities = $(".currentQuantity");
        var shippingTotal = 0;
        for(var i = 0; i < subtotals.length; i++){
            total += parseInt(subtotals[i].innerHTML.substr(1,subtotals[i].innerHTML.length));
        }
        for(var i = 0; i < quantities.length; i++){
            totalQuantity += parseInt(quantities[i].innerHTML);
        }   
        if(shipMethod == "standard"){
            if(total <= 1500){
                total += totalQuantity * 25;
                shippingTotal += totalQuantity * 25;
            }
        }
        else{
            
            if(total < 2500){
                total += totalQuantity * 50;
                shippingTotal += totalQuantity * 50;
            }
        }
        $("#ship").text("$" + shippingTotal);
        $("#total").text("$" + total);
        }
    
  //CHANGES THE OPTIONS  AND UPDATES ACCORDINDLY
    $('.dropdown').on("change",function(){
        var cell = $(this).parent().prev();
        
        var newValue = $("option:selected", this).text();
        $(cell).html(newValue);
        $(cell).attr("id",$("option:selected", this).val());
        
   

        
        
        var switchValue = cell.prev().text();
        var price = $("option:selected",this).attr("price");
        var quantityCost = $(this).closest("table").find(".currentQuantity").text();

        var newCost = price * quantityCost;
             if(newValue == "None"){
                   newCost = 0;
               }
//CHANGES THE SUBTOTALS BASED ON CHANGED OPTIONS
       switch(switchValue) {
    case "Frame":    
                $(this).closest(".item").find(".frameCost").text("$" + newCost);            
        break;
                 
    case "Glass":         
                $(this).closest(".item").find(".glassCost").text("$" + newCost); 
        break;
                           
    case "Matte":
               if(newCost == 0){
                    $(this).closest(".item").find(".matteCost").text("$" + (newCost * quantityCost));
               }
               else{
                   $(this).closest(".item").find(".matteCost").text("$" + (10 * quantityCost));
               }
        break;
} 
        
        var n = updateSubTotal(this);
        
        $(this).closest(".item").find(".subtotal").text("$" + n);
        
        updateWithShipping($(".shippingDropDown option:selected").val());
        
        
    });
 ///        CHANGES THE QUANTITY AND UPDATES ACCORDINGLY, UPDATES BASE PRICE WITH NEW QUANTITY   
    $('.quantitySelector').on("change", function(){
        var cell = $(this).parent().prev();
        var newValue = $(this).val();
        var oldValue = cell.text();
        var basePrice = $(this).closest(".item").find(".basePrice").text().substr(1,$(this).closest(".item").find(".basePrice").text().length);
        var newBasePrice = (basePrice / cell.text()) * newValue;
        $(cell).html(newValue);
        
        $(this).closest(".item").find(".basePrice").text("$" + newBasePrice);
       

        
        
        
        
        
        
        
///CHANGES THE SUBTOTALS BASED ON QUANTITY
       $(this).closest(".item").find(".frameCost").text(
            "$" + ($(this).closest(".item").find(".frameCost").text().substr(1,$(this).closest(".item").find(".frameCost").text().length) / oldValue) * newValue
        );
        
               $(this).closest(".item").find(".glassCost").text(
            "$" + ($(this).closest(".item").find(".glassCost").text().substr(1,$(this).closest(".item").find(".glassCost").text().length) / oldValue) * newValue
        );
               $(this).closest(".item").find(".matteCost").text(
            "$" + ($(this).closest(".item").find(".matteCost").text().substr(1,$(this).closest(".item").find(".matteCost").text().length) / oldValue) * newValue
        );
        
        var n = updateSubTotal(this);
        
        $(this).closest(".item").find(".subtotal").text("$" + n);
        
        
        updateWithShipping($(".shippingDropDown option:selected").val());
        
        
    });
    
    
    
    
    
    $(".shippingDropdown").on("change", function(){
        updateWithShipping($("option:selected", this).val());
    });
    
    
    
    
    $(".continue").on("click", function(){
        var allPaintings = [];
        var paintings = $(this).closest(".items").find(".individualPainting");
        
        for(var i = 0; i < paintings.length; i++ ){
           
            var paintingID = $(paintings).eq(i).find(".paintingPreview").attr("id");
            var quantity = $(paintings).eq(i).find(".currentQuantity").text();
            var frameID = $(paintings).eq(i).find(".currentFrame").attr("id");
            var glassID = $(paintings).eq(i).find(".currentGlass").attr("id");
            var matteID = $(paintings).eq(i).find(".currentMatte").attr("id");
            var painting = {id:paintingID, quantity:quantity, frame:frameID, glass:glassID, matt:matteID}; 
            
            allPaintings.push(painting);  
            
               $.post('update-cart.php', { 'fieldname' : 'Paintings','index' : i ,'quantity' : quantity, 'frame' : frameID, 'glass' : glassID, 'matt' : mattID});
            
            
            
        }

    });

    
    
    
}