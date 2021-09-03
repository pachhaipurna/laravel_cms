<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
     const IS_ACTIVE='0';
     const IS_DELETED='1';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author_name'
    ];

    public $timestamps = true;

    public static function getAllAssignmentData()
    {
        $assignment = Assignment::select((array(
                            'title',
                            'author_name')))
                            ->OrderBy('created_at','DESC')->get();
        return $assignment;
    }

    public static function getTitle()
    {
        $assignment = Assignment::select((array(
            'title')))
            ->OrderBy('created_at','DESC')->get();
        return $assignment;
    }

    public static function getAuthor()
    {
        $assignment = Assignment::select((array(
            'author_name')))
            ->OrderBy('created_at','DESC')->get();
        return $assignment;
    }

}
