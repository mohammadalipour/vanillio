<?php

namespace App\Presentation\Web;

use App\Presentation\PresentationInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

final class Twig implements PresentationInterface
{
    private const TEMPLATE_PATH = __DIR__ . '/../../../templates';
    private const CACHE_PATH = __DIR__ . '/../../../cache';

    public function __construct(private readonly string $templatePath)
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function render(array $context = []): void
    {
        $loader = new FilesystemLoader(self::TEMPLATE_PATH);
        $twig = new Environment($loader, ['cache' => self::CACHE_PATH]);

        echo $twig->render($this->templatePath, $context);

        return;
    }
}