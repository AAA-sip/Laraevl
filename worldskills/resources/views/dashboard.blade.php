
@extends('template.template')

@section('Ttitle','Dashboard')

@section('TblockA')
    <div class="container">
        <form method="get" action="{{ route('search') }}" class="mb-3">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort">
                <option value="popularity" @if(request('sort') == 'popularity') selected @endif>Popularity</option>
                <option value="last_update" @if(request('sort') == 'last_update') selected @endif>Last Update</option>
                <option value="name" @if(request('sort') == 'name') selected @endif>Name</option>
            </select>
            <select name="direction" id="direction">
                <option value="desc" @if(request('direction') == 'desc') selected @endif>Descending</option>
                <option value="asc" @if(request('direction') == 'asc') selected @endif>Ascending</option>
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name...">
            <button type="submit">Filter</button>
        </form>

        <a class="mt-3" href="{{ route('dashboard') }}">Сброс</a>
    </div>

    @if(session('success'))
        <div class="container">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
@endsection

@section('TblockB')
        <div class="container mt-5">
            <ul id="content-container">


                    @foreach($contents as $content)

                        @if($content->is_hidden && auth()->user()->admin())

                            <li class="bg-body-tertiary p50 rounded flex" >
                                <div>
                                    <div class="d-flex align-items-end">
                                        <h2>{{ $content->title }}</h2><p class="ml-1 pp">Author: {{ $content->user->name }}</p>

                                    </div>
                                    <p class="lead">{{ $content->description }}</p>
                                    <a href="{{ route('show', $content->slug) }}">Play Game</a>
                                </div>

                                @if($content->picture)
                                    <img class="dash_img" src="{{ asset('uploads/' . $content->picture) }}" alt="{{ $content->title }}">
                                @else
                                    <img class="dash_img" src="{{asset('img/galz.jpg') }}" alt="none">
                                @endif
                            </li>

                            @elseif(!$content->is_hidden)
                                <!-- Content is not hidden and visible to all users -->
                                <li class="bg-body-tertiary p50 rounded flex">
                                    <div>
                                        <div class="d-flex align-items-end">
                                            <h2>{{ $content->title }}</h2><p class="ml-1 pp">Author: {{ $content->user->name }}</p>
                                        </div>
                                        <p class="lead">{{ $content->description }}</p>
                                        <a href="{{ route('show', $content->slug) }}">Play Game</a>
                                    </div>

                                    @if($content->picture)
                                        <img class="dash_img" src="{{ asset('uploads/' . $content->picture) }}" alt="{{ $content->title }}">
                                    @else
                                        <img class="dash_img" src="{{asset('img/galz.jpg') }}" alt="none">
                                    @endif
                                </li>
                            @endif

                    @endforeach

            </ul>

            @if($contents->isEmpty() && empty($search))
                <p>No results found for your search query</p>
            @endif
        </div>





@endsection
