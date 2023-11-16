<?php

namespace App\Story;

use App\Factory\SubscriptionPlanFactory;
use Zenstruck\Foundry\Story;

final class DefaultSubscriptionPlanStory extends Story
{
    public function build(): void
    {
        SubscriptionPlanFactory::createMany(3);
    }
}
