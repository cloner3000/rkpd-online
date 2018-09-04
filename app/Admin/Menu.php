<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{

    use HasRoles;

    protected $guard_name = 'menu'; // or whatever guard you want to use

    protected $table = 'menu';

    protected $hidden = 'id';

    protected $fillable = ['nama', 'url', 'urutan', 'icon', 'status', 'level'];

    public function parent()
    {
        return $this->hasOne(Menu::class, 'id', 'parrent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parrent_id', 'id');
    }

    public static function tree()
    {
        return static::where('is_admin', '=', false)->where('aktif', true)->with(implode('.', array_fill(0, 4, 'children')))
            ->where('parrent_id', '=', null)
            ->orderBy('urutan')
            ->get();
    }

    public function isHaveChildren()
    {
        return $this->with('children')->where('parrent_id', '=', $this->id)->first() ? true : false;
    }

}
