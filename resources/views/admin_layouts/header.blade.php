<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="w-100" action="{{ route('admin.users.search') }}" method="post">
            @csrf
            <input class="form-control form-control-dark w-100" value="{{ request('name') }}" type="text" name="name"
                placeholder="Search" aria-label="Search">

        </form>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                @auth
                    <form action="/logout" class="nav-link px-3" method="post">
                        @csrf
                        <button class="btn btn-warning" type="submit"> Logout</button>
                    </form>
                @endauth

            </div>
        </div>

    </header>
