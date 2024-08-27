<?php

namespace App\View\Components\Main\Github;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Listing extends Component
{
    public string $title;
    public string $description;
    public string $link;
    public string $language;
    public int $stars;
    public int $forks;
    public int $issues;
    public int $watchers;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, ?string $description, string $link, ?string $language, int $stars, int $forks, int $issues, int $watchers)
    {
        $this->title = $title;
        $this->description = $description ?? 'No description';
        $this->link = $link;
        $this->language = $language ?? '';
        $this->stars = $stars ?? 0;
        $this->forks = $forks ?? 0;
        $this->issues = $issues ?? 0;
        $this->watchers = $watchers ?? 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.github.listing');
    }
}
