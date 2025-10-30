<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HighlightExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('highlight_query', [$this, 'highlightQuery'], ['is_safe' => ['html']]),
        ];
    }

    public function highlightQuery(string $text, string $query): string
    {
        if (empty($query)) {
            return $text;
        }

        $escapedQuery = preg_quote($query, '/');

        return preg_replace(
            "/($escapedQuery)/i", // insensible à la casse
            '<span class="bg-yellow-200 font-bold text-black rounded-sm">$1</span>',
            $text
        );
    }
}
