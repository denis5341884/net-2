Тут все просто:<br />
Все скрипты разделены на внешние подключаемые, inline  и те, которые должны выполниться по событию onload.<br />
Соответственно, используется следующим образом:
<br />

<span style="color: #0000BB">&lt;?
<br /></span><span style="color: #FF8000">//###########################################
<br />//&nbsp;JS

<br />//###########################################
<br />//добавляет&nbsp;внешний&nbsp;подключаемый&nbsp;js-файл.
<br />//важно&nbsp;то,&nbsp;что&nbsp;если&nbsp;такие&nbsp;подключения&nbsp;будут&nbsp;делаться,
<br />//например,&nbsp;в&nbsp;цикле,&nbsp;то&nbsp;все&nbsp;равно&nbsp;в&nbsp;итоге&nbsp;будет&nbsp;он&nbsp;подключен&nbsp;всего&nbsp;один&nbsp;раз

<br /></span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">js</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">addJs</span><span style="color: #007700">(</span><span style="color: #DD0000">'/script.js'</span><span style="color: #007700">);
<br />
<br />
<br />
<br /></span><span style="color: #FF8000">//###########################################
<br />//&nbsp;JS&nbsp;INLINE
<br />//###########################################
<br />/*

<br />тут&nbsp;все&nbsp;понятно&nbsp;-&nbsp;это&nbsp;inline-js,&nbsp;в&nbsp;итоге&nbsp;получится
<br />&lt;script&nbsp;language="JavaScript"&nbsp;type="text/javascript"&gt;
<br />&nbsp;&nbsp;&nbsp;&nbsp;alert(123);
<br />&lt;/script&gt;
<br />*/

<br /></span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">js</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">addJsInline</span><span style="color: #007700">(</span><span style="color: #DD0000">'alert(123);'</span><span style="color: #007700">);
<br />
<br /></span><span style="color: #FF8000">//###########################################
<br />//&nbsp;JS&nbsp;ONLOAD
<br />//###########################################
<br />/*
<br />а&nbsp;тут&nbsp;уже&nbsp;интереснее,&nbsp;делаем:

<br />*/
<br /></span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">js</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">addJsOnload</span><span style="color: #007700">(</span><span style="color: #DD0000">'alert(123);'</span><span style="color: #007700">);
<br /></span><span style="color: #FF8000">/*
<br />в&nbsp;итоге&nbsp;получится:
<br />&lt;script&nbsp;language="JavaScript"&nbsp;type="text/javascript"&gt;

<br />&nbsp;&nbsp;&nbsp;&nbsp;jQuery(document).ready(
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;function(){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alert(123);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;);
<br />&lt;/script&gt;
<br />*/
<br />
<br />//важное&nbsp;дополнение:
<br />//если&nbsp;выводить&nbsp;список&nbsp;строк,&nbsp;в&nbsp;которых&nbsp;есть&nbsp;элемент

<br />//с&nbsp;классом,&nbsp;на&nbsp;который&nbsp;навешивается&nbsp;обработчик&nbsp;события,
<br />//например&nbsp;"onclick"&nbsp;и&nbsp;вы&nbsp;хотите,&nbsp;чтобы&nbsp;он&nbsp;навешивался&nbsp;всего&nbsp;один&nbsp;раз,

<br />//то&nbsp;нужно&nbsp;указать&nbsp;любой&nbsp;уникальный&nbsp;идентификатор&nbsp;навешиваемого&nbsp;обработчика
<br /></span><span style="color: #007700">for&nbsp;(</span><span style="color: #0000BB">$i</span><span style="color: #007700">=</span><span style="color: #0000BB">0</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">&lt;</span><span style="color: #0000BB">10</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++){

<br />&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #DD0000">'&lt;div&nbsp;class="class_element"&gt;Строка&nbsp;№'</span><span style="color: #007700">.</span><span style="color: #0000BB">$i</span><span style="color: #007700">.</span><span style="color: #DD0000">'&lt;/div&gt;'</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">Jaguar</span><span style="color: #007700">::</span><span style="color: #0000BB">js</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">addJsOnload</span><span style="color: #007700">(</span><span style="color: #DD0000">'jQuery(".class_element").click(function(){

<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jQuery(this).text("clicked");
<br />&nbsp;&nbsp;&nbsp;&nbsp;});'</span><span style="color: #007700">,
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">'class_element_onclick'</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//где&nbsp;'class_element_onclick'&nbsp;и&nbsp;есть&nbsp;тот&nbsp;самый
<br />&nbsp;&nbsp;&nbsp;&nbsp;//уникальный&nbsp;идентификатор&nbsp;обработчика&nbsp;события
<br /></span><span style="color: #007700">}
<br /></span><span style="color: #FF8000">/*

<br />в&nbsp;итоге&nbsp;получится:
<br />&lt;script&nbsp;language="JavaScript"&nbsp;type="text/javascript"&gt;
<br />&nbsp;&nbsp;&nbsp;&nbsp;jQuery(document).ready(
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;function(){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jQuery(".class_element").click(function(){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jQuery(this).text("clicked");
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;);
<br />&lt;/script&gt;
<br />*/

<br /></span><span style="color: #0000BB">?&gt;</span>
</span>
</code>