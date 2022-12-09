<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel rastreio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center bg-secondary" style="height: 100vh">

    <div class="container">
        <form action="/auth" method="post" class="card" style="min-height: 400px">
            <div class="card-body d-flex flex-column justify-content-between p-5">
                <h1 class="display-4 text-center">Login</h1>
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="text" placeholder="E-mail" name="email">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Senha</label>
                    <input class="form-control" type="password" placeholder="Senha" name="password">
                </div>
                <button type="submit" class="btn btn-primary mt-5">Entrar</button>
    
                @if ($errors->any())
                    <div class="fieldsFail">
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li class="text-danger text-center">{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                @if (session('danger'))
                    <div class="authFail">
                        <h4 class="text-danger text-center">{{ session('danger') }}</h4>
                    </div>
                @endif
            </div>
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>