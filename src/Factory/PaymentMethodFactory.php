<?php

namespace App\Factory;

use App\Entity\PaymentMethod;
use App\Repository\PaymentMethodRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<PaymentMethod>
 *
 * @method        PaymentMethod|Proxy                     create(array|callable $attributes = [])
 * @method static PaymentMethod|Proxy                     createOne(array $attributes = [])
 * @method static PaymentMethod|Proxy                     find(object|array|mixed $criteria)
 * @method static PaymentMethod|Proxy                     findOrCreate(array $attributes)
 * @method static PaymentMethod|Proxy                     first(string $sortedField = 'id')
 * @method static PaymentMethod|Proxy                     last(string $sortedField = 'id')
 * @method static PaymentMethod|Proxy                     random(array $attributes = [])
 * @method static PaymentMethod|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PaymentMethodRepository|RepositoryProxy repository()
 * @method static PaymentMethod[]|Proxy[]                 all()
 * @method static PaymentMethod[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static PaymentMethod[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static PaymentMethod[]|Proxy[]                 findBy(array $attributes)
 * @method static PaymentMethod[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static PaymentMethod[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PaymentMethodFactory extends ModelFactory
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
            'name' => self::faker()->creditCardType()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(PaymentMethod $paymentMethod): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PaymentMethod::class;
    }
}
