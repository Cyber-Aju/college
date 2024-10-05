<?php
class SubController
{
    // public function subcontroller($request)
    // {
    //     $model = "./model/{$request['mod']}" . "Model.php";
    //     if (file_exists($model)) {
    //         require($model);
    //     } else {
    //         echo "Folder not found!";
    //     }
    // }

    public function fileHandling($mvc, $file, $parameter)
    {
        // define('MODEL', "./model/{$file}.php");
        // define('VIEW', "./view/{$file}.php");
        // define('COMMON', "./common/{$file}.php");
        $adminName = $_SESSION['adminLoggedBy'];
        switch ($mvc) {
            case 'MODEL':
                if (file_exists(MODELPATH . $file . ".php")) {
                    require_once(MODELPATH . $file . ".php");
                } else {
                    $error = "Model file Not Found";
                    require_once('./view/error.php');
                }
                break;

            case 'VIEW':
                if (file_exists(VIEWPATH . $file . '.php')) {
                    switch ($file) {
                        case 'StudentEdit':
                            $quer = $parameter;
                            break;
                        case 'studentlist':
                            $list = $parameter['result'];
                            $total_pages = $parameter['total_pages'];
                            $page = $parameter['page'];
                            $num_results_on_page = $parameter['num_results_on_page'];
                            break;
                        case 'view':
                            $viewQuer = $parameter;
                            break;
                    }
                    require_once(VIEWPATH . $file . ".php");
                } else {
                    $error = "View file Not Found";
                    require_once('./view/error.php');
                }
                break;

            case 'COMMON':
                $commonPath = "./common/{$file}.php";
                if (file_exists(COMMONPATH . $file . ".php")) {
                    require_once($commonPath);
                } else {
                    $error = "common file Not Found";
                    require_once('./view/error.php');
                }
                break;
            default:
                throw new Exception("Invalid file type specified in base controller.");
        }
    }
    // $this->fileHandling(COMMON,$header='header');
}
?>