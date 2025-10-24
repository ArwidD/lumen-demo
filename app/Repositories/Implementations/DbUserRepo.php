<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepo;

class DbUserRepo implements UserRepo {
    /**
     * @inheritDoc
     */
    public function all(): array {
        return User::all()->All();
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): ?User {
        return User::findOrFail($id);    
    }

    /**
     * @inheritDoc
     */
    public function add(User $User): void {
        $User->save();
    }

    /**
     * @inheritDoc
     */
    public function update(User $User): void {
        $User->update();
    }

    public function delete(string $id): void {
        User::destory($id);
    }

    public function getUserByEmail(string $email): ?User {
        return User::query()->where('epost', $email)->firstOrFail();
    }
}