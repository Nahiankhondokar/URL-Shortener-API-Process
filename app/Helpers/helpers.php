<?php 

if(!function_exists('findRandomStr')){
    function findRandomStr(){
        $characters = 'aNQRSopFGLWXYZbcqOPrsMTUVtuvABCDEdefgHIJKhwxyzijklmn';
        $randomStr = '';
        for($i=0; $i<strlen($characters); $i++){
            if(strlen($randomStr) < 5){
                $randomStr .= $characters[rand(0, strlen($characters)-1)];
            }
        }
        
        return $randomStr;
    }
}