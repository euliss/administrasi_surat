<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>{{ $title }} | SIMA</title>
</head>

<body style="background-color: #4FCAE4">
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 w-50 text-center bg-white m-5 p-5 rounded-3"
                style="box-shadow: 20px 20px 30px rgba(0,0,0,0.5)">
                <img src="{{ asset('img/himmi.png') }}" alt="" class="w-25 mb-3">
                <h3>Sistem Informasi Manajemen Administrasi</h3>
                @if (session()->has('loginError'))
                    <div class="row">
                        <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @else
                    <div class="my-5"></div>
                @endif
                <form action="/" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-1 btn btn-primary">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="col-11">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-1 btn btn-primary">
                                <i class="bi bi-key"></i>
                            </div>
                            <div class="col-11">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-bottom: -1em">
                            <p>
                                <a
                                    href="https://wa.me/6281280776731?text=Assalamualaikum...%0AMohon%20maaf%20kak%20mengganggu%20waktunya%2C%20saya%20lupa%20password%20akun%20website%20SIMA.">Lupa
                                    Password ?</a>
                            </p>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                  <div class="row">
                     <div class="col-1 btn btn-primary">
                        <i class="bi bi-shield-lock"></i>
                     </div>
                     <div class="col-11">
                        <select class="form-select" aria-label="Default select example" >
                           <option selected>Hak Akses</option>
                           <option value="1">Sekretaris</option>
                           <option value="2">Pengurus</option>
                           <option value="3">Pembina</option>
                        </select>
                     </div>
                  </div>
               </div> --}}
                    <div class="row mt-0">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <!-- <a href="/home" class="btn btn-primary mt-3">Login</a> -->

                    </div>
                </form>

            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
