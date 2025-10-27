<?php

namespace App\Repositories\Implementations;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;

class DbUppgiftRepo implements UppgiftRepo {
    /**
     * @inheritDoc
     */
    public function all(): array {
        return Uppgift::all()->toArray();
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): ?Uppgift {
        return Uppgift::findOrFail($id);    
    }

    /**
     * @inheritDoc
     */
    public function add(Uppgift $uppgift): void {
        $uppgift->save();
    }

    /**
     * @inheritDoc
     */
    public function update(Uppgift $uppgift): void {
        $uppgift->update();
    }

    public function delete(string $id): void {
        Uppgift::destroy($id);
    }
}