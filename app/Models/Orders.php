<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;
    protected $table = 'Order';

    protected $fillable = [
        'client_id',
        'product_id',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'product_id' => 'array'
    ];

    /**
     * Relationship to client model
     */
    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id');
    }
}
