<?php
    class ContactParameters{
        public static function GetParameters(array $para) : object{
            return (object) array (
                'id' => $para['id']??null,
                'first' => $para['first']??"",
                'last' => $para['last']??"",
                'email' => $para['email']??"",
                'phone' => $para['phone']??""
            );
        }
    }
?>