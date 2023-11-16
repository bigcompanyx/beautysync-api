<?php

namespace App\Factory;

use App\Entity\SubscriptionPlan;
use App\Repository\SubscriptionPlanRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SubscriptionPlan>
 *
 * @method        SubscriptionPlan|Proxy                     create(array|callable $attributes = [])
 * @method static SubscriptionPlan|Proxy                     createOne(array $attributes = [])
 * @method static SubscriptionPlan|Proxy                     find(object|array|mixed $criteria)
 * @method static SubscriptionPlan|Proxy                     findOrCreate(array $attributes)
 * @method static SubscriptionPlan|Proxy                     first(string $sortedField = 'id')
 * @method static SubscriptionPlan|Proxy                     last(string $sortedField = 'id')
 * @method static SubscriptionPlan|Proxy                     random(array $attributes = [])
 * @method static SubscriptionPlan|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SubscriptionPlanRepository|RepositoryProxy repository()
 * @method static SubscriptionPlan[]|Proxy[]                 all()
 * @method static SubscriptionPlan[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static SubscriptionPlan[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static SubscriptionPlan[]|Proxy[]                 findBy(array $attributes)
 * @method static SubscriptionPlan[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static SubscriptionPlan[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SubscriptionPlanFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'description' => self::faker()->text(),
            'duration' => self::faker()->randomNumber(2),
            'durationUnit' => self::faker()->randomElements(['day', 'month', 'year']),
            'name' => self::faker()->randomElements(['Start', 'Corporate', 'Premium']),
            'price' => self::faker()->randomNumber(2),
            'trialDuration' => self::faker()->randomElements(['day', 'month', 'year']),
            'trialDurationUnit' => self::faker()->randomElements(['day', 'month', 'year']),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SubscriptionPlan $subscriptionPlan): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SubscriptionPlan::class;
    }
}
