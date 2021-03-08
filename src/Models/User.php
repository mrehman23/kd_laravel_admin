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
    private $prefix;
    // protected $table = 'users1';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // const CREATED_AT = 'created_at';
    protected $fillable = [
        'id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at','status'
    ];

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
        // $tBLE=Configs::$userTable;
        // dd($tBLE);
        return User::all();
        // $model = User::where('id','!=','1');
        // $model->where(['1=2']);
        $return_data=$model->get();
        return $return_data;
    }



    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName11()
    {
        return Configs::instance()->userTable;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    public function get_usr_ref_list($params) {
        $utype=$params['utype'];
        $campus_id=$params['campus_id'];
        if($utype=="DOCTOR") {
            $sql="select  a.item_id doc_id, a.item_description doc_name, b.category_name, b.sub_category_name, a.item_code
            FROM  HMS.HMS_SYSTEM_ITEM_TL A,  HMS.HMS_SYSTEM_ITEM_CATEGORY_TL B
            WHERE 1=1
            and a.item_id = b.item_id
            and a.campus_id = b.campus_id
            and a.campus_id = :campus_id
            and a.user_item_type like '10'
            and a.status like 'ACTIVE'
            order by 1,2";
        } else {
            $sql="select * from HMS_SYSTEM_ITEM_TL where 1=2";
        }
        $qrydata=Yii::$app->db->createCommand($sql);
        $qrydata->bindValue(':campus_id',$campus_id);
        $data=$qrydata->queryAll();
        return $data;
    }


    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                'password_reset_token' => $token,
                'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
