<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-main.header />
    <section class="hero is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-narrow is-third">
                        <img src="{{ $profile['avatar_url'] }}" alt="Profile Picture" style="width: 100%; height: auto;">
                    </div>
                    <div class="column is-quarter">
                        <div class="content">
                            {!! $profile['readme'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hero is-dark is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h2 class="title is-2">Portfolio</h2>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="content">
                {!! $profile['portfolio'] !!}
            </div>
        </div>
    </section>
    <section class="hero is-dark is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h2 class="title is-2">Repositories</h2>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                @if (isset($repositories))
                @foreach ($repositories as $repository)
                <div class="column is-one-third">
                    <x-main.github.listing :title="$repository['name']" :description="$repository['description']" :link="$repository['url']" :stars="$repository['stars']" :forks="$repository['forks']" :issues="$repository['issues']" :watchers="$repository['watchers']" :language="$repository['language']" />
                </div>
                @endforeach
                @else
                <div class="column is-full">
                    <div class="notification is-warning is-dark">
                        No repositories found.
                    </div>
                    @endif
                </div>
            </div>
    </section>
    <x-main.footer />
</body>

</html>