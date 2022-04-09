<?php

if (! function_exists('getBookmarks')){
    function getBookmarks(){
        $model = new \App\Models\BookmarkModel();
        return $model->findAll();
    }
}



if (! function_exists('bookmarked')){
    function bookmarked($uri){
        $model = new \App\Models\BookmarkModel();
        if ( $model->where('uri', $uri)->first()){
            return true;
        }else{
            return false;
        }

    }
}