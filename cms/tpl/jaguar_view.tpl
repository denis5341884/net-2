Это даже не шаблонизатор, это всего лишь небольшое упрощение, которое позволило мне правильно собрать страницу, если помните YSlow рекомендует JS помещать перезакрывающимся "body", а CSS внутри "head".<br />
А самое главное - "отделить мух от котлет", чтобы показать всю красоту и простоту сборки форм с использованием jQuickForm.<br />
<br />

Также Jaguar_View имеет задачу собирать в переменные шаблона, которые генерируются в разных местах приложения, например содержимое переменной шаблона BODY собирается практически на протяжении всей работы скрипта.
<code><span style="color: #000000">
<span style="color: #0000BB">&lt;?<br /></span>
<span style="color: #FF8000">/*<br />в&nbsp;начале&nbsp;приложения&nbsp;инициализируем&nbsp;представление<br />*/<br /></span>

<span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">view</span><span style="color: #007700">(</span><span style="color: #0000BB">dirname</span><span style="color: #007700">(</span><span style="color: #0000BB">__FILE__</span><span style="color: #007700">).</span><span style="color: #DD0000">'/tpl/layout.tpl'</span><span style="color: #007700">);<br /></span><span style="color: #FF8000">/*<br />затем&nbsp;наполняем<br />*/<br /></span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">view</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">setVar</span><span style="color: #007700">(</span><span style="color: #DD0000">'body'</span><span style="color: #007700">,</span><span style="color: #DD0000">'1'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">view</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">setVar</span><span style="color: #007700">(</span><span style="color: #DD0000">'body'</span><span style="color: #007700">,</span><span style="color: #DD0000">'2'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">view</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">setVar</span><span style="color: #007700">(</span><span style="color: #DD0000">'body'</span><span style="color: #007700">,</span><span style="color: #DD0000">'3'</span><span style="color: #007700">);<br /></span><span style="color: #FF8000">/*<br />парсим&nbsp;и&nbsp;выводим<br />*/<br /></span><span style="color: #007700">print&nbsp;</span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">view</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">parse</span><span style="color: #007700">();<br /></span>
</span><span style="color: #0000BB">?&gt;</span>

</span>
</code>