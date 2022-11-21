Изменения, которые пришлось добавить в HTML_QuickForm2, чтобы получилось то, что я хотел:<br />
<br />
<h2>Проксирующие методы</h2>
в HTML_QuickForm2_Node/HTML_QuickForm2_Container добавлены проксирующие методы из HTML_Common2, чтобы IDE правильно определяло возвращаемый ими тип - это важно для автодополнения кода
Чтобы не хакать это, нужно чтобы разработчики правильно отреагировали на  feature request <a href="http://pear.php.net/bugs/bug.php?id=16223">@return self</a><br />
Поясню примером кода:<br />
<code><span style="color: #000000">
<span style="color: #0000BB">&lt;?<br /></span><span style="color: #007700">abstract&nbsp;class&nbsp;</span><span style="color: #0000BB">HTML_Common2<br /></span><span style="color: #007700">{<br />&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">/**<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Comment&nbsp;associated&nbsp;with&nbsp;the&nbsp;element<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string<br />&nbsp;&nbsp;&nbsp;&nbsp;*/<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">private&nbsp;</span><span style="color: #0000BB">$_comment&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">null</span><span style="color: #007700">;<br /><br />&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">/**<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Sets&nbsp;the&nbsp;comment&nbsp;for&nbsp;the&nbsp;element<br />&nbsp;&nbsp;&nbsp;&nbsp;*<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;&nbsp;&nbsp;&nbsp;string<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@return&nbsp;&nbsp;&nbsp;HTML_Common2<br />&nbsp;&nbsp;&nbsp;&nbsp;*/<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">public&nbsp;function&nbsp;</span><span style="color: #0000BB">setComment</span><span style="color: #007700">(</span><span style="color: #0000BB">$comment</span><span style="color: #007700">)<br />&nbsp;&nbsp;&nbsp;&nbsp;{<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">_comment&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$comment</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br /><br />}<br />class&nbsp;</span><span style="color: #0000BB">HtmlElement&nbsp;</span><span style="color: #007700">extends&nbsp;</span><span style="color: #0000BB">HTML_Common2&nbsp;</span><span style="color: #007700">{<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;</span><span style="color: #0000BB">$_value&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">null</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">/**<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;mixed&nbsp;$value<br />&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@return&nbsp;HtmlElement<br />&nbsp;&nbsp;&nbsp;&nbsp;*/<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">function&nbsp;</span><span style="color: #0000BB">setValue</span><span style="color: #007700">(</span><span style="color: #0000BB">$value</span><span style="color: #007700">){<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">_value&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$value</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br />}<br /></span><span style="color: #0000BB">$el&nbsp;</span><span style="color: #007700">=&nbsp;new&nbsp;</span><span style="color: #0000BB">HtmlElement</span><span style="color: #007700">();<br /></span><span style="color: #FF8000">/*<br />если&nbsp;добавлять&nbsp;в&nbsp;таком&nbsp;порядке&nbsp;-&nbsp;автодополнение&nbsp;работает<br />*/<br /></span><span style="color: #0000BB">$el</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">setValue</span><span style="color: #007700">(</span><span style="color: #0000BB">123</span><span style="color: #007700">)-&gt;</span><span style="color: #0000BB">setComment</span><span style="color: #007700">(</span><span style="color: #DD0000">'comment'</span><span style="color: #007700">);<br /></span><span style="color: #FF8000">/*<br />а&nbsp;если&nbsp;добавлять&nbsp;в&nbsp;таком&nbsp;порядке&nbsp;-&nbsp;не&nbsp;работает,&nbsp;так&nbsp;как&nbsp;метод&nbsp;setComment<br />возвращает&nbsp;нам&nbsp;HTML_Common2&nbsp;вместо&nbsp;ожидаемого&nbsp;HtmlElement<br />*/<br /></span><span style="color: #0000BB">$el</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">setComment</span><span style="color: #007700">(</span><span style="color: #DD0000">'comment'</span><span style="color: #007700">)-&gt;</span><span style="color: #0000BB">setValue</span><span style="color: #007700">(</span><span style="color: #0000BB">123</span><span style="color: #007700">);<br /></span></span><span style="color: #0000BB">?&gt;</span>
</span>
</code>
Поэтому и приходится в дочерние классы добавлять проксирующие методы:
<pre>
class HtmlElement {
    /**
    * proxy
    * @return HtmlElement
    */
    public function setComment($comment){
        return parent::setComment($comment);
    }
}
</pre>

<h2>Сборщики элементов</h2>
В HTML_QuickForm2_Container были добавлены методы, которые создают экземпляры элементов формы и добавляют их к тому, контейнеру, из которого были вызваны.<br />
Чтобы не ломать возможность вызова традиционным способом, как это и было заложено разработчиками HTML_QuickForm2, а именно через магический метод __call, который
вызов
<pre>$group->addFieldset($name, $attr)</pre>
превращает в вызов
<pre>$group->addElement('fieldset', $name, $attr)</pre>
было принято решение отказаться от префикса <strong>add</strong> при добавлении элемента в пользу префикса <strong>insert</strong> и сделать кучу готовых методов, которым передаются только те параметры, которые реально жизненно необходимы.<br />
Например какой смысл передавать <strong>всегда</strong> в тот же элемент типа "fieldset" параметр $name, когда для него жизненно необходимым является только $label.<br />
Так "родился" метод
<pre>
    /**
    * @return Html_QuickForm_Container_Fieldset
    */
    function insertFieldset ($label){
        return $this->addElement('fieldset')->setLabel($label);
    }
</pre>
В итоге для практически всех элементов были созданы такие сборщики, что позволяет при наличии IDE вообще не заглядывать внутрь нативной библиотеки <strong>HTML_QuickForm2</strong>
<br /><br />
<h2>Правила валидации</h2>
Работа с правилами была так же дописана с учетом требований по автодополнению, были созданы сборщики правила, которые опять же безо всякой магии PHP, с возможностью автодополнения, позволяют оегко навешивать базовые правила проверки значений полей формы.<br />
Кастомные правила уже не входят в те самые 90% потребностей при работе с формами.
<br />
Сборщики правил были внесены в <strong>HTML_QuickForm2_Node</strong>
<br />
<br />
<h2>Рендерер</h2>
Наибольшей переработке, после контейнера, подвергся именно дефолтный рендерер.<br />
Оттуда были убраны правила валидации, которые автоматически вставлялись сразу после формы, а это автоматически вызывало необходимость добавления базового скрипта валидации <strong>quickforms.js</strong> перед формой, т.е. либо прямо в коде страницы, либо в секции "head".<br />
Но <a href="http://developer.yahoo.com/yslow/help/#guidelines">мы то знаем</a>, что по правилам клиентской оптимизации (вернее рекомендациям от специалистов Yahoo) CSS нужно располагать перед открывающимся "body", а JS - перед закрывающимся "body".<br />
<br /><br />
<h2>Замена базового обработчика ошибок</h2>
В классе jQuickForm был заменен базовый обработчик, который раньше просто выплевывал alert со всеми ошибками.
<pre>
qf.validator.prototype.oninvalid ...
</pre>
сейчас он делает div-обертку для элемента "ошибочным", выводит в нужном месте текст ошибки, выделяет поле с ошибкой красным бордером.
<br />
<br />
<h2>Пример заполнения</h2>
Еще одно важное дополнение, это возможность показать человеку, заполняющему форму что создатель формы ожидает получить от него.<br />
Добавили туда же фишку из Яндекс.Поиска, когда при клике на пример заполнения этот пример вставляется в поле.<br />
Доработали, чтобы при вставке примера заполнения для select-multiple, выделялись сразу несколько значений по разделителю запятая (см. <a href="/?page=elements_select">пример</a>)
<br />
<br />
