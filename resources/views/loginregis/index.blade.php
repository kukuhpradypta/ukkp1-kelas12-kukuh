<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" />
    <title>MyJourney</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="/login" method="post">

                <h1 class="mb-4">Log In</h1>
                @if (session()->has('registerSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('registerSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('registerError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('registerError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf


                <input id="emaillogin" type="email" class="@error('email') is-invalid @enderror" name="email"
                    placeholder="Email" required value="{{ old('email') }}" />
                @error('email')
                    <div class="invalid-feedback"></div>
                @enderror
                <input type="password" class="@error('password') is-invalid @enderror" name="password"
                    placeholder="Password" required value="{{ old('email') }}" />
                @error('password')
                    <div class="invalid-feedback"></div>
                @enderror
                <button class="mt-4" type="submit">Log In</button>

            </form>
        </div>

        <div class="form-container sign-up-container">
            <form action="/regis" method="post">
                <h1 class="mb-4">Register</h1>
                @if (session()->has('registerError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('registerError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('registerSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('registerSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                <input type="text" name="name" class="@error('name') is-invalid @enderror" placeholder="Name" autofocus
                    required value="{{ old('name') }}" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="text" class="@error('nik') is-invalid @enderror" name="nik" placeholder="nik" required
                    value="{{ old('nik') }}" />
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="email" class="@error('email') is-invalid @enderror" name="email" placeholder="Email"
                    required value="{{ old('email') }}" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="password" class="@error('password') is-invalid @enderror" name="password"
                    placeholder="Password" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button class="mt-4" type="submit">Register</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Log In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Register</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
