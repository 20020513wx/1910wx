<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    //表名
    protected $table = 'tokens';
    //主键
    protected $primaryKey = 'id';
    //时间戳
    public $timestamps = false;
    //黑名单  用create添加的时候加黑名单
    protected $guarded = [];
}
