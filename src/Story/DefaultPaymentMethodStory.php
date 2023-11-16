<?php

namespace App\Story;

use App\Factory\PaymentMethodFactory;
use Zenstruck\Foundry\Story;

final class DefaultPaymentMethodStory extends Story
{
    public function build(): void
    {
       PaymentMethodFactory::createMany(5);
    }
}
