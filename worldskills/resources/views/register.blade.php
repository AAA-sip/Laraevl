


@extends('template.template')

@section('Ttitle', 'Register')


@section('TblockA')
    <div class="container formfor">
        <main class="form-signin w-100 m-auto">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h1 class="h3 mb-3 fw-normal">Register</h1>

                <div class="form-floating">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">


                </div>
                <div class="form-floating">
                    <label class="mt-3" for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">

                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">Register</button>
                <a class="btn-svoi w-100 btn mt-3 btn-lg" href="{{ route('dashboard') }}">Back</a>
            </form>
        </main>
    </div>
@endsection
