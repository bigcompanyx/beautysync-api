<?php

namespace App\Story;

use App\Factory\ServiceFactory;
use Zenstruck\Foundry\Story;

final class DefaultServiceStory extends Story
{
    public function build(): void
    {
        ServiceFactory::createMany(10);
    }
}
