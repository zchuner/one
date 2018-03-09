<?php
use \App\Http\PHPExtends\System\extendLoad;

class session_files
{
    function __construct()
    {
        $path = extendLoad::load_config('system', 'session_n') > 0 ? extendLoad::load_config('system', 'session_n') . ';' . extendLoad::load_config('system', 'session_savepath') : extendLoad::load_config('system', 'session_savepath');
        ini_set('session.save_handler', 'files');
        ini_set("session.cookie_httponly", 1);
        session_save_path($path);
        session_start();
    }
}