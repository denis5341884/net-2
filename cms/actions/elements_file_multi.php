<?

    session_start();
    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = mb_substr(session_id(),4,5);
    }

    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования file');
    //для примера это идентификатор категории, в которую производится загрузка фотографий
    $gallery_cat_id = 123;
	$upload = $fieldset->insertMultiUpload('file','/cms/upload/index.php', array('cat_id'=>$gallery_cat_id),102400);
	$upload = $fieldset->insertMultiUpload('file2','/cms/upload/index.php', array('cat_id'=>$gallery_cat_id),102400);
    Jaguar::view()->setVar('PHP_CODE','<h2>Скрипт обработчика загружаемых файлов</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        trim(highlight_file($_SERVER['DOCUMENT_ROOT']
        .'/cms/upload/index.php',true)));


?>