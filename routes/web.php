<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'test';
});

//Permissions
Route::resource('permissions', PermissionController::class);
Route::get('permissions/{id}/delete', [PermissionController::class,'destroy']);

//Roles
Route::resource('roles', RoleController::class);
Route::get('roles/{id}/delete',[RoleController::class,'destroy']);
Route::get('roles/{id}/give-permissions', [RoleController::class,'addPermissionToRole']);
Route::put('roles/{id}/give-permissions', [RoleController::class,'givePermissionToRole']);

//AssignRolesToUsers
Route::resource('assign', AssignRoleToUserController::class);

//Services
Route::resource('services', ServiceController::class);

//workflowSteps
Route::resource('workflowSteps',WorkflowStepController::class);

//workflow
Route::resource('workflow', WorkflowController::class);

//toClaimMyTask
Route::get('claim-task',[ToClaimMyTaskController::class,'claim_task']);
Route::post('claim/{id}',[ToClaimMyTaskController::class,'claim']);
Route::post('release/{id}',[ToClaimMyTaskController::class,'release']);
Route::post('approve/{id}',[ToClaimMyTaskController::class,'approve']);
Route::post('reject/{id}',[ToClaimMyTaskController::class,'reject']);
