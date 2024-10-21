<?php
// namespace App\Helpers;

use App\Models\User;

    class Helper{
    
        public static function user($email)
        {
            return User::where('email',$email)->first();
        }
    }

?>