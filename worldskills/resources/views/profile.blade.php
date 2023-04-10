@extends('template.template')

@section('Ttitle','Profile')

@section('TblockA')
    <div class="container">
        <a class="btn-svoi" href="{{ route('dashboard') }}">Back</a>
        <a class="btn" href="{{ route('content') }}">Creat</a>

        <h1 class="mt-4">{{ $user->name }} Profile</h1>
        <p class="mt-4">Created at: {{ $user->created_at->format('F jS, Y') }}</p>

        <p>Last login at: {{ $user->last_login_at->format('F j, Y, g:i a') }}</p>


        @if(count($contents) > 0)
            <h5>you contents:</h5>
            <ul>
                @foreach($contents as $content)
                    <li><a href="{{ route('show', $content->id) }}">{{ $content->title }}</a></li>
                @endforeach
            </ul>
        @else
            <p>you havent content</p>
        @endif

    </div>
@endsection

