<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowLog extends Model
{
    use HasFactory;

    public $table = 'workflow_logs';

    protected $fillable = [
        'transaction_id',
        'service_id',
        'workflow_id',
        'user_id',
        'role_id',
        'status',
        'claimed_time',
        'approved_time'
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
