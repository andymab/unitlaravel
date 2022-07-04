<?php

namespace Tests\Unit\Http\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Property;
use Tests\TestCase;
use Illuminate\Support\Str;

class PropertyRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.properties.';

    /**  
     * @test  
     * @throws \Throwable  
     */
    public function type_is_required()
    {
        //   $this->withoutExceptionHandling(); //это убирает проверку на авторизацию

        $validatedField = 'type';
        $brokenRule = null;


        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField); //сразу говорим об ошибке если нами валидация не включена будет ошибка теста

        // Update assertion
        $existingProperty = Property::factory()->create();
        $newProperty = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $newProperty->toArray()
        )->assertJsonValidationErrors($validatedField);
    }


    /**  
     * @test  
     */
    public function type_must_not_exceed_20_characters()
    {

        $validatedField = 'type';
        $brokenRule = Str::random(21);

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);  //сразу говорим об ошибке
    }

    /**  
     * @test  
     * @throws \Throwable  
     */
    public function price_is_required()
    {
        $validatedField = 'price';
        $brokenRule = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);
        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    public function price_must_be_an_integer()
    {
        $validatedField = 'price';
        $brokenRule = 'not-integer';

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
