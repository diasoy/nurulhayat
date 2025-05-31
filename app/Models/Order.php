<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'status_order',
        'pesanan_tambahan',
        'keterangan_masak',
        'supplier_id',
        'dapur_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function dapur()
    {
        return $this->belongsTo(User::class, 'dapur_id');
    }
}
