<?php

namespace App\Story;

use App\Factory\LanguageFactory;
use Zenstruck\Foundry\Story;

final class DefaultLanguageStory extends Story
{
    public function build(): void
    {
        LanguageFactory::createMany(10);
    }
}
