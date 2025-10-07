<?php

namespace Database\Factories;

use App\Models\Uppgift;
use Illuminate\Database\Eloquent\Factories\Factory;

class UppgiftFactory extends Factory {
    protected $model=Uppgift::class;
    /**
     * @inheritDoc
     */
    public function definition() {
        return [
            'id'=>0,
            'text'=>$this->faker->sentence(3),
            'done'=>false
        ];
    }
}