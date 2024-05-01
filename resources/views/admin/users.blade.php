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
                <h4 class="page-title">USER DETAILS</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="redirect">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Details</li>
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

            <h2 class="text-center">ADMIN TABLE</h2>
            <br>

            <table class="table v-middle">
                <thead>
                    <tr class="bg-light">
                        <th style="text-align: center;" class="border-top-0">User ID</th>
                        <th style="text-align: center;" class="border-top-0">Name</th>
                        <th style="text-align: center;" class="border-top-0">Email</th>
                        <th style="text-align: center;" class="border-top-0">Status</th>
                        <th style="text-align: center;" class="border-top-0">Edit</th>
                        <th style="text-align: center;" class="border-top-0">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        @if ($user->usertype == 1)
                            <tr>
                                <td style="text-align: center;" class="border-top-0">{{ $user->id }}</td>
                                <td style="text-align: center;" class="border-top-0">{{ $user->name }}</td>
                                <td style="text-align: center;" class="border-top-0">{{ $user->email }}</td>
                                <td style="text-align: center;" class="border-top-0">
                                    @if ($user->email_verified_at)
                                        <span class="badge rounded-pill bg-success text-light">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-warning text-light">Inactive</span>
                                    @endif
                                </td>
                                <td style="text-align: center;" class="border-top-0">
                                    <a href="{{ url('update_users', $user->id) }}" class="btn btn-primary btn-circle">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;" class="border-top-0">
                                    <button onclick="showDeleteConfirmation('{{ url('delete_users', $user->id) }}')" class="btn btn-danger btn-circle">
                                        <i class="mdi mdi-delete-forever"></i>
                                    </button>
                                </td>                                
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
            <br>

            <h2 class="text-center">USER TABLE</h2>
            <br>

            <table class="table v-middle">
                <thead>
                    <tr class="bg-light">
                        <th style="text-align: center;" class="border-top-0">User ID</th>
                        <th style="text-align: center;" class="border-top-0">Name</th>
                        <th style="text-align: center;" class="border-top-0">Email</th>
                        <th style="text-align: center;" class="border-top-0">Status</th>
                        <th style="text-align: center;" class="border-top-0">Edit</th>
                        <th style="text-align: center;" class="border-top-0">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        @if ($user->usertype == 0)
                            <tr>
                                <td style="text-align: center;" class="border-top-0">{{ $user->id }}</td>
                                <td style="text-align: center;" class="border-top-0">{{ $user->name }}</td>
                                <td style="text-align: center;" class="border-top-0">{{ $user->email }}</td>
                                <td style="text-align: center;" class="border-top-0">
                                    @if ($user->email_verified_at)
                                        <span class="badge rounded-pill bg-success text-light">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-warning text-light">Inactive</span>
                                    @endif
                                </td>
                                <td style="text-align: center;" class="border-top-0">
                                    <a href="{{ url('update_users', $user->id) }}" class="btn btn-primary btn-circle">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;" class="border-top-0">
                                    <button onclick="showDeleteConfirmation('{{ url('delete_users', $user->id) }}')" class="btn btn-danger btn-circle">
                                        <i class="mdi mdi-delete-forever"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>

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
                        text: 'This action is irreversible. Once deleted, the user cannot be recovered.',
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
