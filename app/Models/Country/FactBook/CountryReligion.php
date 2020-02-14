<?php

namespace App\Models\Country\FactBook;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country\FactBook\CountryReligions
 *
 * @OA\Schema (
 *     type="object",
 *     description="CountryReligion",
 *     title="CountryReligion",
 *     @OA\Xml(name="CountryReligion")
 * )
 *
 * @mixin \Eloquent
 */
class CountryReligion extends Model
{
    protected $connection = 'dbp';
    public $incrementing = false;
    public $table = 'country_religions';

    /**
     *
     * @OA\Property(ref="#/components/schemas/Country/properties/id")
     * @method static CountryReligion whereCountryId($value)
     * @property string $country_id
    */
    protected $country_id;
    /**
     *
     * @OA\Property(
     *     title="name",
     *     description="The name of the religion that makes up part of the countries populace",
     *     type="string"
     * )
     *
     * @method static CountryReligion whereName($value)
     * @property string $name
    */
    protected $name;
    /**
     *
     * @OA\Property(
     *     title="population_percentage",
     *     description="The percentage of the countries populace that adhere to the religion being described",
     *     type="string"
     * )
     *
     * @method static CountryReligion wherePopulationPercentage($value)
     * @property float $population_percentage
    */
    protected $population_percentage;
    /**
     *
     * @OA\Property(
     *     title="date",
     *     description="The date that this data was recorded",
     *     type="string"
     * )
     *
     * @method static CountryReligion whereDate($value)
     * @property int $date
    */
    protected $date;
}
