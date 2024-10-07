<?php
class SubController
{
    /**
     * handles file handling for MVC
     * @param mixed $mvc
     * @param mixed $file
     * @param mixed $parameter
     * @throws \Exception
     * @return void
     */
    public function fileHandling($mvc, $file, $parameter)
    {
        $adminName = $_SESSION['adminLoggedBy'];
        switch ($mvc) {
            case 'MODEL':
                if (file_exists(MODELPATH . $file . ".php")) {
                    require_once(MODELPATH . $file . ".php");
                } else {
                    $error = "Model file Not Found";
                    $this->error($error);
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
                        case 'filter':
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
                    $this->error($error);
                }
                break;

            case 'COMMON':
                $commonPath = "./common/{$file}.php";
                if (file_exists(COMMONPATH . $file . ".php")) {
                    require_once($commonPath);
                } else {
                    $error = "common file Not Found";
                    $this->error($error);
                }
                break;
            default:
                throw new Exception("Invalid file type specified in base controller.");
        }
    }

    /**
     * Handles error
     * @param mixed $error
     * @return void
     */
    public function error($error)
    {
        if (file_exists('./view/error.php')) {
            require_once('./view/error.php');
        }
    }

    /**
     * Handles success message
     * @param mixed $message
     * @return void
     */
    public function success($message)
    {
        if (file_exists('./view/success.php')) {
            require_once('./view/success.php');
        }
    }


    // public function subcontroller($request)
    // {
    //     $model = "./model/{$request['mod']}" . "Model.php";
    //     if (file_exists($model)) {
    //         require($model);
    //     } else {
    //         echo "Folder not found!";
    //     }
    // }


    // $this->fileHandling(COMMON,$header='header');
}
?>