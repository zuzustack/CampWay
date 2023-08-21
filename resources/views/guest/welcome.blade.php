@extends('template.dashboard')

@section('content')
  {{-- Hero Landing Page --}}
  <section class="mb-5">
    <div class="hero">
      <div class="hero-img"></div>
      <div class="hero-label d-flex jjc pic">
        <div class="text-center">
          <h4>Cari Perguruan Tinggi Negeri dengan Mudah</h4>
          <h4 class="mb-4">Lewat Semua Jalur Indonesia!</h4>
          <a class="btn btn-violet" href="/calc">Eksplorasi</a>
        </div>
      </div>
    </div>
  </section>
  {{-- Hero Landing Page --}}


  {{-- Article & Books --}}
  <section class="mb-4">
    <h1 class="text-center mb-5">Artikel & Buku</h1>
    <div class="mx-5 d-flex">
      {{-- Article --}}
      <div class="col-6">
        @for ($i = 0; $i < 4; $i++)
          <a class="text-dark text-decoration-none" href="lah{{ $i }}">
            <div class="card mb-3 no-border">
              <div class="card-body p-0 d-flex">
                <img src="/assets/img/background_1.jpg" width="150px" alt="...">
                <div class="px-3 py-4">
                  <h5 class="card-title">Lorem ipsum dolor.</h5>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
              </div>
            </div>
          </a>
        @endfor
      </div>
      {{-- End Article --}}
      {{-- Books --}}
      <div class="col-6 d-flex flex-wrap">
        @for ($i = 0; $i < 6; $i++)
          <a class="text-dark text-decoration-none book-cover" href="lah">
            <div class="card mb-3 no-border">
              <div class="card-body p-0">
                <img src="/assets/img/background_1.jpg" width="150px" alt="...">
                <div>
                  <h5 class="card-title">Lorem ipsum dolor.</h5>
                </div>
              </div>
            </div>
          </a>
        @endfor
      </div>
      {{-- End Books --}}
    </div>
  </section>
  {{-- End Article & Books --}}
@endsection
