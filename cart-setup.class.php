
<?php
/*****Cart-Setup.Class***/
class cartSetup{
    
    
    
    
    function itemDropDown($quantity, $id, $frameTitle, $glassTitle, $matteTitle, $frameDropDown, $glassDropDown, $mattDropDown){
        $output ='';
        $output .= '<h3  data-tooltip="Click the checkbox to accept changes" >Change Options</h3>';        
        $output .= '<table class="ui compact celled definition blue table"><tr><td>Quantity </td><td class="currentQuantity">'. $quantity .'</td><td><input type="number" min="1" class="quantitySelector" value="'. $quantity .'" name="'.$id . 'Quantity"></td></tr>';
       $output .=  '<tr><td>Frame</td><td class="currentFrame">'. $frameTitle .'</td>';
      $output .= '<td>' . $frameDropDown .  '</td></tr>';
      $output .=  '<tr><td>Glass</td><td class="currentGlass">'. $glassTitle.'</td><td>';              
      $output .=  $glassDropDown . '</td></tr>';
      $output .=  '<tr><td>Matte</td><td class="currentMatte">'. $matteTitle.'</td><td>';              
      $output .=  $mattDropDown .  '</td></tr>';   
       $output .= '</table></div></div>';
        return $output;
        
        
        
        
    }

    function subtotalPricingTable($basePrice, $frameCost, $glassCost, $matteCost, $subTotal, $id/*, $quantity*/){
        $output = '';
        $output .= '<div>';             
        $output .= '<h3> Pricing </h3>';
        $output .= '<table class="ui orange table">';                 
        $output .= '<tr><td data-tooltip="Base Price = MSRP x Quantity"><b>Base Price: </b></td><td class="basePrice">$'. $basePrice . '</td></tr>';
        $output .= '<tr><td><b>Frame Cost: </b></td><td class="frameCost">$'. $frameCost . '</td></tr>';        
        $output .= '<tr><td><b>Glass Cost: </b></td><td class="glassCost">$'. $glassCost  .'</td></tr>'; 
        $output .= '<tr><td><b>Matte Cost: </b></td><td class="matteCost">$'. $matteCost . '</td></tr>';
        //$output .= '<tr><td><b>Shipping Method:</b></td><td><select class="ui">';
        //$output .= '<option value="standard">Standard</option><option value="express">Express</option></td></tr>';
        $output .= '<tr><td><b>Subtotal: </b></td><td class="subtotal">$'. /*(*/$subTotal /*+ (25 * $quantity))*/. '</td></tr>';
        $output .= '</table>';
        $output .= '</div></div><div>';
        $output .= '<button class="ui right floated button" type="submit" name="'. $id .'remove" value="yes">Remove</button>';     
        //$output .= '<input class="ui right floated button" type="submit" value="Update Item"></form>';                                      
        $output .= '</a>';                                   
        $output .= '</div>';          
        $output .='<br><br><div class="ui divider"></div>';
        
        return $output;
        
    }
    
    
    
    function totalPricingTable($standard, $express, $totalSubTotal){
        
        $output = '';
        $output .= '<table class="ui striped yellow table">';
        $output .= '<td class="ui align center"><h3> Total Pricing</h3></td> ';
        $output .= '<tr><td><b>Shipping Method:</b></td><td><select class="ui shippingDropdown">';
        $output .= '<option value="standard">Standard</option><option value="express">Express</option></td><td id="ship">$'. $standard .  '</td></tr>';
        $output .= '<tr><td><b>Total(including shipping)</b><td></td><td id="total">$'. ($totalSubTotal + $standard) . '</td></tr>';
       // $output .= '<tr><td><b>Express Shipping:</b></td><td> $' . $express . '</td></tr>';     
        //$output .= '<tr><td><b>Total Cost with Standard Shipping:</b></td><td>$'. ($totalSubTotal + $standard) . '</td></tr>';
        //$output .= '<tr><td><b>Total Cost with Express Shipping:</b></td><td>$'. ($totalSubTotal + $express) . '</td></tr>';
        $output .= '</table>';
        $output .= '</div><br>';
        
        return $output;

    }
    
    
    
    
    function bottomButtons(){
        $output = '';
        //$output .= '<form class="ui form" method="GET" action="update-cart.php">';          
       // $output .=  '<input class="ui right floated orange button" type="submit" name="cartOptions" value="Update">';
        $output .=  '<input class="ui right floated orange button" type="submit" name="cartOptions" value="Empty Cart">';
        //$output .=  '</form><a href=index.php><input class="ui right floated orange button continue" type="submit" name="cartOptions" value="Continue Shopping"></a>';
        $output .=  '<input class="ui right floated orange button continue" type="submit" name="cartOptions" value="Continue Shopping">';
        $output .=  '<input class="ui right floated orange button" type="submit" name="cartOptions" value="Order">';
         $output .= '<br><br>';
        
        return $output;
    }
    
    
}


?>