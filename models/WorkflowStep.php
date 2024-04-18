<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class WorkflowStep extends Model
{
    use HasFactory;

    public $table = 'workflow_steps';

    protected $fillable = [
        'name',
        'role_id'
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
