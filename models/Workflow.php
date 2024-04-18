<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Workflow extends Model
{
    use HasFactory;

    public $table = 'workflows';

    protected $fillable = [
        'service_id',
        'workflow_step_id',
        'role_id',
        'is_rejectable',
        'sort_id',
        'reject_workflow_step_id'
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function service() {
        return $this->belongsTo(Service::class,'service_id');
    }
    public function workflowStep() {
        return $this->belongsTo(WorkflowStep::class,'workflow_step_id');
    }
    public function rejectWorkflowStep() {
        return $this->belongsTo(WorkflowStep::class,'reject_workflow_step_id');
    }
}
