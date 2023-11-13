<?php

namespace App\Story;

use App\Factory\ClientFactory;
use Zenstruck\Foundry\Story;

final class DefaultClientStory extends Story
{
    public function build(): void
    {
        ClientFactory::createMany(10);
    }
}
