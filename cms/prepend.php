<?
    //показываем все ошибки
    ini_set('display_errors' , 'On');
    ini_set('error_reporting' , E_ALL);
	header('Content-Type: text/html; charset=utf-8'); 
	
    //директория с библиотеками
    define('DIR_VENDORS', dirname( dirname(__FILE__) ).'/vendors/');

    // пути для подключения
    set_include_path(implode(PATH_SEPARATOR, array(DIR_VENDORS,DIR_VENDORS.'PEAR/',)));

    //Автозагрузка классов
    function __autoload($class){
        $path = str_replace('_','/',$class).'.php';
//        jaguar_debug($class);
        foreach (explode(PATH_SEPARATOR,get_include_path()) as $dir) {
            $dir = str_replace('\\','/', $dir);
            if(file_exists($dir.$path)){
                include_once($dir.$path);
//                jaguar_debug($dir.$path);
                return true;
            }
        }
        return false;
    }

    //создаем представление
    Jaguar::view(dirname(__FILE__).'/tpl/layout.tpl');

    //добавляем стили представления формы и страницы
    Jaguar::css()->addCss('/cms/css.css');
    Jaguar::css()->addCss('/cms/quickform.css');

    //Подключаем главный js-файл форм, который отвечает за клиентскую валидацию
    Jaguar::js()->addJs('/cms/quickform.js');

    //библиотека Дмитрия Котерова для уведомления об ошибках
    Jaguar::js()->addJs('/cms/orphus.js');
?>