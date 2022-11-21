<?
//вспомогательные библиотеки
foreach (glob(dirname(__FILE__)."/cms/helpers/*.php") as $helper) {
    include_once($helper);
}
//Инициализация
require('cms/prepend.php');
//подключение роутинга
require('cms/routes.php');
//определение текущей страницы
define('PAGE', isset($_GET['page']) ? trim(strip_tags($_GET['page'])) : 'jquickform');

function stop(){
    header("HTTP/1.0 404 Not Found");
    print '404, может быть <a href="/">на главную</a>?';
//    header("Location: /");
    exit;
}

if(!preg_match('/^([a-z_0-9]+)$/',PAGE)){
    stop();
}

$action = dirname(__FILE__).'/cms/actions/'.PAGE.'.php';
if(file_exists($action)){
    include($action);
} else {
    $tpl = dirname(__FILE__).'/cms/tpl/'.PAGE.'.tpl';
    if(file_exists($tpl)){
        $page = new Jaguar_View($tpl);
        Jaguar::view()->setVar('body',$page->parse());
    } else {
        stop();
    }
}

//построение меню
function get_menu_item($key, $value){
    if(($key == PAGE)){
        define('PAGE_TITLE', $value);
        return sprintf('<strong>%s</strong>',$value);
    } else {
    	return sprintf('<a href="?page=%s">%s</a>', $key, $value);
    }
}
$menu = '';
foreach ($routes as $key=>$group) {
    $menu .= '<ul class="menu-v">';
    $menu .= '<li>';
    $menu .= get_menu_item($key, $group['text']);
    if(isset($group['elements'])){
        $menu .= '<ul>';
        foreach ($group['elements'] as $_key=>$text) {
            $menu .= '<li>';
            $menu .= get_menu_item($key.'_'.$_key, $text);
            $menu .= '</li>';
        }
        $menu .= '</ul>';
    }
    $menu .= '</li>';
    $menu .= '</ul>';
}
Jaguar::view()->setVar('PAGE',  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
Jaguar::view()->setVar('title', strip_tags(PAGE_TITLE. ' / '));
Jaguar::view()->setVar('h1',    strip_tags(PAGE_TITLE));
Jaguar::view()->setVar('menu',  $menu);

//генерация и вывод страницы
require('cms/append.php');
?>