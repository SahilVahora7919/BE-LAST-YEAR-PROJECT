<!-- CSS START -->

<base href="/public">
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
                <h4 class="page-title">UPDATE USER DETAILS</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="redirect">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update User Details</li>
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
            <form action="{{ url('/update_users_confirm', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <br>

                <center>
                    <div class="wrapper">
                        <input type="radio" name="usertype" value="1" id="option-1"
                            {{ $user->usertype == 1 ? 'checked' : '' }}>
                        <input type="radio" name="usertype" value="0" id="option-2"
                            {{ $user->usertype == 0 ? 'checked' : '' }}>
                        <label for="option-1" class="option option-1">
                            <div class="dot"></div>
                            <span>Admin</span>
                        </label>
                        <label for="option-2" class="option option-2">
                            <div class="dot"></div>
                            <span>User</span>
                        </label>
                    </div>
                </center>

                <br>

                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Name</span>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <br>

                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Email</span>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <br>

               <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Verify Email Address Date & Time</span>
                    <input type="text" name="email_verified_at" value="{{ $user->email_verified_at }}" class="form-control"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                </div>
                <center>
                    <p>Date Format Must Be<mark>YYYY-MM-DD HH:MM:SS</mark></p>
                </center>
                <br>

                <center>
                    <button type="submit" class="btn btn-primary btn-lg" name="submit">UPDATE USER DETAILS</button>
                </center>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT END -->

    <!-- FOOTER START -->

    @include('admin.footer')

    <!-- FOOTER END -->

    <!-- JS START -->

    @include('admin.js')

    <!-- JS END -->
