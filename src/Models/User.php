<?php

namespace kd\kdladmin\models;

use Illuminate\Database\Eloquent\Model;
use Kd\Kdladmin\Components\Configs;

/**
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class User extends Model
{
    protected $primaryKey = 'id';
    public $sequence = 'kd_users_id_seq';

    protected $fillable = [
        'id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at','status'
    ];

    public function getDateFormat() {
        return 'U';
    }
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct($config = []) {
        parent::__construct($config);
        $this->setTable(Configs::$userTable);
    }

    public function search($params)
    {
        return User::all();
    }
}
