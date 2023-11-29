function calculateBill() {
    // Get units from the input
    var units = $("#units").val();

    // Make API request to calculate bill
    $.ajax({
        url: "http://localhost:4000/api/v1/getBill",
       
        type: "POST",
        data: { unit: units },
        
        success: function(response) {
            // Display the result
            $("#result").html("<p>Total Bill: $" + response.data + "</p>");
        },
        error: function(error) {
            console.log("Error:", error);
            // Display an error message
            $("#result").html("<p>Error calculating bill</p>");
        }
        
        
    });
}
