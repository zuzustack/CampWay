@extends('template.auth')

@section('content')
    <div class="w-full filter-bg h-full bg-login bg-absolute">

    </div>

    <div class="row h-full">
        <div class="col-6"></div>
        <div class="col-5 pt-5 pe-5">
            <div class="card">
                <div class="card-body p-5">
                  <h1>Login</h1>
                  <small>Belum Punya Akun? <a href="{{ route('auth.signupView') }}" class="text-decoration-none">Buat Akun</a></small>

                  <form method="get" class="row mt-3">
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label m-0">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="inputPassword4" class="form-label m-0">Password</label>
                        <input type="password" class="form-control" id="inputPassword4">
                      </div>
                      <div class="col-md-12 mt-4 d-flex">
                        <button type="submit" class="ms-1 w-fit btn btn-outline-dark d-inline px-3">Login</button>
                      </div>
                  </form>
                </div>
              </div>
        </div>
    </div>
@endsection