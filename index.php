<?php
class MainController
{
    /**
     * @author Vignesh Manikandan R
     * @since 25/09/2024
     * @update Vignesh Manikandan (26-09-2024)
     * @method hook
     * 
     *  This function is used to process the $_SERVER'S REQUEST_URI datas
        return array
     */

    public function hook()
    {
        #Get's the URL
        $url=$_SERVER['REQUEST_URI'];
        #To divid's the path and query string
        $request=parse_url($url);
        if(array_key_exists('query',$request))
        {
            #To Seperates the query string with the seperator of &
            $query=explode("&",$request['query']);
            #To Seperates the query string process data with the seperator of =
            foreach($query as $query_data)
                $query_split[]=explode("=",$query_data);
            #processed data in the format of single array inside multi arrays ,so we decided to form as associate array
            $data=array_column($query_split,1,0);
            #if it's array then do to.
            #Both mod and view are exists means processed the data
            if(isset($data['mod'])&& isset($data['view']))
            {
                $datas=[
                    'model'=>$data['mod'],
                    'controller'=>$data['mod'],
                    'view'=>$data['view'],
                ];
                unset($data['mod'],$data['view']);
                $datas['request_data']=$data;
                // echo "<pre>";
                // print_r($datas);
                #returns model, view and data in the associate array format
                $this->run_module($datas);
            }
            else
            {
                echo "URL is missing some datas";
            }
        }
        else
        {
            require "view/login.php";
        }   
    }

    /**
     * @author Vignesh Manikandan R
     * @since 25/09/2024
     * @update Vignesh Manikandan (26-09-2024)
     * @method run_module
     * 
     *  This function is used to re-direct the execution flow. 
     *  Geten datas from the hook to identify                                                                     the model data to re-directs the flow wi the certain mod and view data.
        return void
     */

    public function run_module($request_datas)
    {
        #handling the file exception
        try 
        {
            $classname=ucfirst($request_datas['controller']);
            #path direction(sub-Controller)
            $path = "Controller/{$classname}controller.php";
            #file type doesn't throw exception so, include file_exists method
            if (!file_exists($path)) 
            {
                #controller file is not exists means
                throw new \Exception('File Not Found');
            }
            else
            {
                include $path;
                $main=new $classname();
                $func_name=$request_datas['view'];
                #dynamically call's the sub-contoller method 
                call_user_func(array($main,$func_name),$request_datas);
            }  
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
            die;
        }       
    }
}
$main=new MainController;
$main->hook();
// $absolutePath = dirname(__FILE__); echo $absolutePath;
// PRINT_R($_SESSION);
?>