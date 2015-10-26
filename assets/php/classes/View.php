<?php

class View
{
    public function __construct(){

    }

    public static function addScript($values)
    {
        $temp = "";
        foreach ($values as $value){
            $temp = $temp ." <script src=\"" . $value."\"></script>\n";
        }
        return $temp;
    }

    public static function addStyle($values)
    {
        $temp = "";
        foreach ($values as $value){
            $temp = $temp ." <link href=\"" . $value." \"rel=\"stylesheet\" type=\"text/css\">\n";
        }
        return $temp;
    }

    public static function addMeta($values)
    {
        $temp = "";
        foreach ($values as $value){
            $temp = $temp ." <meta name=\"viewport\" content=\"". $value."\" />\n";
        }
        return $temp;
    }

    public static function includeHeader($userType){
        if($userType == "Student"){
            return "/assets/php/views/header-student.php";
        } elseif($userType == "Tutor"){
            return "/assets/php/views/header-tutor.php";
        } elseif($userType == "Teacher"){
            return "/assets/php/views/header-teacher.php";
        } elseif($userType == "Administrator"){
            return "/assets/php/views/header-admin.php";
        }
    }

    public static function includeLeftNav($userType){
        if($userType == "Student"){
            return "/assets/php/views/leftnav-student.php";
        } elseif($userType == "Tutor"){
            return "/assets/php/views/leftnav-tutor.php";
        } elseif($userType == "Teacher"){
            return "/assets/php/views/leftnav-teacher.php";
        } elseif($userType == "Administrator"){
            return "/assets/php/views/leftnav-admin.php";
        }
    }

    public static function dashboard($userType){
        if($userType == "Student"){
            return "/assets/php/views/dashboard-student.php";
        } elseif($userType == "Tutor"){
            return "/assets/php/views/dashboard-tutor.php";
        } elseif($userType == "Teacher"){
            return "/assets/php/views/dashboard-teacher.php";
        } elseif($userType == "Administrator"){
            return "/assets/php/views/dashboard-admin.php";
        }

    }

    public static function user_edit($userType){
        if($userType == "Student"){
            return "/assets/php/views/users/student.php";
        } elseif($userType == "Tutor"){
            return "/assets/php/views/users/tutor.php";
        } elseif($userType == "Teacher"){
            return "/assets/php/views/users/teacher.php";
        } elseif($userType == "Administrator"){
            return "/assets/php/views/admin.php";
        }

    }
    
    public static function user_profile($userType){
        if($userType == "Student"){
            return "/assets/php/views/userprofile/student.php";
        } elseif($userType == "Tutor"){
            return "/assets/php/views/userprofile/tutor.php";
        } elseif($userType == "Teacher"){
            return "/assets/php/views/userprofile/teacher.php";
        } elseif($userType == "Administrator"){
            return "/assets/php/views/userprofile/admin.php";
        }

    }

} 