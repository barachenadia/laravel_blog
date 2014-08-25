<?php
class Comment extends Eloquent {
    protected $fillable = array('title', 'user_id', 'article_id', 'text');
    public function article()
    {
        return $this->belongsTo('Article');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}

