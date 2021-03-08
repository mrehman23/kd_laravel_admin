<?php

namespace kd\kdladmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Kd\Kdladmin\Components\Configs;
use Kd\Kdladmin\Models\AuthItemChild;
use Illuminate\Http\Request;

/**
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class AuthItem extends Model
{
    // public $name;
    // public $type;
    // public $description;
    // public $ruleName;
    // public $data;

    // private $_item;

    private $prefix;
    // protected $table = 'users1';
    public $timestamps = false;
    protected $primaryKey = 'name';
    protected $keyType = 'string';

    public function __construct($config = []) {
        parent::__construct($config);
        $this->setTable(Configs::$auth_itemTable);
    }

    protected $fillable = [
        'name','type','description','ruleName','data','updated_at','created_at'
    ];

    public function getDateFormat() {
        return 'U';
    }

    public function search($params) {
        return AuthItem::all();
    }


    // public function __construct111($item = null, $config = [])
    // {
    //     $this->_item = $item;
    //     if ($item !== null) {
    //         $this->name = $item->name;
    //         $this->type = $item->type;
    //         $this->description = $item->description;
    //         $this->ruleName = $item->ruleName;
    //         $this->data = $item->data === null ? null : Json::encode($item->data);
    //     }
    //     parent::__construct($config);
    // }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruleName'], 'checkRule'],
            [['name', 'type'], 'required'],
            [['name'], 'checkUnique', 'when' => function () {
                return $this->isNewRecord || ($this->_item->name != $this->name);
            }],
            [['type'], 'integer'],
            [['description', 'data', 'ruleName'], 'default'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * Check role is unique
     */
    public function checkUnique()
    {
        $authManager = Configs::authManager();
        $value = $this->name;
        if ($authManager->getRole($value) !== null || $authManager->getPermission($value) !== null) {
            $message = Yii::t('yii', '{attribute} "{value}" has already been taken.');
            $params = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $value,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message, $params, Yii::$app->language));
        }
    }

    /**
     * Check for rule
     */
    public function checkRule()
    {
        $name = $this->ruleName;
        if (!Configs::authManager()->getRule($name)) {
            try {
                $rule = Yii::createObject($name);
                if ($rule instanceof \yii\rbac\Rule) {
                    $rule->name = $name;
                    Configs::authManager()->add($rule);
                } else {
                    $this->addError('ruleName', Yii::t('rbac-admin', 'Invalid rule "{value}"', ['value' => $name]));
                }
            } catch (\Exception $exc) {
                $this->addError('ruleName', Yii::t('rbac-admin', 'Rule "{value}" does not exists', ['value' => $name]));
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('rbac-admin', 'Name'),
            'type' => Yii::t('rbac-admin', 'Type'),
            'description' => Yii::t('rbac-admin', 'Description'),
            'ruleName' => Yii::t('rbac-admin', 'Rule Name'),
            'data' => Yii::t('rbac-admin', 'Data'),
        ];
    }

    /**
     * Check if is new record.
     * @return boolean
     */
    public function getIsNewRecord()
    {
        return $this->_item === null;
    }

    /**
     * Find role
     * @param string $id
     * @return null|\self
     */
    public static function find($id)
    {
        $item = Configs::authManager()->getRole($id);
        if ($item !== null) {
            return new self($item);
        }

        return null;
    }

    /**
     * Save role to [[\yii\rbac\authManager]]
     * @return boolean
     */
    public function save1()
    {
        if ($this->validate()) {
            $manager = Configs::authManager();
            if ($this->_item === null) {
                if ($this->type == Item::TYPE_ROLE) {
                    $this->_item = $manager->createRole($this->name);
                } else {
                    $this->_item = $manager->createPermission($this->name);
                }
                $isNew = true;
            } else {
                $isNew = false;
                $oldName = $this->_item->name;
            }
            $this->_item->name = $this->name;
            $this->_item->description = $this->description;
            $this->_item->ruleName = $this->ruleName;
            $this->_item->data = $this->data === null || $this->data === '' ? null : Json::decode($this->data);
            if ($isNew) {
                $manager->add($this->_item);
            } else {
                $manager->update($oldName, $this->_item);
            }
            Helper::invalidate();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Adds an item as a child of another item.
     * @param array $items
     * @return int
     */
    public function addChildren111($parent,$items)
    {
        $success = 0;
        foreach ($items as $key => $name) {
            AuthItemChild::create([
                'parent' => $parent,
                'child' => $name,
            ]);
            $success++;
        }
        return $success;


        $manager = Configs::authManager();
        $success = 0;
        if ($this->_item) {
            foreach ($items as $name) {
                $child = $manager->getPermission($name);
                if ($this->type == Item::TYPE_ROLE && $child === null) {
                    $child = $manager->getRole($name);
                }
                try {
                    $manager->addChild($this->_item, $child);
                    $success++;
                } catch (\Exception $exc) {
                    Yii::error($exc->getMessage(), __METHOD__);
                }
            }
        }
        if ($success > 0) {
            Helper::invalidate();
        }
        return $success;
    }

    /**
     * Remove an item as a child of another item.
     * @param array $items
     * @return int
     */
    public function removeChildren($items)
    {
        $manager = Configs::authManager();
        $success = 0;
        if ($this->_item !== null) {
            foreach ($items as $name) {
                $child = $manager->getPermission($name);
                if ($this->type == Item::TYPE_ROLE && $child === null) {
                    $child = $manager->getRole($name);
                }
                try {
                    $manager->removeChild($this->_item, $child);
                    $success++;
                } catch (\Exception $exc) {
                    Yii::error($exc->getMessage(), __METHOD__);
                }
            }
        }
        if ($success > 0) {
            Helper::invalidate();
        }
        return $success;
    }

    /**
     * Get items
     * @return array
     */
    public function getItems()
    {
        $assigned = [];
        $available = [];
        foreach (Route::getRoutes() as $key => $route) {
            if($route->getName()) {
                $available[$route->getName()] = 'route';
            }
        }
        $auth_item=[];
        foreach (AuthItem::where('name','<>',Request()->id)->get() as $key => $route) {
            $auth_item[$route->name] = 'permission';
            $available[$route->name] = 'permission';
        }
        // dd($auth_item);
        // $perm_lists=AuthItem::get();
        $perm_lists=AuthItemChild::where(['parent'=>Request()->id])->get();
        foreach ($perm_lists as $key => $perm_list) {
            $assigned[$perm_list['child']] = (array_key_exists($perm_list['child'], $auth_item) ? 'permission' : 'route');
            unset($available[$perm_list['child']]);
        }
        // dd($available);
        // dd(Route::getRoutes());
        unset($available[$this->name]);
        ksort($available);
        ksort($assigned);
        return [
            'available' => $available,
            'assigned' => $assigned,
        ];

        /*

          @foreach (Route::getRoutes() as $route)
          @if($route->getName())
            <tr>
                  <td>{{ $route->getName() }}</td>
                  <td>
                  @if(isset($RouteList[$route->getName()]))
                  <a href="#" class="editable" data-type="text" data-name="name" 

                  data-value="{{ $RouteList[$route->getName()] }}" data-pk="{{$route->getName()}}"
            data-url="{{ route('admin.user.routelist.update', $route->getName()) }}">{{ $RouteList[$route->getName()] }}</a>
                  @else
                  <a href="#" class="editable" data-type="text" data-name="name" data-value="{{ $route->getName() }}" data-pk="{{$route->getName()}}"
            data-url="{{ route('admin.user.routelist.update', $route->getName()) }}" data-Title="Enter Name"></a>
                  @endif
                  </td>
                  <td>
                    <div class="slide-success">
                      <input type="checkbox" value="1" name="permissions[{{ $route->getName() }}]" class="iosblue" {{ (isset($permissions[$route->getName()]) && $permissions[$route->getName()] == 1) ? 'checked="checked"' : null }}/>
                    </div>
                  </td>
                  <td>
                  </td>
              </tr>
              @endif
          @endforeach

        */

        $manager = Configs::authManager();

        $available = [];
        if ($this->type == Item::TYPE_ROLE) {
            foreach (array_keys($manager->getRoles()) as $name) {
                $available[$name] = 'role';
            }
        }
        foreach (array_keys($manager->getPermissions()) as $name) {
            $available[$name] = $name[0] == '/' ? 'route' : 'permission';
        }

        $assigned = [];
        foreach ($manager->getChildren($this->_item->name) as $item) {
            $assigned[$item->name] = $item->type == 1 ? 'role' : ($item->name[0] == '/' ? 'route' : 'permission');
            unset($available[$item->name]);
        }
        unset($available[$this->name]);
        return [
            'available' => $available,
            'assigned' => $assigned,
        ];
    }

    /**
     * Get item
     * @return Item
     */
    public function getItem()
    {
        return $this->_item;
    }

    /**
     * Get type name
     * @param  mixed $type
     * @return string|array
     */
    public static function getTypeName($type = null)
    {
        $result = [
            Item::TYPE_PERMISSION => 'Permission',
            Item::TYPE_ROLE => 'Role',
        ];
        if ($type === null) {
            return $result;
        }

        return $result[$type];
    }
}
