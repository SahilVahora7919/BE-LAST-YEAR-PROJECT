<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Dashboard</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="redirect">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->

        @if ($new_order_added)
            <div class="alert alert-success">
                <strong>New order added!</strong> Check for new Order in your Order Menu.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="mdi mdi-close-circle"></i>
                </button>
            </div>
        @endif

        @if ($new_user_registered)
            <div class="alert alert-info">
                <strong>New user registered!</strong> Please review user details.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="mdi mdi-close-circle"></i>
                </button>
            </div>
        @endif

        <!-- Sales chart -->
        <!-- ============================================================== -->


        <div class="row">

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                        <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                      </svg>
                    <h3>CASH WALLET</h3>
                    <p>₹{{ $total_revenue - $razorpay_revenue }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                        <path d="M3 10h18" />
                        <path d="M16 19h6" />
                        <path d="M19 16l3 3l-3 3" />
                        <path d="M7.005 15h.005" />
                        <path d="M11 15h2" />
                    </svg>
                    <h3>RAZORPAY WALLET</h3>
                    <p>₹{{ $razorpay_revenue }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                        viewBox="0 0 24 24">
                        <g fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M6 10h4"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M21.998 12.5c0-.077.002-.533 0-.565c-.036-.501-.465-.9-1.005-.933c-.035-.002-.076-.002-.16-.002h-2.602C16.446 11 15 12.343 15 14s1.447 3 3.23 3h2.603c.084 0 .125 0 .16-.002c.54-.033.97-.432 1.005-.933c.002-.032.002-.488.002-.565">
                            </path>
                            <circle cx="18" cy="14" r="1" fill="currentColor"></circle>
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M10 22h3c3.771 0 5.657 0 6.828-1.172c.809-.808 1.06-1.956 1.137-3.828m0-6c-.078-1.872-.328-3.02-1.137-3.828C18.657 6 16.771 6 13 6h-3C6.229 6 4.343 6 3.172 7.172C2 8.343 2 10.229 2 14c0 3.771 0 5.657 1.172 6.828c.653.654 1.528.943 2.828 1.07M6 6l3.735-2.477a3.237 3.237 0 0 1 3.53 0L17 6">
                            </path>
                        </g>
                    </svg>
                    <h3>TOTAL REVENUE</h3>
                    <p>₹{{ $total_revenue }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                        <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                    </svg>
                    <h3>TOTAL TAX</h3>
                    <p>{{ $total_tax }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                        <path d="M3 9l4 0" />
                    </svg>
                    <h3>TOTAL ORDER</h3>
                    <p>{{ $total_order }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-up">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M12.5 17h-6.5v-14h-2" />
                        <path d="M6 5l14 1l-.854 5.977m-2.646 1.023h-10.5" />
                        <path d="M19 22v-6" />
                        <path d="M22 19l-3 -3l-3 3" />
                    </svg>
                    <h3>ORDER DELIVERED</h3>
                    <p>{{ $total_sales }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-basket-cancel">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17 10l-2 -6" />
                        <path d="M7 10l2 -6" />
                        <path d="M12 20h-4.756a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304h13.999a2 2 0 0 1 1.977 2.304l-.3 1.713" />
                        <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M17 21l4 -4" />
                      </svg>
                    <h3>ORDER CANCELLED</h3>
                    <p>{{ $cancel_orders }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-cog">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M12 17h-6v-14h-2" />
                        <path d="M6 5l14 1l-.79 5.526m-3.21 1.474h-10" />
                        <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M19.001 15.5v1.5" />
                        <path d="M19.001 21v1.5" />
                        <path d="M22.032 17.25l-1.299 .75" />
                        <path d="M17.27 20l-1.3 .75" />
                        <path d="M15.97 17.25l1.3 .75" />
                        <path d="M20.733 20l1.3 .75" />
                    </svg>
                    <h3>ORDER PROCESSING</h3>
                    <p>{{ $total_processing }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white" id="adminBox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-pentagon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M13.163 2.168l8.021 5.828c.694 .504 .984 1.397 .719 2.212l-3.064 9.43a1.978 1.978 0 0 1 -1.881 1.367h-9.916a1.978 1.978 0 0 1 -1.881 -1.367l-3.064 -9.43a1.978 1.978 0 0 1 .719 -2.212l8.021 -5.828a1.978 1.978 0 0 1 2.326 0z" />
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M6 20.703v-.703a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.707" />
                    </svg>
                    <h3>ADMIN</h3>
                    <p>{{ $total_admin }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                    <h3>TOTAL USER</h3>
                    <p>{{ $total_user }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                        viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M12 2.75A2.25 2.25 0 0 0 9.75 5v.26c.557-.01 1.168-.01 1.84-.01h.821c.67 0 1.282 0 1.84.01V5A2.25 2.25 0 0 0 12 2.75m3.75 2.578V5a3.75 3.75 0 1 0-7.5 0v.328c-.143.012-.28.026-.414.043c-1.01.125-1.842.387-2.55.974c-.707.587-1.118 1.357-1.427 2.327c-.3.94-.526 2.147-.81 3.666l-.021.11c-.402 2.143-.718 3.832-.777 5.163c-.06 1.365.144 2.495.914 3.422c.77.928 1.843 1.336 3.195 1.529c1.32.188 3.037.188 5.218.188h.845c2.18 0 3.898 0 5.217-.188c1.352-.193 2.426-.601 3.196-1.529c.77-.927.972-2.057.913-3.422c-.058-1.331-.375-3.02-.777-5.163l-.02-.11c-.285-1.519-.512-2.727-.81-3.666c-.31-.97-.72-1.74-1.428-2.327c-.707-.587-1.54-.85-2.55-.974a11.23 11.23 0 0 0-.414-.043M8.02 6.86c-.855.105-1.372.304-1.776.64c-.403.334-.694.805-.956 1.627c-.267.84-.478 1.958-.774 3.537c-.416 2.217-.711 3.8-.764 5.013c-.052 1.19.14 1.88.569 2.399c.43.517 1.073.832 2.253 1c1.2.172 2.812.174 5.068.174h.72c2.257 0 3.867-.002 5.068-.173c1.18-.169 1.823-.484 2.253-1.001c.43-.518.621-1.208.57-2.4c-.054-1.211-.349-2.795-.765-5.012c-.296-1.58-.506-2.696-.774-3.537c-.262-.822-.552-1.293-.956-1.628c-.404-.335-.92-.534-1.776-.64c-.876-.108-2.013-.109-3.62-.109h-.72c-1.607 0-2.744.001-3.62.11m1.103 3.4a.75.75 0 0 1 .617.863l-1 6a.75.75 0 1 1-1.48-.246l1-6a.75.75 0 0 1 .863-.617m5.754 0a.75.75 0 0 1 .863.617l1 6a.75.75 0 1 1-1.48.246l-1-6a.75.75 0 0 1 .617-.863"
                            clip-rule="evenodd"></path>
                    </svg>
                    <h3>TOTAL PRODUCT</h3>
                    <p>{{ $total_product }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-category">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 4h6v6h-6z" />
                        <path d="M14 4h6v6h-6z" />
                        <path d="M4 14h6v6h-6z" />
                        <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    </svg>
                    <h3>CATEGORIES</h3>
                    <p>{{ $categories }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                    <h3>TOTAL VIEWS</h3>
                    <p>{{ session('visitors', 0) }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box bg-success text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032" />
                        <path d="M15 19l2 2l4 -4" />
                      </svg>
                    <h3>UNIQUE VIEWS</h3>
                    <p>{{ Cache::has('unique_visitors') ? count(Cache::get('unique_visitors')) : 0 }}</p>
                </div>
            </div>
            

            

        </div>

        <script>
            // Function to generate a random hexadecimal color code
            function getRandomColor() {
                return '#' + Math.floor(Math.random() * 16777215).toString(16);
            }

            // Event listener to change color when the page loads
            window.onload = function() {
                // Get the box element
                var adminBox = document.getElementById('adminBox');

                // Generate a random color
                var randomColor = getRandomColor();

                // Set the background color
                adminBox.style.setProperty('--bg-color', randomColor);
            };
        </script>

        <br>
        <!-- ============================================================== -->
        <!-- Sales chart -->

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <!-- ============================================================== -->
            <div class="row">

                <!-- Revenue chart -->
                <div class="col-md-6">
                    <div style="width: 100%; height: 400px;">
                        <h4>Last 15 Days Revenue</h4>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Pie chart -->
                <div class="col-md-6">
                    <div style="width: 100%; height: 400px;">
                        <h4>Category-wise Revenue Distribution</h4>
                        <canvas id="categoryRevenueChart"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                    <div style="width: 100%; height: 400px; padding-top: 35px;">
                        <h4>Order Stats</h4>
                        <canvas id="orderDonutChart"></canvas>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Sales chart -->
            <!-- ============================================================== -->
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Function to generate random colors
            function generateRandomColors(numColors) {
                var colors = [];
                for (var i = 0; i < numColors; i++) {
                    var color = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math
                        .floor(Math.random() * 256) + ',0.8)';
                    colors.push(color);
                }
                return colors;
            }

            var ctx = document.getElementById('revenueChart').getContext('2d');
            var dailyRevenueData = @json($daily_revenue);
            var last15Dates = Object.keys(dailyRevenueData).slice(-15);
            var last15Revenues = Object.values(dailyRevenueData).slice(-15);

            var barColors = generateRandomColors(last15Dates.length);

            var revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: last15Dates,
                    datasets: [{
                        label: 'Daily Revenue',
                        data: last15Revenues,
                        backgroundColor: barColors,
                        borderColor: barColors,
                        borderWidth: 4,
                        borderRadius: 50
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#333',
                                font: {
                                    family: 'Roboto', // Specify the font family from Google Fonts
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0)'
                            },
                            ticks: {
                                color: '#333',
                                font: {
                                    family: 'Roboto', // Specify the font family from Google Fonts
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>


        <script>
            // Function to generate random background colors
            function generateRandomColors(numColors) {
                var colors = [];
                for (var i = 0; i < numColors; i++) {
                    var color = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math
                        .floor(Math.random() * 256) + ',0.7)';
                    colors.push(color);
                }
                return colors;
            }

            // Assuming $category_revenue contains data for the last 3 months
            var categoryRevenueData = <?php echo json_encode($category_revenue); ?>;

            // Extract labels and data for the chart
            var labels = Object.keys(categoryRevenueData);
            var data = Object.values(categoryRevenueData);

            // Generate random background colors
            var backgroundColors = generateRandomColors(labels.length);

            // Get the canvas element
            var ctxDoughnut = document.getElementById('categoryRevenueChart').getContext('2d');

            // Create the doughnut chart
            var categoryRevenueChart = new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>

        <script>
            function generateRandomColors(numColors) {
                var colors = [];
                for (var i = 0; i < numColors; i++) {
                    var color = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math
                        .floor(Math.random() * 256) + ',0.7)';
                    colors.push(color);
                }
                return colors;
            }

            // Retrieve data from PHP variables
            var totalOrders = <?php echo json_encode($total_orders); ?>;
            var razorpayOrders = <?php echo json_encode($razorpay_orders); ?>;
            var nonRazorpayOrders = totalOrders - razorpayOrders;

            // Create a new chart context
            var ctx = document.getElementById('orderDonutChart').getContext('2d');
            var orderDonutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Online Payment', 'Cash on Delivery'],
                    datasets: [{
                        label: 'Order Count',
                        data: [razorpayOrders, nonRazorpayOrders],
                        backgroundColor: backgroundColors,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>




        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    </div>
