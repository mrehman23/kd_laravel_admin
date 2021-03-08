<?php

namespace common\modules\kdadmin\models;

use Yii;
use common\modules\kdadmin\components\Configs;
use yii\db\Query;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id Menu id(autoincrement)
 * @property string $name Menu name
 * @property integer $parent Menu parent
 * @property string $route Route for this menu
 * @property integer $order Menu order
 * @property string $data Extra information for this menu
 *
 * @property Menu $menuParent Menu parent
 * @property Menu[] $menus Menu children
 *
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class Menu extends \yii\db\ActiveRecord
{
    public $parent_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Configs::instance()->menuTable;
    }

    public static function primaryKey()
    {
        return ["menu_id"];
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mname'], 'required'],
            [['parent_name'], 'in',
                'range' => static::find()->select(['mname'])->column(),
                'message' => 'Menu "{value}" not found.'],
            [['mparent', 'route', 'mdata', 'morder'], 'default'],
            [['mparent'], 'filterParent', 'when' => function() {
                return !$this->isNewRecord;
            }],
            [['morder'], 'integer'],
            [['route'], 'in',
                'range' => static::getSavedRoutes(),
                'message' => 'Route "{value}" not found.']
        ];
    }

    /**
     * Use to loop detected.
     */
    public function filterParent()
    {
        $parent = $this->mparent;
        $db = static::getDb();
        $query = (new Query)->select(['mparent'])
            ->from(static::tableName())
            ->where('[[menu_id]]=:id');
        while ($parent) {
            if ($this->menu_id == $parent) {
                $this->addError('parent_name', 'Loop detected.');
                return;
            }
            $parent = $query->params([':id' => $parent])->scalar($db);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => Yii::t('rbac-admin', 'ID'),
            'mname' => Yii::t('rbac-admin', 'Name'),
            'mparent' => Yii::t('rbac-admin', 'Parent'),
            'parent_name' => Yii::t('rbac-admin', 'Parent Name'),
            'route' => Yii::t('rbac-admin', 'Route'),
            'morder' => Yii::t('rbac-admin', 'Order'),
            'mdata' => Yii::t('rbac-admin', 'Data'),
        ];
    }

    /**
     * Get menu parent
     * @return \yii\db\ActiveQuery
     */
    public function getMenuParent()
    {
        return $this->hasOne(Menu::className(), ['menu_id' => 'mparent']);
    }

    /**
     * Get menu children
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['mparent' => 'menu_id']);
    }
    private static $_routes;

    /**
     * Get saved routes.
     * @return array
     */
    public static function getSavedRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];
            foreach (Configs::authManager()->getPermissions() as $name => $value) {
                if ($name[0] === '/' && substr($name, -1) != '*') {
                    self::$_routes[] = $name;
                }
            }
        }
        return self::$_routes;
    }

    public static function getMenuSource()
    {
        $tableName = static::tableName();
        return (new \yii\db\Query())
                ->select(['m.menu_id', 'm.mname', 'm.route', 'parent_name' => 'p.mname'])
                ->from(['m' => $tableName])
                ->leftJoin(['p' => $tableName], '[[m.mparent]]=[[p.menu_id]]')
                ->all(static::getDb());
    }
}
