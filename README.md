# Unittest
### Основные сущности
- php artisan make:test Api/PropertiesTest  - создание теста
    пример:
  
        // Build a non-persisted Property factory model.
        $newProperty = Property::factory()->make(); создаем модель

        $response = $this->postJson(
            route('api.properties.store'),
            $newProperty->toArray()
        ); отправляем на запись

        $response->assertCreated(); //Подтвердите, что ответ имеет код состояния HTTP 201:
        $response->assertJson([ //метод можно использовать для подтверждения того, что в ответе JSON существует фрагмент JSON
            'data' => ['type' => $newProperty->type]
        ]);
        // подтвердить, что в базе данных существуют данные, соответствующие заданному набору критериев
        $this->assertDatabaseHas( 
            'properties',
            $newProperty->toArray()
        );
  

- php ./vendor/bin/phpunit --testdox - запуск тестов
- php artisan make:request PropertyRequest  создание FormRequest  для валидации запросов
пример: 
 
        $validatedField = 'type';  
        $brokenRule = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule  // заведомо делаем ошибку
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField); //сразу говорим об ошибке если нами валидация не включена будет ошибка теста


- php artisan make:test Http/Requests/PropertyRequestTest --unit   для проверки работы запросов
### Дополнительные понятия
- php artisan make:controller Api/PropertyController  создание Api контроллер в APP\HTTP\Controllers\Api\
- php artisan make:model Property -mf  создание модели и фабрики

