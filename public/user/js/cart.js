$(document).ready(function(){

    // Select place for delivery
    $('#cityFee').on('change', function() {
        $selected_option_value = Number($(this).find(":selected").val());
        $totalSummary = 0;
        $("#dataTable tr").each(function(index,row){
            $totalSummary += Number($(row).find("#total").text().replace("kyats",""));
        });
        $("#subtotalprice").html(`${$totalSummary}`);
        $("#finalPrice").html(`${$totalSummary+$selected_option_value}`)
    });

    // When add button click
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").html().replace("kyats",""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $selected_option_value = 0;
        $parentNode.find('#total').html($total+" kyats");
        summaryCalculation();
    });

    // When minus button click
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").html().replace("kyats",""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $parentNode.find("#total");
        $minusOperation = $price * $qty;
        $total.html($minusOperation+" kyats");
        summaryCalculation();
    })

     // Summary Calculation
    function summaryCalculation(){
        $cityFee = Number($("#cityFee option:selected").val());
        $totalSummary = 0;
        $("#dataTable tr").each(function(index,row){
            $totalSummary += Number($(row).find("#total").text().replace("kyats",""));
        });
        $("#subtotalprice").html(`${$totalSummary}`);
        $("#finalPrice").html(`${$totalSummary+$cityFee}`);
    }
});
