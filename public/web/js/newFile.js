$(document).ready(function() {
    $('.razorpay_btn').click(function(e) {
        e.preventDefault();

        var first_name = $('.first_name').val();
        var last_name = $('.last_name').val();
        var country = $('.country').val();
        var address = $('.address').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var postcode = $('.postcode').val();
        var phone_number = $('.phone_number').val();
        var email = $('.email').val();

        if (!first_name) {
            fname_error = "First Name is Required";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        } else {
            fname_error = "";
            $('#fname_error').html('');
        }

        if (!last_name) {
            lname_error = "Last Name is Required";
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        } else {
            lname_error = "";
            $('#lname_error').html('');
        }

        if (!country) {
            country_error = "Country Name is Required";
            $('#country_error').html('');
            $('#country_error').html(country_error);
        } else {
            country_error = "";
            $('#country_error').html('');
        }

        if (!address) {
            address_error = "Address is Required";
            $('#address_error').html('');
            $('#address_error').html(address_error);
        } else {
            address_error = "";
            $('#address_error').html('');
        }

        if (!city) {
            city_error = "City Name is Required";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        } else {
            city_error = "";
            $('#city_error').html('');
        }

        if (!state) {
            state_error = "State Name is Required";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        } else {
            state_error = "";
            $('#state_error').html('');
        }

        if (!postcode) {
            postcode_error = "Postcode / ZIP is Required";
            $('#postcode_error').html('');
            $('#postcode_error').html(postcode_error);
        } else {
            postcode_error = "";
            $('#postcode_error').html('');
        }

        if (!phone_number) {
            phone_number_error = "Phone Number is Required";
            $('#phone_number_error').html('');
            $('#phone_number_error').html(phone_number_error);
        } else {
            phone_number_error = "";
            $('#phone_number_error').html('');
        }

        if (!email) {
            email_error = "Phone Number is Required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        } else {
            email_error = "";
            $('#email_error').html('');
        }

        if (fname_error != '' || lname_error != '' || country_error != '' || address_error != '' || city_error != '' || state_error != '' || postcode_error != '' || phone_number_error != '' || email_error != '') {
            return false;
        } else {
            var totalAmount = {}; { $totalPrice + $tax; }
        } * 100; // Total amount in paisa/cents

        var options = {
            "key": "YOUR_RAZORPAY_KEY", // Replace with your Razorpay API key
            "amount": totalAmount,
            "currency": "INR",
            "name": "Your Store Name",
            "description": "Payment for Order",
            "image": "https://yourstore.com/logo.png", // Replace with your store logo URL
            "handler": function(response) {
                // Payment success callback
                // You can perform additional actions here, such as updating order status, redirecting to a success page, etc.
                console.log(response);
                alert('Payment successful! Payment ID: ' + response.razorpay_payment_id);
            },
            "prefill": {
                "name": first_name + ' ' + last_name, // Prefill customer name from form
                "email": email, // Prefill customer email from form
                // You can prefill additional fields here if needed
            },
            "theme": {
                "color": "#3399cc" // Customize checkout theme color
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    });
});