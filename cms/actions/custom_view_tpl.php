<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Обернем элемент input-rext в таблицу');
        $fieldset->insertStatic('
            В этой форме мы:<br /><br />

            1) изменили сообщение внизу формы о том, что есть поля, обязательные для заполнения<br /><br />

            2) установили для элемента класса HTML_QuickForm2_Element_Input (класс в данном случае
            это класс PHP, а не CSS) кастомизированный шаблон<br /><br />

            3) Для кнопки с id="submit" добавили в шаблон ссылку
        ');

        $fieldset->insertInputText('inputtext')->setLabel('Логин')
            ->setComment('Введите Ваш логин или email')
            ->addRuleRequired('Обязательное поле');

        $fieldset->insertInputPassword('pass')->setLabel('Пароль')
            ->setComment('Введите Ваш пароль');

        $fieldset->insertInputSubmit('Сохранить')->setId('submit');

    $renderer = HTML_QuickForm2_Renderer::factory('default');

    //-------------------------------------------------------------------
    //1) изменили сообщение внизу формы о том, что есть поля, обязательные для заполнения<br />
    $renderer->setOption(array(
        'required_note' => '<strong>
        Note:</strong> Required fields are marked with an asterisk (<em>*</em>).'
    ));

    //-------------------------------------------------------------------
    //2) установили для элемента класса HTML_QuickForm2_Element_Input (класс в данном случае
    //это класс PHP, а не CSS) кастомизированный шаблон
    //специально некрасиво раскрасим таблицу, чтобы ее было видно
    Jaguar::css()->addCssInline('
    td{
        border:1px solid;
        padding: 10px;
    }
    ');
    //установим для элемента этого класса (класс в данном случае это класс PHP, а не CSS) шаблон
    $renderer->setTemplateForClass(
    'HTML_QuickForm2_Element_Input',
    '<table>
        <tr>
            <td>
                <label for="{id}" class="jqf_element"><qf:required><span class="required">* </span></qf:required>{label}</label>
                <span class="jqf_error" id="jqferr-{id}"><qf:error>{error}</qf:error></span>
            </td>
            <td>
                {element}
                {comment}
                {example}
            </td>
        </tr>
    </table>');

    //-------------------------------------------------------------------
    //3) Для кнопки с id="submit" добавили в шаблон ссылку
    $renderer->setTemplateForId('submit', '<div class="element">{element} or <a href="/">Cancel</a></div>');

?>