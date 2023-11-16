<?php

namespace App\Factory;

use App\Entity\UserSubscription;
use App\Repository\UserSubscriptionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<UserSubscription>
 *
 * @method        UserSubscription|Proxy                     create(array|callable $attributes = [])
 * @method static UserSubscription|Proxy                     createOne(array $attributes = [])
 * @method static UserSubscription|Proxy                     find(object|array|mixed $criteria)
 * @method static UserSubscription|Proxy                     findOrCreate(array $attributes)
 * @method static UserSubscription|Proxy                     first(string $sortedField = 'id')
 * @method static UserSubscription|Proxy                     last(string $sortedField = 'id')
 * @method static UserSubscription|Proxy                     random(array $attributes = [])
 * @method static UserSubscription|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UserSubscriptionRepository|RepositoryProxy repository()
 * @method static UserSubscription[]|Proxy[]                 all()
 * @method static UserSubscription[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static UserSubscription[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static UserSubscription[]|Proxy[]                 findBy(array $attributes)
 * @method static UserSubscription[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static UserSubscription[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UserSubscriptionFactory extends ModelFactory
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
            'expirationDate' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'status' => self::faker()->randomElement(['active', 'expired', 'disabled']),
            'trialActive' => self::faker()->boolean(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(UserSubscription $userSubscription): void {})
        ;
    }

    protected static function getClass(): string
    {
        return UserSubscription::class;
    }
}
