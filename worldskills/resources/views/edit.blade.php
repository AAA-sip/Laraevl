@extends('template.template')

@section('Ttitle','edit')

@section('TblockA')
    <div class="container">
        <a class="btn-svoi mr-1 mb-2" href="{{ route('dashboard') }}">Back</a>

        <form class="mt-3" method="POST" action="{{ route('update', $content->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $content->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $content->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" name="picture" id="picture" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="game_html">Game HTML:</label>
                <input type="file" name="game_html" id="game_html" class="form-control-file">
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

            <button type="submit" class="btn btn-primary">Update</button>


        </form>
    </div>
@endsection
