<?php

namespace App\Factory;

use App\Entity\WorkingHours;
use App\Repository\WorkingHoursRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<WorkingHours>
 *
 * @method        WorkingHours|Proxy                     create(array|callable $attributes = [])
 * @method static WorkingHours|Proxy                     createOne(array $attributes = [])
 * @method static WorkingHours|Proxy                     find(object|array|mixed $criteria)
 * @method static WorkingHours|Proxy                     findOrCreate(array $attributes)
 * @method static WorkingHours|Proxy                     first(string $sortedField = 'id')
 * @method static WorkingHours|Proxy                     last(string $sortedField = 'id')
 * @method static WorkingHours|Proxy                     random(array $attributes = [])
 * @method static WorkingHours|Proxy                     randomOrCreate(array $attributes = [])
 * @method static WorkingHoursRepository|RepositoryProxy repository()
 * @method static WorkingHours[]|Proxy[]                 all()
 * @method static WorkingHours[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static WorkingHours[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static WorkingHours[]|Proxy[]                 findBy(array $attributes)
 * @method static WorkingHours[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static WorkingHours[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class WorkingHoursFactory extends ModelFactory
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(WorkingHours $workingHours): void {})
        ;
    }

    protected static function getClass(): string
    {
        return WorkingHours::class;
    }
}
