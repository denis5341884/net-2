<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования file');
		$upload = $fieldset->addElement('file','picture')
			->setLabel('Картинка')
			->setAttribute('size',70);
			$upload->addRule('required',"Вы забыли приложить картинку");

			// no longer using 'filename' rule for uploads
			$upload->addRule('regex', 'разрешенные расширения: .gif, .jp(e)g, .png', '/\\.(gif|jpe?g|png)$/i');
			$upload->addRule('mimetype', 'Сдается мне вы пытаетесь загрузить совсем не картинку, я прав?',
				array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg'));
			$upload->addRule('maxfilesize', 'Картинка великовата, разрешается до 200kB', 204800);
?>