<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'status_order',
        'pemesan_nama',
        'pemesan_alamat',
        'pemesan_handphone',
        'pemesan_email',
        'aqiqoh_nama',
        'aqiqoh_binbinti',
        'aqiqoh_tempat_lahir',
        'aqiqoh_tanggal_lahir',
        'aqiqoh_jenis_kelamin',
        'pelaksanaan_hari',
        'pelaksanaan_tanggal',
        'pelaksanaan_jam',
        'pelaksanaan_alamat',
        'type_aqiqah',
        'animal_gender',
        'menu_option',
        'quantity',
        'jumlah_kotakan',
        'total_harga',
        'order_id',
        'jam_matang',
        'midtrans_transaction_status',
        'status_order',
        'midtrans_payment_type',
        'midtrans_raw',
        'pesanan_tambahan',
        'keterangan_masak',
        'supplier_id',
        'dapur_id',
        'jam_matang'
    ];

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function dapur()
    {
        return $this->belongsTo(User::class, 'dapur_id');
    }

    protected $casts = [
        'jam_matang' => 'datetime',
        'pelaksanaan_tanggal' => 'date',
    ];


}
