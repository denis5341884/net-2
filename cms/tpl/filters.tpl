В HTML_QuickForm2 поддерживается фильтрация вводимых данных.<br /><br />

В качестве фильтра может выступать любая функция или метод класса (в т.ч. статический), который в дальнейшем вызывается через <strong>call_user_func_array</strong>.
<br />
<br />
Обратите внимание, что фильтры назначаюся по-умолчанию рекурсивно, т.е. если подразумевается, что к каждому элементу форму нужно применить фильтр <strong>trim</strong>,
то лучше это указать <strong>один раз</strong> у самого верхнего контейнера, т.е. у формы
<pre>
$form->addFilter('trim');
</pre>
Увидеть работу фильтра можно сравнив массивы $form->getValue() и $_POST.<br />
<br />
Обратите внимание, что ПОКА в фильтрах есть одна недоработка: то, что форма после поста выводится без учета фильтров.