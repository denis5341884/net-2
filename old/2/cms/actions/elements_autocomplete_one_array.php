<?
    $form = new jQuickForm('simple');
    $fieldset1 = $form->insertFieldset('Пример использования single autocomplete с array-source');

        $fieldset1->insertInputText('text')->autocompleteOneArray(
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