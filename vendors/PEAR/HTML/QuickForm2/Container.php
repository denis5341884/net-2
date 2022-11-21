<?php
/**
 * Base class for simple HTML_QuickForm2 containers
 *
 * PHP version 5
 *
 * LICENSE:
 *
 * Copyright (c) 2006-2010, Alexey Borzov <avb@php.net>,
 *                          Bertrand Mansion <golgote@mamasam.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and/or other materials provided with the distribution.
 *    * The names of the authors may not be used to endorse or promote products
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   HTML
 * @package    HTML_QuickForm2
 * @author     Alexey Borzov <avb@php.net>
 * @author     Bertrand Mansion <golgote@mamasam.com>
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    SVN: $Id: Container.php 303328 2010-09-13 16:36:34Z avb $
 * @link       http://pear.php.net/package/HTML_QuickForm2
 */

/**
 * Base class for all HTML_QuickForm2 elements
 */
require_once 'HTML/QuickForm2/Node.php';

/**
 * Abstract base class for simple QuickForm2 containers
 *
 * @category   HTML
 * @package    HTML_QuickForm2
 * @author     Alexey Borzov <avb@php.net>
 * @author     Bertrand Mansion <golgote@mamasam.com>
 * @version    Release: @package_version@
 */
abstract class HTML_QuickForm2_Container extends HTML_QuickForm2_Node
    implements IteratorAggregate, Countable
{
   /**
    * Array of elements contained in this container
    * @var array
    */
    protected $elements = array();


    public function setName($name)
    {
        $this->attributes['name'] = (string)$name;
        return $this;
    }

    public function toggleFrozen($freeze = null)
    {
        if (null !== $freeze) {
            foreach ($this as $child) {
                $child->toggleFrozen($freeze);
            }
        }
        return parent::toggleFrozen($freeze);
    }

    public function persistentFreeze($persistent = null)
    {
        if (null !== $persistent) {
            foreach ($this as $child) {
                $child->persistentFreeze($persistent);
            }
        }
        return parent::persistentFreeze($persistent);
    }

   /**
    * Whether container prepends its name to names of contained elements
    *
    * @return   bool
    */
    protected function prependsName()
    {
        return false;
    }

   /**
    * Returns the element's value
    *
    * The default implementation for Containers is to return an array with
    * contained elements' values. The array is indexed the same way $_GET and
    * $_POST arrays would be for these elements.
    *
    * @return   array|null
    */
    public function getValue()
    {
        $values = array();
        foreach ($this as $child) {
            $value = $child->getValue();
            if (null !== $value) {
                if ($child instanceof HTML_QuickForm2_Container
                    && !$child->prependsName()
                ) {
                    $values = self::arrayMerge($values, $value);
                } else {
                    $name = $child->getName();
                    if (!strpos($name, '[')) {
                        $values[$name] = $value;
                    } else {
                        $tokens   =  explode('[', str_replace(']', '', $name));
                        $valueAry =& $values;
                        do {
                            $token = array_shift($tokens);
                            if (!isset($valueAry[$token])) {
                                $valueAry[$token] = array();
                            }
                            $valueAry =& $valueAry[$token];
                        } while (count($tokens) > 1);
                        $valueAry[$tokens[0]] = $value;
                    }
                }
            }
        }
        return empty($values)? null: $this->applyFilters($values);
    }

   /**
    * Merges two arrays
    *
    * Merges two arrays like the PHP function array_merge_recursive does,
    * the difference being that existing integer keys will not be renumbered.
    *
    * @param    array
    * @param    array
    * @return   array   resulting array
    */
    protected static function arrayMerge($a, $b)
    {
        foreach ($b as $k => $v) {
            if (!is_array($v) || isset($a[$k]) && !is_array($a[$k])) {
                $a[$k] = $v;
            } else {
                $a[$k] = self::arrayMerge(isset($a[$k])? $a[$k]: array(), $v);
            }
        }
        return $a;
    }

   /**
    * Returns an array of this container's elements
    *
    * @return   array   Container elements
    */
    public function getElements()
    {
        return $this->elements;
    }

   /**
    * Appends an element to the container
    *
    * If the element was previously added to the container or to another
    * container, it is first removed there.
    *
    * @param    HTML_QuickForm2_Node     Element to add
    * @return   HTML_QuickForm2_Node     Added element
    * @throws   HTML_QuickForm2_InvalidArgumentException
    */
    public function appendChild(HTML_QuickForm2_Node $element)
    {
        if ($this === $element->getContainer()) {
            $this->removeChild($element);
        }
        $element->setContainer($this);
        $this->elements[] = $element;
        return $element;
    }

   /**
    * Appends an element to the container (possibly creating it first)
    *
    * If the first parameter is an instance of HTML_QuickForm2_Node then all
    * other parameters are ignored and the method just calls {@link appendChild()}.
    * In the other case the element is first created via
    * {@link HTML_QuickForm2_Factory::createElement()} and then added via the
    * same method. This is a convenience method to reduce typing and ease
    * porting from HTML_QuickForm.
    *
    * @param    string|HTML_QuickForm2_Node  Either type name (treated
    *               case-insensitively) or an element instance
    * @param    mixed   Element name
    * @param    mixed   Element attributes
    * @param    array   Element-specific data
    * @return   HTML_QuickForm2_Node     Added element
    * @throws   HTML_QuickForm2_InvalidArgumentException
    * @throws   HTML_QuickForm2_NotFoundException
    */
    public function addElement($elementOrType, $name = null, $attributes = null,
                               array $data = array())
    {
        if ($elementOrType instanceof HTML_QuickForm2_Node) {
            return $this->appendChild($elementOrType);
        } else {
            return $this->appendChild(HTML_QuickForm2_Factory::createElement(
                $elementOrType, $name, $attributes, $data
            ));
        }
    }

   /**
    * Removes the element from this container
    *
    * If the reference object is not given, the element will be appended.
    *
    * @param    HTML_QuickForm2_Node     Element to remove
    * @return   HTML_QuickForm2_Node     Removed object
    */
    public function removeChild(HTML_QuickForm2_Node $element)
    {

        if ($element->getContainer() !== $this) {
            throw new HTML_QuickForm2_NotFoundException(
                "Element with name '".$element->getName()."' was not found"
            );
        }
        foreach ($this as $key => $child){
            if ($child === $element) {
                unset($this->elements[$key]);
                $element->setContainer(null);
                break;
            }
        }
        return $element;
    }


   /**
    * Returns an element if its id is found
    *
    * @param    string  Element id to find
    * @return   HTML_QuickForm2_Node|null
    */
    public function getElementById($id)
    {
        foreach ($this->getRecursiveIterator() as $element) {
            if ($id == $element->getId()) {
                return $element;
            }
        }
        return null;
    }

   /**
    * Returns an array of elements which name corresponds to element
    *
    * @param    string  Elements name to find
    * @return   array
    */
    public function getElementsByName($name)
    {
        $found = array();
        foreach ($this->getRecursiveIterator() as $element) {
            if ($element->getName() == $name) {
                $found[] = $element;
            }
        }
        return $found;
    }

   /**
    * Inserts an element in the container
    *
    * If the reference object is not given, the element will be appended.
    *
    * @param    HTML_QuickForm2_Node     Element to insert
    * @param    HTML_QuickForm2_Node     Reference to insert before
    * @return   HTML_QuickForm2_Node     Inserted element
    */
    public function insertBefore(HTML_QuickForm2_Node $element, HTML_QuickForm2_Node $reference = null)
    {
        if (null === $reference) {
            return $this->appendChild($element);
        }
        $offset = 0;
        foreach ($this as $child) {
            if ($child === $reference) {
                if ($this === $element->getContainer()) {
                    $this->removeChild($element);
                }
                $element->setContainer($this);
                array_splice($this->elements, $offset, 0, array($element));
                return $element;
            }
            $offset++;
        }
        throw new HTML_QuickForm2_NotFoundException(
            "Reference element with name '".$reference->getName()."' was not found"
        );
    }

   /**
    * Returns a recursive iterator for the container elements
    *
    * @return    HTML_QuickForm2_ContainerIterator
    */
    public function getIterator()
    {
        return new HTML_QuickForm2_ContainerIterator($this);
    }

   /**
    * Returns a recursive iterator iterator for the container elements
    *
    * @param    int     mode passed to RecursiveIteratorIterator
    * @return   RecursiveIteratorIterator
    */
    public function getRecursiveIterator($mode = RecursiveIteratorIterator::SELF_FIRST)
    {
        return new RecursiveIteratorIterator(
                        new HTML_QuickForm2_ContainerIterator($this), $mode
                   );
    }

   /**
    * Returns the number of elements in the container
    *
    * @return    int
    */
    public function count()
    {
        return count($this->elements);
    }

   /**
    * Called when the element needs to update its value from form's data sources
    *
    * The default behaviour is just to call the updateValue() methods of
    * contained elements, since default Container doesn't have any value itself
    */
    protected function updateValue()
    {
        foreach ($this as $child) {
            $child->updateValue();
        }
    }


   /**
    * Performs the server-side validation
    *
    * This method also calls validate() on all contained elements.
    *
    * @return   boolean Whether the container and all contained elements are valid
    */
    protected function validate()
    {
        $valid = true;
        foreach ($this as $child) {
            $valid = $child->validate() && $valid;
        }
        $valid = parent::validate() && $valid;
        return $valid;
    }

   /**
    * Appends an element to the container, creating it first
    *
    * The element will be created via {@link HTML_QuickForm2_Factory::createElement()}
    * and then added via the {@link appendChild()} method.
    * The element type is deduced from the method name.
    * This is a convenience method to reduce typing.
    *
    * @param    mixed   Element name
    * @param    mixed   Element attributes
    * @param    array   Element-specific data
    * @return   HTML_QuickForm2_Node     Added element
    * @throws   HTML_QuickForm2_InvalidArgumentException
    * @throws   HTML_QuickForm2_NotFoundException
    */
    public function __call($m, $a)
    {
        if (preg_match('/^(add)([a-zA-Z0-9_]+)$/', $m, $match)) {
            if ($match[1] == 'add') {
                $type = strtolower($match[2]);
                $name = isset($a[0]) ? $a[0] : null;
                $attr = isset($a[1]) ? $a[1] : null;
                $data = isset($a[2]) ? $a[2] : array();
                return $this->addElement($type, $name, $attr, $data);
            }
        }
        trigger_error("Fatal error: Call to undefined method ".get_class($this)."::".$m."()", E_USER_ERROR);
    }

   /**
    * Renders the container using the given renderer
    *
    * @param    HTML_QuickForm2_Renderer    Renderer instance
    * @return   HTML_QuickForm2_Renderer
    */
    public function render(HTML_QuickForm2_Renderer $renderer)
    {
        $renderer->startContainer($this);
        foreach ($this as $element) {
            $element->render($renderer);
        }
        foreach ($this->rules as $rule) {
            if ($rule[1] & HTML_QuickForm2_Rule::CLIENT) {
                $renderer->getJavascriptBuilder()->addRule($rule[0]);
            }
        }
        $renderer->finishContainer($this);
        return $renderer;
    }

    public function __toString()
    {
        require_once 'HTML/QuickForm2/Renderer.php';

        return $this->render(HTML_QuickForm2_Renderer::factory('default'))->__toString();
    }

   /**
    * Returns Javascript code for getting the element's value
    *
    * @return   string
    */
    public function getJavascriptValue()
    {
        $args = array();
        foreach ($this as $child) {
            if ($child instanceof HTML_QuickForm2_Container) {
                $args[] = $child->getJavascriptValue();
            } else {
                $args[] = "'" . $child->getId() . "'";
            }
        }
        return 'qf.form.getContainerValue(' . implode(', ', $args) . ')';
    }


    /*
    ----------------------------------------------------------------------------------------------
    Добавлено для jQuickForm
    ----------------------------------------------------------------------------------------------
    */

    /**
     * @return HTML_QuickForm2_Container_Group
     */
    function insertGroup($name=null){
        return $this->addElement('group',$name)->addClass('jqf_group');
    }



    /**
     * @return HTML_QuickForm2_Container_Group
     */
    function insertGroupClear($name=null){
        $gr = new jQuickForm_GroupClear($name);
        return $this->addElement($gr);
    }



    /**
     * @return HTML_QuickForm2_Container_Group
     */
    function insertGroupPageButtons(){
        $gr = new jQuickForm_GroupClear();
        $gr->addClass('jqf_page_buttons');
        return $this->addElement($gr);
    }
    function insertGroupPageButtonNext($text='следующая →'){
        return $this->insertInputButton($text)->addClass('jqf_page_next');
    }
    function insertGroupPageButtonPrev($text='← предыдущая'){
        return $this->insertInputButton($text)->addClass('jqf_page_prev');
    }

    /**
     * @return HTML_QuickForm2_Container_Group
     */
    function insertGroupPage($is_curent=false){
        $gr = new jQuickForm_GroupClear();
        $gr->addClass('jqf_page');
        if($is_curent){
            $gr->addClass('jqf_page_current');
        }
        Jaguar::js()->addJsOnload('
    jQuery(".jqf_page").hide();
    jQuery(".jqf_page_current").show();
    jQuery(".jqf_page_prev").show();
    jQuery(".jqf_page_next").show();
    jQuery(".jqf_page_next").click(function(){
        jQuery(this).parent().parent().parent().hide();
        jQuery(this).parent().parent().parent().next().show();
    });
    jQuery(".jqf_page_prev").click(function(){
        jQuery(this).parent().parent().parent().hide();
        jQuery(this).parent().parent().parent().prev().show();
    });
        ','jqf_page_buttons');

        return $this->addElement($gr);
    }



    /**
     * @return jQuickForm_GroupClear
     */
    function insertGroupSubmit(){
        return $this->insertGroupClear()->addClass('jqf_submits');
    }



    /**
     * @return HTML_QuickForm2_Element_Textarea
     */
    function insertJwysiwyg($name){
        $textarea = $this->insertTextArea($name);
        Jaguar::js()->addJsOnload(
'
jQuery("#'.$textarea->getId().'").wysiwyg({
    controls: {
      strikeThrough : { visible : true },
      underline     : { visible : true },

      separator00 : { visible : true },

      justifyLeft   : { visible : true },
      justifyCenter : { visible : true },
      justifyRight  : { visible : true },
      justifyFull   : { visible : true },

      separator01 : { visible : true },

      indent  : { visible : true },
      outdent : { visible : true },

      separator02 : { visible : true },

      subscript   : { visible : true },
      superscript : { visible : true },

      separator03 : { visible : true },

      undo : { visible : true },
      redo : { visible : true },

      separator04 : { visible : true },

      insertOrderedList    : { visible : true },
      insertUnorderedList  : { visible : true },
      insertHorizontalRule : { visible : true },

      h4mozilla : { visible : true && $.browser.mozilla, className : \'h4\', command : \'heading\', arguments : [\'h4\'], tags : [\'h4\'], tooltip : "Header 4" },
      h5mozilla : { visible : true && $.browser.mozilla, className : \'h5\', command : \'heading\', arguments : [\'h5\'], tags : [\'h5\'], tooltip : "Header 5" },
      h6mozilla : { visible : true && $.browser.mozilla, className : \'h6\', command : \'heading\', arguments : [\'h6\'], tags : [\'h6\'], tooltip : "Header 6" },

      h4 : { visible : true && !( $.browser.mozilla ), className : \'h4\', command : \'formatBlock\', arguments : [\'<H4>\'], tags : [\'h4\'], tooltip : "Header 4" },
      h5 : { visible : true && !( $.browser.mozilla ), className : \'h5\', command : \'formatBlock\', arguments : [\'<H5>\'], tags : [\'h5\'], tooltip : "Header 5" },
      h6 : { visible : true && !( $.browser.mozilla ), className : \'h6\', command : \'formatBlock\', arguments : [\'<H6>\'], tags : [\'h6\'], tooltip : "Header 6" },

      separator07 : { visible : true },

      cut   : { visible : true },
      copy  : { visible : true },
      paste : { visible : true }
    }
  });
'
        );
        Jaguar::js()->addJs('/vendors/jquery/jwysiwyg/jquery.wysiwyg.js');
        Jaguar::css()->addCss('/vendors/jquery/jwysiwyg/jquery.wysiwyg.css');

        return $textarea;
    }



    /**
     * @return HTML_QuickForm2_Container_Fieldset
     */
    function insertFieldset($label){
        return $this->addElement('fieldset')->setLabel($label);
    }



    /**
     * @return HTML_QuickForm2_Element_Button
     */
    function insertButton($name, $value){
        return $this->addElement('button',$name)->setContent($value);
    }



    /**
     * @return HTML_QuickForm2_Element_InputButton
     */
    function insertInputButton($value, $name=null){
        return $this->addElement('inputbutton',$name, array('value'=>$value));
    }



    /**
     * @return HTML_QuickForm2_Element_InputCheckbox
     */
    function insertInputCheckbox($value, $label, $name=null){
        return $this->addElement('checkbox',$name)->setLabel($label)->setValue($value);
    }



    /**
     * @return HTML_QuickForm2_Element_InputSubmit
     */
    function insertInputSubmit($value, $name=null){
        return $this->addElement('submit',$name, array('value'=>$value));
    }


    /**
     * @return HTML_QuickForm2_Element_Textarea
     */
    function insertTextArea($name){
        return $this->addElement('textarea',$name);
    }



    /**
     * @return HTML_QuickForm2_Element_Static
     */
    function insertStatic($content){
        return $this->addElement('static')->setContent($content);
    }



    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function insertInputText($name){
        return $this->addElement('text',$name);
    }



    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function insertMultiUpload($name, $url_upload, $post_params = array(), $limit_size_one=100, $limit_count_all=100,$limit_count_queue=10, $file_types='*.jpg;*.gif;*.png'){
        if(!isset($post_params[session_name()])){
            $post_params[session_name()] = session_id();
        }
        $uploader = new jQuickForm_SwfUpload($name);
        $uploader->setId($name);
        /*
<script type="text/javascript" src="http://sokol45.ru/swfupload/swfupload.js"></script>
<script type="text/javascript" src="http://sokol45.ru/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="http://sokol45.ru/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="http://sokol45.ru/swfupload/handlers.js"></script>
<script type="text/javascript" src="/js/js.admin.js"></script>
<link href="http://sokol45.ru/swfupload/default.css" rel="stylesheet" type="text/css" />


        */
        Jaguar::js()->addJs('/vendors/swfupload/swfupload.js');
        Jaguar::js()->addJs('/vendors/swfupload/swfupload.queue.js');
        Jaguar::js()->addJs('/vendors/swfupload/fileprogress.js');
        Jaguar::js()->addJs('/vendors/swfupload/handlers.js');
        Jaguar::css()->addCss('/vendors/swfupload/default.css');
        Jaguar::js()->addJsOnload('
    var jqf_swf_'.$uploader->getId().';
    '.$uploader->getId().' = new SWFUpload({
        // Backend Settings
        upload_url: "'.$url_upload.'",
        '.(count($post_params) ? 'post_params: '.json_encode($post_params).',':'').'
        file_size_limit: "'.$limit_size_one.'",
        file_types: "'.$file_types.'",
        file_types_description: "Выберите файл",
        file_upload_limit: "'.$limit_count_all.'",
        file_queue_limit: "'.$limit_count_queue.'",
        file_dialog_start_handler: fileDialogStart,
        file_queued_handler: fileQueued,
        file_queue_error_handler: fileQueueError,
        file_dialog_complete_handler: fileDialogComplete,
        upload_start_handler: uploadStart,
        upload_progress_handler: uploadProgress,
        upload_error_handler: uploadError,
        upload_success_handler: uploadSuccess_'.$uploader->getId().',
        upload_complete_handler: uploadComplete,
        button_image_url: "/vendors/swfupload/button1.png",
        button_placeholder_id: "swf_placeholder_'.$uploader->getId().'",
        button_width: 70,
        button_height: 22,

        // Flash Settings
        flash_url: "/vendors/swfupload/flash/swfupload.swf",

        custom_settings: {
            progressTarget: "swf_progress_'.$uploader->getId().'",
            cancelButtonId: "swf_cancel_'.$uploader->getId().'",
            upload_target: "swf_divFileProgressContainer"
        },

        // Debug Settings
        debug: true
    });
    jQuery("#swf_cancel_'.$uploader->getId().'").click(function(){
        cancelQueue(jqf_swf_'.$uploader->getId().');
    });
');
        Jaguar::js()->addJsInline('
function uploadSuccess_'.$uploader->getId().'(file, serverData) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Wait...");
		jQuery("#swf_thumbnails_'.$uploader->getId().'").prepend(serverData);
		progress.setComplete();
		progress.setStatus("Завершено.");
		progress.toggleCancel(false);

	} catch (ex) {
		this.debug(ex);
	}
}

        ');
        return $this->addElement($uploader);
    }

    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function insertSliderRange($name, $min=0, $max=500, $step=1, $values=null){
        $gr  = new jQuickForm_SliderRange($name);
        $gr->range_max = $max;
        $gr->range_min = $min;
        $gr->range_step = $step;
        $gr = $this->addElement($gr);
            $_min = $gr->addElement('text','min')->setAttribute('size','3')->setId($name.'_min')->addFilter('floatval');
            $_max = $gr->addElement('text','max')->setAttribute('size','3')->setId($name.'_max')->addFilter('floatval');
//        jaguar_debug($_max,'$_max');exit;
        $gr->setSeparator(' до ');
        return $gr;
    }
    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function insertSlider($name, $min=0, $max=500, $step=1){
        $el = new jQuickForm_Slider($name);
        $val = (isset($_REQUEST[$name])) ? floatval($_REQUEST[$name]) : $min;
//        jaguar_debug($val);
        Jaguar::js()->needJquery();
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('
    jQuery("#'.$el->getId().'").change(function(){
        jQuery("#'.$el->getId().'_jqfslider").slider( "value" , jQuery(this).val() );
    });
    jQuery("#'.$el->getId().'_jqfslider").slider({
		min: '.$min.',
		max: '.$max.',
		step: '.$step.',
		value: '.$val.',
		slide: function(event, ui) {
			jQuery("#'.$el->getId().'").val(ui.value);
		},
		change: function(event, ui) {
			jQuery("#'.$el->getId().'").val(ui.value);
		}
	});
');

        return $this->addElement($el)->setComment('Значение')->setAttribute('size',3)->setValue($val);
    }



    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function insertInputPassword($name){
        return $this->addElement('password',$name);
    }



    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function insertDatePicker($name, $format='yy-mm-dd'){
        $el = $this->insertInputText($name)->addClass('datepicker');
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('jQuery("#'.$el->getId().'").datepicker(
        {
            changeMonth: true,
            changeYear: true,
            dateFormat: \''.$format.'\',
            monthNames: [\'Январь\', \'Февраль\', \'Март\', \'Апрель\', \'Май\', \'Июнь\', \'Июль\', \'Август\', \'Сентябрь\', \'Октябрь\', \'Ноябрь\', \'Декабрь\'],
            monthNamesShort: [\'Янв\', \'Фев\', \'Мар\', \'Апр\', \'Май\', \'Июн\', \'Июл\', \'Авг\', \'Сен\', \'Окт\', \'Ноя\', \'Дек\'],
            numberOfMonths: 2
        }
        );');
        return $el;
    }



    /**
     * @return HTML_QuickForm2_Element_Date
     */
    function insertDate($name,$format='ymd',$language='ru',$max_year=null,$min_year=null,$use_empty=false,$inc_minute=1,$inc_second=1){
        if(!$max_year) $max_year = date('Y')+10;
        if(!$min_year) $min_year = date('Y')-10;
        if(!$language) $language = 'ru';
        $data = array(
        'language'           => $language,
        'format'           => $format,
        'minYear'          => $min_year,
        'maxYear'          => $max_year,
        'addEmptyOption'   => $use_empty,
        'optionIncrement'  => array('i' => $inc_minute, 's' => $inc_second)
        );
        return $this->addElement('date',$name, null, $data)->addClass('jqf_date jqf_row');
    }



    /**
     * @return HTML_QuickForm2_Element_Select
     */
    function insertSelect($name){
        return $this->addElement('select',$name);
    }



    /**
    * proxy
    * @return   HTML_QuickForm2_Container
    */
    public function addClass($class){
        return parent::addClass($class);
    }




   /**
    * proxy
    * @return   HTML_QuickForm2_Container
    */
    public function setLabel($label){
        return parent::setLabel($label);
    }



   /**
    * @return   HTML_QuickForm2_Container
    */
    public function setComment($comment)
    {
        return parent::setComment($comment);
    }


    /**
     * Установить маску для поля по его идентификатору
     *
     * use: $container->jqfMask('phone','(999) 999-9999');
     *
     * use: $container->jqfMask('phone','(999) 999-9999','Телефон');
     *
     * use: $container->jqfMaskDefinition('~','+-');
     *      $container->jqfMask('code','~9.99 ~9.99 999');
     *
     * @param string $id
     * @param string $mask
     */
    function jqfMask($name, $mask,$placeholder=null){
        $elements = $this->getElementsByName($name);
        foreach ($elements as $e){
            $e->jqfMask($mask,$placeholder);
        }
    }


}

/**
 * Implements a recursive iterator for the container elements
 *
 * @category   HTML
 * @package    HTML_QuickForm2
 * @author     Alexey Borzov <avb@php.net>
 * @author     Bertrand Mansion <golgote@mamasam.com>
 * @version    Release: @package_version@
 */
class HTML_QuickForm2_ContainerIterator extends RecursiveArrayIterator implements RecursiveIterator
{
    public function __construct(HTML_QuickForm2_Container $container)
    {
        parent::__construct($container->getElements());
    }

    public function hasChildren()
    {
        return $this->current() instanceof HTML_QuickForm2_Container;
    }

    public function getChildren()
    {
        return new HTML_QuickForm2_ContainerIterator($this->current());
    }
}

?>