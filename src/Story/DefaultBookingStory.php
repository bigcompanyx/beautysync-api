<?php

namespace App\Story;

use App\Factory\BookingFactory;
use App\Tests\Api\BookingTest;
use Zenstruck\Foundry\Story;

final class DefaultBookingStory extends Story
{
    public function build(): void
    {
        BookingFactory::new()->createMany(10);
    }
}
