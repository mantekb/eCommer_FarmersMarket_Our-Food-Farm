<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function excerpt()
    {
    	$length = 100;
    	$excerpt = $this->content;
    	if (strlen($excerpt) > $length)
    	{
    		$excerpt = substr($excerpt, 0, $length)."...";
    	}
    	return $excerpt;
    }
}
