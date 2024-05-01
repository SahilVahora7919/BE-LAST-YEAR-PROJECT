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

        var data = {
            'first_name': first_name,
            'last_name': last_name,
            'country': country,
            'address': address,
            'city': city,
            'state': state,
            'postcode': postcode,
            'phone_number': phone_number,
            'email': email
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/processed-to-pay",
            data: data, // Use the 'data' variable here

            success: function(response) {

                var amountInPaise = Math.round(response.total_price * 100);
                var options = {

                    "key": "rzp_test_YsDfkRwio4K989", // Enter the Key ID generated from the Dashboard
                    "amount": amountInPaise, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": response.first_name + ' ' + response.last_name, //your business name
                    "description": "Thankyou For Choosing Us",
                    "image": "https://example.com/your_logo",
                    // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",

                    "handler": function(responsea) {
                        Swal.fire({
                            title: 'Your Payment ID',
                            text: responsea.razorpay_payment_id,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 5000 // Time in milliseconds (5 seconds)
                        });

                        $.ajax({
                            method: "POST",
                            url: "/store-order-data",
                            data: {
                                'first_name': response.first_name,
                                'last_name': response.last_name,
                                'country': response.country,
                                'address': response.address,
                                'city': response.city,
                                'state': response.state,
                                'postcode': response.postcode,
                                'phone_number': response.phone_number,
                                'email': response.email,
                                'razorpay_payment_id': responsea.razorpay_payment_id,
                            },
                            success: function(data) {
                                window.location.href = "/show_order";
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                console.error(status);
                                console.error(error);
                            }
                        });

                    },

                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                        "name": response.first_name + ' ' + response.last_name, //your customer's name
                        "email": response.email,
                        "contact": response.phone_number, //Provide the customer's phone number for better conversion rates 
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                console.error(status);
                console.error(error);
            }
        });
    });
});