<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fournisseur
 * @package App\Models
 */
class Fournisseur extends Model
{
    /**
     * @var string
     */
    protected $table = 'fournisseur';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'address', 'tel',];

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        
    }
}