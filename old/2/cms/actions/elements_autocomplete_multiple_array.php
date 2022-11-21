<?
    $form = new jQuickForm('simple');
    $fieldset1 = $form->insertFieldset('Пример использования multiple autocomplete
    с array-source (textarea)');

        $fieldset1->insertTextArea('textarea')->autocompleteMultipleArray(
            array(
                "ActionScript",
    			"AppleScript",
    			"Asp",
    			"BASIC",
    			"C",
    			"C++",
    			"Clojure",
    			"COBOL",
    			"ColdFusion",
    			"Erlang",
    			"Fortran",
    			"Groovy",
    			"Haskell",
    			"Java",
    			"JavaScript",
    			"Lisp",
    			"Perl",
    			"PHP",
    			"Python",
    			"Ruby",
    			"Scala",
    			"Scheme"
            )
        )
        ->setCols(60)
        ->setLabel('Языки программирования')
        ->setExample('PHP')->setComment('Введите хотя бы один символ, например англ. "P"');



    $fieldset1 = $form->insertFieldset('Пример использования multiple autocomplete
    с array-source (input type=text)');

        $fieldset1->insertInputText('text')->autocompleteMultipleArray(
            array(
                "ActionScript",
    			"AppleScript",
    			"Asp",
    			"BASIC",
    			"C",
    			"C++",
    			"Clojure",
    			"COBOL",
    			"ColdFusion",
    			"Erlang",
    			"Fortran",
    			"Groovy",
    			"Haskell",
    			"Java",
    			"JavaScript",
    			"Lisp",
    			"Perl",
    			"PHP",
    			"Python",
    			"Ruby",
    			"Scala",
    			"Scheme"
            )
        )
        ->setLabel('Языки программирования')
        ->setExample('PHP')->setComment('Введите хотя бы один символ, например англ. "P"');
?>