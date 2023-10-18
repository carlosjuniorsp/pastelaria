<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use SoftDeletes;
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'complement',
        'district',
        'zip_code',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class, 'client_id', 'id');
    }
}
