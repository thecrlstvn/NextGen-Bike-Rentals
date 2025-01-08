$(document).ready(function () {
    
    $('.increment-btn').click(function (e) { 
        e.preventDefault();
        
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }

    });

    $('.decrement-btn').click(function (e) { 
        e.preventDefault();
        
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
    
    $('.addToCartBtn').click(function (e) {
        e.preventDefault();
    
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id =$(this).val();
    
        $.ajax({
            type: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                console.log(response); // Log the entire response
                if (response == 201) {
                    alertify.success("Product Added to Cart");
                } else if (response == 401) {
                    alertify.error("Log in to Continue");
                } else if (response == 409) {
                    alertify.error("Already in cart");
                } else if (response == 500) {
                    alertify.error("Something went wrong");
                }
            }
        });
    });
    
    $(document).on('click', '.updateQty', function () {
        var button = $(this); // Added this line to declare 'button'
        var prodId = button.closest('.col-md-3').find('.prodId').val();
        var inputQty = button.closest('.input-group').find('.input-qty');
        var currentQty = parseInt(inputQty.val(), 10);
        
        // Ensure the quantity is a positive integer
        var incrementAmount = button.hasClass('increment-btn') ? 1 : -1;
        var newQty = Math.max(1, currentQty + incrementAmount);


        
        // Update the input field with the new quantity
        inputQty.val(newQty);
        
        // Make an AJAX request to update the quantity on the server
        $.ajax({
            type: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prodId,
                "prod_qty": newQty,
                "scope": "update"
            },
            success: function (response) {
                if (response == 200) {
                    // Quantity updated successfully
                    console.log("Quantity updated successfully");
                } else {
                    // Handle other cases if needed
                    console.log("Failed to update quantity");
                }
            }
        });
    });

    $(document).on('click', '.deleteToCartBtn', function () {
        // Retrieve the value of the clicked element (presumably a cart item ID)
        var cart_id = $(this).val();
    
        // Make an AJAX request to the server
        $.ajax({
            type: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                // Handle the server's response
                if (response == "200") {
                    // If the response is "200," show a success message and refresh the cart
                    alertify.success("Item Removed Successfully");
                    $('#mycart').load(location.href + "#mycart")
                } else {
                    // If the response is not "200," show an error message
                    alertify.error(response);
                }
            }
        });
    });
});


