<?php

include 'REST.class.php';

class API extends REST2{

    public function __call($method, $args){
        if(is_callable($func)){
        return call_user_func($func);
        } else {
            $this->set_headers('Content-type: Application/json');
            $this->sendResponseData(404, ['error'=>'method_not_found']);
        }
    }

    public static function routeApiRequest($dir, $instance){
        // TODO: change the .htaccess from api-new to api.
        $func = array_pop($dir);
        $api_dir = $_SERVER['DOCUMENT_ROOT'] .'/src/' . implode('/', $dir);
        
        if(!is_dir($api_dir)){
            return false;
        }

        $dir_files = scandir($api_dir);
        foreach ($dir_files as $m){
            if($m == '.' or $m == '..'){
                continue;
            }
            $func_name = basename($m, '.php');
            // echo $func_name;
            // echo $api_dir;
            if($func_name == $func){
                include $api_dir.'/'.$m;
                $func = Closure::bind(${$func_name}, $instance, 'API');
                if(is_callable($func)){
                return call_user_func($func);
                }
            } else {
               return false;
            }
        }
    }


    public function processApi(){

        try{ 
            $result = API::routeApiRequest(explode('/', trim($_SERVER['REQUEST_URI'], '/')), $this);
            if($result === false){
                $this->set_headers('Content-type: Application/json');
                $this->sendResponseData(404, ['error'=>'Invalid API Parameters da deeeiiii']);
            } 
        // if(isset($_GET['type']) and isset($_GET['action'])){
        //     try{
        //         API::routeApiRequest($_GET['action'], explode('/', trim($_SERVER['REQUEST_URI'], '/')) , $this);
        //     } catch(Exception $e){
        //         die("failed");
        //     }
        //     die();

        //     if(isset($_GET['type']) and isset($_GET['db']) and isset($_GET['action'])){
        //         // $dir = $_SERVER['DOCUMENT_ROOT'].'/src/api-new/'.$_GET['type']. '/' . $_GET['db'];
        //         // $dir_files = scandir($dir);
        
        //         // foreach ($dir_files as $m){
        //         //     if($m == '.' or $m == '..'){
        //         //         continue;
        //         //     }
        //         //     $func_name = basename($m, '.php');
        //         //     if($func_name == $_GET['action']){
        //         //         include $dir.'/'.$m;
        //         //         $func = Closure::bind(${$func_name}, $this, 'API');
        //         //         if(is_callable($func)){
        //         //         return call_user_func($func);
        //         //         }
        //         //     } else {
        //         //         $this->set_headers('Content-type: Application/json');
        //         //         $this->sendResponseData(404, ['error'=>'method_not_found']);
        //         //     }
        //         // }

        //         try{
        //             API::routeApiRequest($_GET['action'], explode('/', trim($_SERVER['REQUEST_URI'], '/')) , $this);
        //         } catch(Exception $e){
        //             die("failed");
        //         }


        //     } else {
        //         $this->set_headers('Content-type: Application/json');
        //         $this->sendResponseData(404, ['error'=>'Invalid API Parameters']);
        //         die();
        //     }
        //         $func_name = $_GET['action'];
        //         $dir = $_SERVER['DOCUMENT_ROOT'].'/src/api-new/'.$_GET['type'];
        //         $dir_files = scandir($dir);
        
        //         foreach ($dir_files as $m){
        //             if($m == '.' or $m == '..'){
        //                 continue;
        //             }
        //             $func_name = basename($m, '.php');
        //             if($func_name == $_GET['action']){
        //                 include $dir.'/'.$m;
        //                 $func = Closure::bind(${$func_name}, $this, 'API');
        //                 if(is_callable($func)){
        //                 return call_user_func($func);
        //                 }
        //             } else {
        //                 $this->set_headers('Content-type: Application/json');
        //                 $this->sendResponseData(404, ['error'=>'method_not_found']);
        //             }
        //         }
           
        // } else {
        //     $this->set_headers('Content-type: Application/json');
        //     $this->sendResponseData(404, ['error'=>'Invalid API Parameters']);
        // }

    } catch(Exception $e){
        $this->set_headers('Content-type: Application/json');
        $this->sendResponseData(500, ['error'=>'Invalid API Request']);
    }
        }
    
    
}