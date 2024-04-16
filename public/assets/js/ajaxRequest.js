function deleteEvent(id) {
    if (confirm("Are you sure you want to delete this Event?")) {
        $.ajax({
            url: "/eventDelete/" + id,
            type: "GET",

            success: function (response) {},
            error: function (xhr, status, error) {
                alert("Error deleting Event: " + error);
            },
        });
    }
}

function addtoCart(id) {
    // if (confirm("Are you sure you want to Add this Ticket to Cart?")) {
    $.ajax({
        url: "/addtoCart/" + id,
        type: "GET",

        success: function (response) {},
        error: function (xhr, status, error) {
            alert("Error in Add to Cart Ticket: " + error);
        },
    });
    // }
}

function deleteCartItem(id) {
    if (confirm("Are you sure you want to Delete this Item from cart")) {
        $.ajax({
            url: "/deleteFromCart/" + id,
            type: "GET",

            success: function (response) {},
            error: function (xhr, status, error) {
                alert("Error Deleting the item :" + error);
            },
        });
    }
}

function increaseQuantity(id) {
    $.ajax({
        url: "/increaseQuantity/" + id,
        type: "POST",
        success: function (response) {
            $("#quantity-" + id).text(response.quantity);
            $("#SubTotal1").text(response.SubTotal);
            $("#SubTotal2").text(response.SubTotal);
            $("#SubTotal3").text(response.SubTotal);
            $("#SubTotal4").text(response.SubTotal);
            $("#ticket").text(response.ticket);
            if (response.error) {
                $("#error-message").text(response.error).show(1000);
                setTimeout(function () {
                    $("#error-message").fadeOut(1000);
                }, 5000);
            }
        },
        error: function (xhr, status, error) {
            var errorMessage =
                xhr.responseJSON && xhr.responseJSON.error
                    ? xhr.responseJSON.error
                    : "Unknown error";
            console.error(errorMessage);
        },
    });
}

function decreaseQuantity(id) {
    $.ajax({
        url: "/decreaseQuantity/" + id,
        type: "POST",
        success: function (response) {
            if (response.delete) {
                // If the response indicates that the item should be deleted, call deleteCartItem
                deleteCartItem(id);
                location.reload();
            } else {
                // If not, update the quantity displayed
                $("#quantity-" + id).html(response.quantity);
                $("#SubTotal1").text(response.SubTotal);
                $("#SubTotal2").text(response.SubTotal);
                $("#SubTotal3").text(response.SubTotal);
                $("#SubTota4").text(response.SubTotal);
                $("#ticket").text(response.ticket);
                // location.reload();
            }
        },
        error: function (xhr, status, error) {
            var errorMessage =
                xhr.responseJSON && xhr.responseJSON.error
                    ? xhr.responseJSON.error
                    : "Unknown error";
            console.error(errorMessage);
        },
    });
}

// Delete the user
function deleteUser(id) {
    if (confirm("Are you sure you want to delete this User?")) {
        $.ajax({
            url: "/userDelete/" + id,
            method: "get",
            data: { id: id },
            success: function () {
                alert("User Deleted Successfully");
            },
            error: function (xhr, status, error) {
                alert("Error deleting Event: " + error);
            },
        });
    }
}

// Session Alert Animation
$(document).ready(function () {
    // Hide the alert after 5 seconds (5000 milliseconds)
    setTimeout(function () {
        $("#alert").fadeOut("slow");
    }, 3000);
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
