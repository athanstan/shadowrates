<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $socialLinks = [
            [
                'slug' => 'twitter',
                'name' => 'Twitter',
                'link' => 'https://twitter.com/',
                'logo' => 'fab fa-twitter',
            ],
            [
                'slug' => 'discord',
                'name' => 'Discord',
                'link' => 'https://discord.com/users/',
                'logo' => 'fab fa-discord',
            ],
            [
                'slug' => 'github',
                'name' => 'GitHub',
                'link' => 'https://github.com/',
                'logo' => 'fab fa-github',
            ],
            [
                'slug' => 'youtube',
                'name' => 'YouTube',
                'link' => 'https://youtube.com/@',
                'logo' => 'fab fa-youtube',
            ],
            [
                'slug' => 'twitch',
                'name' => 'Twitch',
                'link' => 'https://twitch.tv/',
                'logo' => 'fab fa-twitch',
            ],
            [
                'slug' => 'reddit',
                'name' => 'Reddit',
                'link' => 'https://reddit.com/user/',
                'logo' => 'fab fa-reddit',
            ],
            [
                'slug' => 'instagram',
                'name' => 'Instagram',
                'link' => 'https://instagram.com/',
                'logo' => 'fab fa-instagram',
            ],
            [
                'slug' => 'facebook',
                'name' => 'Facebook',
                'link' => 'https://facebook.com/',
                'logo' => 'fab fa-facebook',
            ],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }
    }
}
