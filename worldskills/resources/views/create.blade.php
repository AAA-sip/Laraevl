
@extends('template.template')
@section('Ttitle', 'Create Content')
@section('TblockA')

    <div class="container">
        <a class="btn-svoi" href="{{ route('dashboard') }}">Back</a>
        <h1 class="mt-4">Create Page</h1>
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required>
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <div>
                    <label for="picture">Picture</label>
                    <input type="file" name="picture" id="picture">
                </div>

                <div>
                    <label for="game_html">Game File</label>
                    <input id="game_html" type="file" name="game_html" >
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div>
                    <button type="submit">Create Content</button>
                </div>
            </form>
    </div>
@endsection

