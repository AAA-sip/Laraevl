@extends('template.template')
@section('Ttitle', $content->title)
@section('TblockA')
    <div class="container">
        <div class="d-flex">
            <a class="btn-svoi mr-1" href="{{ route('dashboard') }}">Back</a>
            @if (Auth::check() && $content->user_id == Auth::user()->id)
                <a href="{{ route('edit', $content->id) }}" class="btn-svoi mr-1">Edit</a>
            @endif

            @if (Auth::check() && $content->user_id == Auth::user()->id)
                <form action="{{ route('destroy', $content->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn mr-1" type="submit">Delete</button>
                </form>
            @endif

            @if(auth()->user()->admin())
                <!-- User is admin, show "Hide/Unhide" button -->
                <form action="{{ route('hide', $content->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        @if($content->is_hidden)
                            Unhide
                        @else
                            Hide
                        @endif
                    </button>
                </form>
            @endif
        </div>

        @if(session('success'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif



        <div class="d-flex align-items-end mt-2">
            <h1>{{ $content->title }}</h1><p class="pp ml-1">
        </div>
        <div class="game">
            <iframe src="{{ asset('games/' .$content->game_html) }}"></iframe>


        </div>


        <div class="d-flex justify-content-between mt-3">
            <div class="w-500px">
                <h3>Top 10 liderboard</h3>

            </div>
            <div class="w-500px">
                <h3>Description</h3>
                <p>{{ $content->description }}</p>
            </div>


        </div>

    </div>
@endsection

