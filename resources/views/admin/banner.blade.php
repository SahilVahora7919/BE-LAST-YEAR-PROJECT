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
                <h4 class="page-title">ADD FOOTER BANNER</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="redirect">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Footer Banner</li>
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
                    <form action="{{ route('admin.banners') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Banner Category or Product
                                Name</span>
                            <input type="text" name="banner_name" id="WriteCategoryName" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                        </div>
                        <br>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Banner Image</span>
                            <input type="file" name="image" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-lg" required>
                        </div>
                        <br>
                        <center>
                            <button type="submit" class="btn btn-primary btn-lg" name="submit">ADD BANNER</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        <br>

        <table class="table v-middle text-center">
            <thead>
                <tr class="bg-light">
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td><img src="{{ asset('img/banner/' . $banner->image) }}" alt="Banner Image"
                                style="max-width: 285px; max-height:135px;">
                            <br>
                            {{ $banner->banner_name }}
                        </td>
                        <td style="text-align: center;">
                            <button onclick="showDeleteConfirmation('{{ url('delete_banner', $banner->id) }}')"
                                class="badge-pending btn btn-danger">Delete</button>
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
    function showDeleteConfirmation(deleteUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action is irreversible. Are you sure you want to delete this?',
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
