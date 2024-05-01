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
                <h4 class="page-title">ALL PRODUCT</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="redirect">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show Product</li>
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

            <center>
                @if (session()->has('message'))
                    <div class="alert alert-success">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            <i class="mdi mdi-close-circle"></i>
                        </button>
                        {{ session()->get('message') }}

                    </div>
                @endif
            </center>

            <table class="table v-middle">
                <thead>
                    <tr class="bg-light">
                        <th style="text-align: center;" class="border-top-0">Product Title</th>
                        <th style="text-align: center;" class="border-top-0">Product Status</th>
                        <th style="text-align: center;" class="border-top-0">Short Description</th>
                        <th style="text-align: center;" class="border-top-0">Weight</th>
                        <th style="text-align: center;" class="border-top-0">Quantity</th>
                        <th style="text-align: center;" class="border-top-0">Category</th>
                        <th style="text-align: center;" class="border-top-0">Price</th>
                        <th style="text-align: center;" class="border-top-0">Discount Price</th>
                        <th style="text-align: center;" class="border-top-0">Product Image</th>
                        <th style="text-align: center;" class="border-top-0">Edit</th>
                        <th style="text-align: center;" class="border-top-0">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product as $products)
                        <tr>
                            <td style="text-align: center;">{{ $products->title }}</td>
                            <td style="text-align: center;">
                                @if ($products->select == 0)
                                    <label class="label label-success">Active</label>
                                @else
                                    <label class="label label-danger">Inactive</label>
                                @endif
                            </td>
                            <td style="text-align: center;">{{ $products->description }}</td>
                            <td style="text-align: center;">{{ $products->weight }}</td>
                            <td style="text-align: center;">{{ $products->quantity }}</td>
                            <td style="text-align: center;">{{ $products->category }}</td>
                            <td style="text-align: center;">{{ $products->price }}</td>
                            <td style="text-align: center;">{{ $products->discount_price }}</td>
                            <td style="text-align: center;">
                                <img class="rounded-circle" width="150" src="/product/{{ $products->image }}">
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ url('update_product', $products->id) }}" class="btn btn-primary btn-circle">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                            </td>

                            <td style="text-align: center;">
                                <button onclick="showDeleteConfirmation('{{ url('delete_product', $products->id) }}')"
                                    class="btn btn-danger btn-circle">
                                    <i class="mdi mdi-delete-forever"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="container d-flex justify-content-center">
                {!! $product->links() !!}
            </div>

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
        function showDeleteConfirmation(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action is irreversible. Once deleted, the product cannot be recovered.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to delete URL
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>

    @include('admin.js')

    <!-- JS END -->
