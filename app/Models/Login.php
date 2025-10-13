<?php

namespace App\Models;

class Login {
    private string $epost;
    private string $losenord;

    public static function create(array $attributes):self {
        return new self($attributes);
    }

    private function __construct(array $attributes) {
        $this->epost=$attributes['epost'];
        $this->losenord=$attributes['losenord'];
    }

    public function getLosenord():string {
        return $this->losenord;
    }
    public function getEpost(): string{
        return $this->epost;
    }
}