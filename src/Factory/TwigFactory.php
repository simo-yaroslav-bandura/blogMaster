<?php

namespace SimoBanduraYaroslav\Blogmaster\Factory;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigFactory
{
    public function __invoke(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Calculator/Templates');
            return new Environment($loader, [
                'cache'       => false,
                'auto_reload' => true,
                'autoescape'  => 'html',
            ]);
    }
}