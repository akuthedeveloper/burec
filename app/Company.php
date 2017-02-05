<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @package App
 * @property string $name
 * @property string $address
 * @property string $website
 * @property string $email
*/
class Company extends Model
{
    protected $fillable = ['name', 'address', 'website', 'email'];
    
    
}
