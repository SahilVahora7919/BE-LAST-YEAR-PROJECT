<!-- CSS START -->

@include('admin.css')

<!-- CSS END -->

<!-- NAVBAR START -->

@include('admin.nav')

<!-- NAVBAR END -->

<!-- MAIN CONTENT START -->

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">COD Order Details</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="redirect">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">COD Order</li>
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
        <div class="table-responsive">

            <table class="table v-middle">
                <thead>
                    <tr class="bg-light">
                        <th style="text-align: center;" class="border-top-0">Product Image</th>
                        <th style="text-align: center;" class="border-top-0">Quantity</th>
                        <th style="text-align: center;" class="border-top-0">Weight</th>
                        <th style="text-align: center;" class="border-top-0">Total Cost</th>
                        <th style="text-align: center;" class="border-top-0">Address</th>
                        <th style="text-align: center;" class="border-top-0">Name</th>
                        <th style="text-align: center;" class="border-top-0">Contact</th>
                        <th style="text-align: center;" class="border-top-0">Payment Status</th>
                        <th style="text-align: center;" class="border-top-0">Delivery Status</th>
                        <th style="text-align: center;" class="border-top-0">Details</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order as $order)
                        <tr>
                            <td style="text-align: center;">
                                <img class="rounded-circle" width="150" src="/product/{{ $order->image }}">
                                <br>
                                {{ $order->product_title }}
                            </td>
                            <td style="text-align: center;">{{ $order->quantity }}</td>
                            <td style="text-align: center;">{{ $order->weight }}</td>
                            <td style="text-align: center;">{{ $order->total_price }}</td>
                            <td style="text-align: center;">{{ $order->address }}, {{ $order->city }},
                                {{ $order->postcode }}, {{ $order->state }}, {{ $order->country }}</td>
                            <td style="text-align: center;">{{ $order->first_name }} {{ $order->last_name }}</td>
                            <td style="text-align: center;">{{ $order->phone_number }} - {{ $order->email }}</td>

                            <td style="text-align: center;">
                                @if ($order->payment_status == 'Cash On Delivery')
                                    <span class="badge rounded-pill bg-warning text-light">COD</span>
                                @else
                                    <span class="badge rounded-pill bg-success text-light">Paid</span>
                                @endif
                            </td>

                            <td style="text-align: center;">
                                @if ($order->delivery_status == 'Processing')
                                    <span class="badge rounded-pill bg-warning text-light">Processing</span>
                                @elseif ($order->delivery_status == 'Order Cancelled')
                                    <span class="badge rounded-pill bg-danger text-light">Cancel</span>
                                @else
                                    <span class="badge rounded-pill bg-success text-light">Delivered</span>
                                @endif
                            </td>


                            <td style="text-align: center;">

                                @if ($order->delivery_status == 'Processing')
                                    <a onclick="showDeliveredConfirmation('{{ url('delivered', $order->id) }}');"
                                        class="btn btn-info btn-sm">Delivered</a>
                                @elseif ($order->delivery_status == 'Order Cancelled')
                                    <a class="btn btn-danger btn-sm disabled text-light">CANCEL</a>
                                @else
                                    <a class="btn btn-success btn-sm disabled text-light">Delivered</a>
                                @endif

                                <br>
                                <br>

                                @if ($order->delivery_status == 'Processing')
                                    <a href="{{ url('print_pdf', $order->id) }}"
                                        class="btn btn-primary btn-sm text-light">Invoice</a>
                                @elseif ($order->delivery_status == 'Order Cancelled')
                                    <a class="btn btn-primary btn-sm text-light disabled">No Invoice</a>
                                @else
                                    <a href="{{ url('print_pdf', $order->id) }}"
                                        class="btn btn-primary btn-sm text-light">Invoice</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

    <!-- MAIN CONTENT END -->

    <!-- FOOTER START -->

    @include('admin.footer')

    <!-- FOOTER END -->

    <!-- JS START -->

    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function showDeliveredConfirmation(deliveredUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure the product has been delivered?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delivered!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to delivered URL
                    window.location.href = deliveredUrl;
                }
            });
        }
    </script>

    @include('admin.js')

    <!-- JS END -->
