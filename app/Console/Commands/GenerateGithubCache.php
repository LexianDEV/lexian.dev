<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Github\Client;
use cebe\markdown\GithubMarkdown;

class GenerateGithubCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Github cache.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();
        $parser = new GithubMarkdown();

        $repositories = $client->api('user')->repositories(config('app.github_username'));
        $repositories = array_map(function ($repository) {
            return [
                'name' => $repository['name'],
                'url' => $repository['html_url'],
                'description' => $repository['description'],
                'stars' => $repository['stargazers_count'],
                'forks' => $repository['forks_count'],
                'watchers' => $repository['watchers_count'],
                'issues' => $repository['open_issues_count'],
                'is_fork' => $repository['fork'],
                'language' => $repository['language'],
                'archived' => $repository['archived'],
            ];
        }, $repositories);

        // Get the profile
        $profile = $client->api('user')->show(config('app.github_username'));

        // Get the README of the profile / organization
        if($client->api('repo')->contents()->exists(config('app.github_username'), config('app.github_username'), 'README.md')) {
            $readme = $client->api('repo')->contents()->show(config('app.github_username'), config('app.github_username'), 'README.md');
            $readme = base64_decode($readme['content']);
            $readme = $parser->parse($readme);
        } elseif($client->api('repo')->contents()->exists(config('app.github_username'), '.github', 'profile/README.md')) {
            $readme = $client->api('repo')->contents()->show(config('app.github_username'), '.github', 'profile/README.md');
            $readme = base64_decode($readme['content']);
            $readme = $parser->parse($readme);
        } else {
            $readme = $profile['bio'];
        }

        $profile['readme'] = $readme;

        // Get the .portfolio README.md
        if($client->api('repo')->contents()->exists(config('app.github_username'), '.portfolio', 'README.md')) {
            $readme = $client->api('repo')->contents()->show(config('app.github_username'), '.portfolio', 'README.md');
            $readme = base64_decode($readme['content']);
            $readme = $parser->parse($readme);
        } else {
            $readme = "The repository \".portfolio/README.md\" does not exist or could not be found. (Is it private?)";
        }

        $profile['portfolio'] = $readme;

        // Removes the forked repositories
        if(config('app.filter_forks')) {
            $repositories = array_filter($repositories, function ($repository) {
                return !$repository['is_fork'];
            });
        }

        // Removes the repositories that start with a dot
        if(config('app.filter_dot_repos')) {
            $repositories = array_filter($repositories, function ($repository) {
                return strpos($repository['name'], '.') !== 0;
            });
        }

        // Removes the archived repositories
        if(config('app.filter_archived')) {
            $repositories = array_filter($repositories, function ($repository) {
                return !$repository['archived'];
            });
        }

        // Sort the repositories by stars
        usort($repositories, function ($a, $b) {
            return $b['stars'] <=> $a['stars'];
        });

        // Cache the data
        cache()->forever('github', $repositories);
        cache()->forever('github_profile', $profile);

        $this->info('Github cache generated successfully.');
    }
}
