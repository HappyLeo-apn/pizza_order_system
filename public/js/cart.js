$(document).ready(function(){
    //when + button click
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("-Ks", ""));
        
        $quantity = Number($parentNode.find("#qty").val());
        $total = $price * $quantity;
        
        $parentNode.find("#total").html($total + "-Ks");
        summaryCalculation();
        
    })
    //when - button click
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("-Ks", ""));
        $quantity = Number($parentNode.find("#qty").val());
        $total = $price * $quantity;
        console.log($total);
        $parentNode.find("#total").html($total + "-Ks");

         summaryCalculation();
    })
    //when cross button click
   
   

    
})