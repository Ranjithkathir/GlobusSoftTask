<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;

    protected $table = 'employees';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobilenumber', 'designationId', 'salary'
    ];

    public function designation(){
        return $this->belongsTo('App\Designation', 'designationId');
    }
}
