<?
    $form = new jQuickForm('simple');
	$form->setAttribute('enctype', 'multipart/form-data');
	$form->addElement('hidden', 'MAX_FILE_SIZE')->setValue('204800');

        $fieldset = $form->insertFieldset('Демотиватор');
			$upload = $fieldset->addElement('file','picture')
				->setLabel('Картинка для дема')
				->setAttribute('size',70);
				$upload->addRule('required',"Что за дем без картинки?");

				// no longer using 'filename' rule for uploads
				$upload->addRule('regex', 'Allowed extensions: .gif, .jp(e)g, .png', '/\\.(gif|jpe?g|png)$/i');
				$upload->addRule('mimetype', 'Your browser doesn\'t think that\'s an image',
					array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg'));
				$upload->addRule('maxfilesize', 'Картинка великовата, разрешается до 200kB', 204800);
			$gr = $fieldset->insertGroup()->addClass('col2');
				$header = $gr->insertInputText('header')
					->setLabel('Заголовок (обязательно):')
					->setAttribute('size',70);
					$header->addRuleMax("Очень много текста для заголовка", 15);
					$header->addRuleRequired("Заголовок для демотиватора обязателен");
				$gr->insertInputCheckbox(1,'все большие буквы','header_up');
			$gr = $fieldset->insertGroup()->addClass('col2');
				$text = $gr->insertInputText('text')
					->setAttribute('size',70)
					->setLabel('Демотиватор (не обязательно):')
					->setComment('Разрешается 25 символов');
				$text->addRuleMax("Краткость - сестра таланта", 25);
				$gr->insertInputCheckbox(1,'все маленькие буквы','text_up');
        $form->insertInputSubmit('Создать демотиватор!');

		if($form->validate()){
            $text   = isset($_POST['text'])? trim(strip_tags($_POST['text'])) : '';
            $header = isset($_POST['header'])? trim(strip_tags($_POST['header'])) : '';
            if(isset($_POST['header_up'])){
                $header = mb_strtoupper($header,'UTF-8');
            }
            if(isset($_POST['text_up'])){
                $text = mb_strtoupper($text,'UTF-8');
            }
			$dem = jaguar_demotivator($_FILES['picture']['tmp_name'], $header, $text);
			if(!$dem){
			    Jaguar::view()->setVar('BODY','<h3>ERROR: ошибка при создании демотиватора</h3>');
			} else {
    			header('Content-type: image/png');
    			imagepng($dem);
    			imagedestroy($dem);
    			exit;
			}
		}

?>