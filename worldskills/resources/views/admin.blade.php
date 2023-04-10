
@extends('template.template')

@section('Ttitle','Admin')

@section('TblockA')
    <div class="container">
        <a class="btn-svoi" href="{{ route('dashboard') }}">Back</a>

        @if(session('success'))
            <div class="container">
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            </div>
        @endif



        <h1 class="mt-4">Hello {{ $user->name }}!</h1>

            <table class="table" >
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Admin?</th>
                    <th>Is Banned?</th>
                    <th>Created at</th>
                    <th>Last login at</th>
                    <th>Content</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->admin ? 'Yes' : 'No' }}</td>
                        <td>
                            @if ($user->is_banned)
                                <form action="{{ route('user-ban', $user) }}" method="post">
                                    @csrf
                                    <button type="submit">Unban</button>
                                </form>
                            @else
                                <form action="{{ route('user-ban', $user) }}" method="post">
                                    @csrf
                                    <button type="submit">Ban</button>
                                </form>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->last_login_at }}</td>
                        <td>
                            @if ($user->contents->count() > 0)
                                <ul>
                                    @foreach ($user->contents as $content)
                                        <li><a href="{{ route('show', $content->id) }}">{{ $content->title }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                No content found.
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection
