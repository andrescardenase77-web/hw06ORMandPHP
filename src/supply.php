<?php
use Illuminate\Database\Eloquent\Model;

class Supply extends Model {
    protected $table = 'Supply';
    protected $primaryKey = 'supplyId';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}