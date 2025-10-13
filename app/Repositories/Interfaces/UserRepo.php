<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepo {
    /**
     * Returnerar alla användare
     * @return User[]
     */
    public function all():array;

    /**
     * Returnerar en användare baserat på id
     * @param string $id
     * @return User|null
     */
    public function get(string $id):?User;

    /**
     * Lägger till en användare till samlingen
     * @param User $user
     * @return void
     */
    public function add(User $user):void;

    /**
     * Uppdaterar en befintlig användare
     * @param User $user
     * @return void
     */
    public function update(User $user):void;

    /**
     * Raderar en användare ur listan
     * @param string $id
     * @return void
     */
    public function delete(string $id):void;

    /**
     * Returnerar en användare baserat på epost
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email):?User;
}