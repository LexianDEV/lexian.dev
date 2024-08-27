<div class="box">
    <h2 class="title is-4 mb-2">{{ $title }}</h2>
    <p class="mb-2">{{ $description}}</p>
    <p class="mb-2">&#127775; {{ $stars }} | &#127860; {{ $forks }} | &#128064; {{ $watchers }}</p>
    @if ($language !== '')
        <p class="tag is-link mb-2">{{ $language }}</p>
    @endif
    <a href="{{ $link }}" class="button is-dark is-fullwidth" target="_blank">Repository</a>
</div>