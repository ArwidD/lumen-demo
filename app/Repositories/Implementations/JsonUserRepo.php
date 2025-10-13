<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepo;
use App\Storage\JsonDbConnection;
use App\Storage\JsonFileHandler;

class JsonUserRepo implements UserRepo {
    private array $data;
    private JsonFileHandler $file;

    public function __construct(JsonDbConnection $dbConnection) {
        $this->data = [];
        $this->file = new JsonFileHandler('users', $dbConnection);
        $data = $this->file->read();
        foreach ($data as $item) {
            $this->data[$item['id']] = new User($item);
        }
    }

    /**
     * @inheritDoc
     */
    public function all():array {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function get(string $id):?User {
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    /**
     * @inheritDoc
     */
    public function add(User $user):void {
        if ($user->id === 0) {
            $ids = array_keys($this->data);
            $nextId = empty($ids) ? 1 : max($ids) + 1;
            $user->id = $nextId;
            if ($user->id === 1) {
                $user->admin = 1;
            }
        }
        $this->data[$user->id] = $user;
        $this->file->write($this->data);
    }

    /**
     * @inheritDoc
     */
    public function update(User $user):void {
        $this->add($user);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id):void {
        unset ($this->data[$id]);
        $this->file->write($this->data);
    }

    public function getUserByEmail(string $email):?User {
        foreach ($this->data as $user) {
            if (strtolower($user->epost) === strtolower($email)) {
                return $user;
            }
        }
        return null;
    }
}