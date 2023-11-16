<?php

namespace App\DataFixtures;

use App\Story\DefaultBookingStory;
use App\Story\DefaultClientStory;
use App\Story\DefaultCompanyStory;
use App\Story\DefaultCurrencyStory;
use App\Story\DefaultLanguageStory;
use App\Story\DefaultPaymentMethodStory;
use App\Story\DefaultServiceStory;
use App\Story\DefaultSubscriptionPlanStory;
use App\Story\DefaultUsersStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultUsersStory::load();
        DefaultBookingStory::load();
        DefaultClientStory::load();
        DefaultCompanyStory::load();
        DefaultCurrencyStory::load();
        DefaultLanguageStory::load();
        DefaultPaymentMethodStory::load();
        DefaultServiceStory::load();   
        DefaultSubscriptionPlanStory::load(); 
    }
}
