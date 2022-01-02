<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class UserRole extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_roles_rel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];

    protected static $logAttributes = ['user_id', 'role_id'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    /**
     * Disable timestamps.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * Default Role ID is app user
     *
     * @var integer
     */
    const DEFAULT_ROLE = 1;
    
    /**
     * Role ID of owner of bussiness
     *
     * @var integer
     */
    const BUSSINESS_OWNER_ROLE = 4;

    static function getValidationRules() 
    {
        return [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
