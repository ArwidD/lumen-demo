<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
       'id', 'namn', 'epost','losenord', 'admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function setLosenordAttribute($value) {
        // Hasha lösenordet om det behövs
        if(!empty($value) && Hash::needsRehash($value)) {
            $this->attributes['losenord']=Hash::make($value);
        } else {
            $this->attributes['losenord']=$value;
        }
    }

    public function fill(array $attributes) {
        // Om lösenord finns i attributen men är tomt -> ta bort attributet
        if(array_key_exists('losenord', $attributes) && empty($attributes['losenord'])) {
            unset($attributes['losenord']);
        }

        return parent::fill($attributes);
    }
}