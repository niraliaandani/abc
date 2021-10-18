<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
    * @var  string
    */
    protected $table = 'users';

    /**
    * @var  string[]
    */
    protected $fillable = [
        'username',
        'password',
        'email',
        'name',
        'is_active',
        'created_at',
        'updated_at',
        'added_by',
        'updated_by',
        'login_reactive_time',
        'login_retry_limit',
        'reset_password_expire_time',
        'reset_password_code',
        'email_verified_at',
        'user_type'
    ];

    /**
    * @var  string[]
    */
    protected $hidden = [
        'password',
    ];

    /**
    * @var  string[]
    */
    protected $casts = [
        'username' => 'string',
        'password' => 'string',
        'email' => 'string',
        'name' => 'string',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'added_by' => 'unsignedbigint',
        'updated_by' => 'unsignedbigint',
        'login_reactive_time' => 'datetime',
        'login_retry_limit' => 'integer',
        'reset_password_expire_time' => 'datetime',
        'reset_password_code' => 'string',
        'email_verified_at' => 'datetime',
        'user_type' => 'integer'
    ];

    const DEFAULT_ROLE = 'System User';

    const TYPE_USER = 1;
    const TYPE_ADMIN = 2;

    const USER_TYPE = [
        self::TYPE_USER => 'User',
        self::TYPE_ADMIN => 'Admin'
    ];

    const PLATFORM = [
        'ADMIN' => 1,
        'DEVICE' => 2,
    ];

    const USER_ROLE = [
        'USER' => 1,
        'ADMIN' => 2,
    ];

    const MAX_LOGIN_RETRY_LIMIT = 3;
    const LOGIN_REACTIVE_TIME = 20;

    const FORGOT_PASSWORD_WITH = [
        'link'        => [
            'email' => 'true',
            'sms'   => 'false',
        ],
        'expire_time' => '20',
    ];
    
    const LOGIN_ACCESS = [
        'User' => [self::PLATFORM['DEVICE'],],
        'Admin' => [self::PLATFORM['ADMIN'],],
    ];
}
