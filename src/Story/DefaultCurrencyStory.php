<?php

namespace App\Story;

use App\Factory\CurrencyFactory;
use Zenstruck\Foundry\Story;

final class DefaultCurrencyStory extends Story
{
    public function build(): void
    {
       CurrencyFactory::createMany(10);
    }
}
