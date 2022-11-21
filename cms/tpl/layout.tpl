<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <title>{title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="imagetoolbar" content="no" />
    <meta name="description" content="jQuickForm - удобнейший генератор форм с клиенской и серверной валидацией на основе jQuery и HTML_QuickForm2. Решение одной из важных головных болей для PHP-разработчика" />
    <meta name="keywords" content="jQuickForm, jQuery, jQuery UI, HTML_QuickForm2, form, php, css, html, генератор форм" />

{css}
{css_inline}
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>
<body>

    <div id="page">
    	<div class="page-layout">

    		<div class="container">
    			<a href="/" id="header"> Посвящается <br />
"ленивым <br />
PHP-программистам"</a>
    		</div><!-- container -->

    		<div class="container">
    			<div class="layout-box sidebar">
                    <div class="box">
                        <div class="a_center"><a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="/cms/orphus.gif" border="0" width="88" height="31" /></a></div>
                        {MENU}
                    </div>
    			</div><!-- layout-box -->

    			<div class="layout-box content">
                    <div class="box">
                    <h1>{h1}</h1>
			     		{body}
                    	<div class="facebook">
                    		<iframe src="http://www.facebook.com/plugins/like.php?href={PAGE}&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;"></iframe>
                    	</div>
    			    </div>
    			</div><!-- layout-box -->

    			<div class="cc"></div>
    		</div><!-- container -->

    		<div class="container" id="code">
    		    <div class="box">
                    {PHP_CODE}
                </div>
    		</div><!-- container -->

    		<div class="container" id="footer">
    		    <div class="layout-box">
					Генератор форм <strong>jQuickForm</strong> является бесплатным для любого использования и свободно распространяется при условии соблюдения и сохранения авторских прав.<br />
                    <div class="a_right">Сборка произведена в компании <a href="http://jaguarsoft.ru/">"ЯгуарСофт"</a></div>
    			</div>
    		</div><!-- container -->

    	</div><!-- page-layout -->

    </div><!-- #page -->
    {js}
    {js_inline}
    {js_onload}

</body>
</html>