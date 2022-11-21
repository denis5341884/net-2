<?php
/**
 * Base class for simple HTML_QuickForm2 elements (not Containers)
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
 * @version    SVN: $Id: Element.php 303452 2010-09-17 08:17:43Z avb $
 * @link       http://pear.php.net/package/HTML_QuickForm2
 */

/**
 * Base class for all HTML_QuickForm2 elements
 */
require_once 'HTML/QuickForm2/Node.php';

/**
 * Abstract base class for simple QuickForm2 elements (not Containers)
 *
 * @category   HTML
 * @package    HTML_QuickForm2
 * @author     Alexey Borzov <avb@php.net>
 * @author     Bertrand Mansion <golgote@mamasam.com>
 * @version    Release: @package_version@
 */
abstract class HTML_QuickForm2_Element extends HTML_QuickForm2_Node
{
    public function setName($name)
    {
        $this->attributes['name'] = (string)$name;
        $this->updateValue();
        return $this;
    }

   /**
    * Generates hidden form field containing the element's value
    *
    * This is used to pass the frozen element's value if 'persistent freeze'
    * feature is on
    *
    * @return string
    */
    protected function getPersistentContent()
    {
        if (!$this->persistent || null === ($value = $this->getValue())) {
            return '';
        }
        return '<input type="hidden"' . self::getAttributesString(array(
            'name'  => $this->getName(),
            'value' => $value,
            'id'    => $this->getId()
        )) . ' />';
    }

   /**
    * Called when the element needs to update its value from form's data sources
    *
    * The default behaviour is to go through the complete list of the data
    * sources until the non-null value is found.
    */
    protected function updateValue()
    {
        $name = $this->getName();
        foreach ($this->getDataSources() as $ds) {
            if (null !== ($value = $ds->getValue($name))) {
                $this->setValue($value);
                return;
            }
        }
    }

   /**
    * Renders the element using the given renderer
    *
    * @param    HTML_QuickForm2_Renderer    Renderer instance
    * @return   HTML_QuickForm2_Renderer
    */
    public function render(HTML_QuickForm2_Renderer $renderer)
    {
        foreach ($this->rules as $rule) {
            if ($rule[1] & HTML_QuickForm2_Rule::CLIENT) {
                $renderer->getJavascriptBuilder()->addRule($rule[0]);
            }
        }
        $renderer->renderElement($this);
        return $renderer;
    }

   /**
    * Returns Javascript code for getting the element's value
    *
    * @return   string
    */
    public function getJavascriptValue()
    {
        return "qf.form.getValue('" . $this->getId() . "')";
    }






    function autocompleteMultipleScripts(){
        Jaguar::js()->addJsInline('
    function jqf_autocomplete_multiple_split( val ) {
    	return val.split( /,\s*/ );
    }
    function jqf_autocomplete_multiple_extractlast( term ) {
    	return jqf_autocomplete_multiple_split( term ).pop();
    }','jqf_autocomplete_multiple');
    }


    function jqfMask($mask,$placeholder=null){
        Jaguar::js()->needJqueryMask();
        $id = $this->getId();
        Jaguar::js()->addJsOnload('jQuery("#'.$id.'").mask("'.$mask.'"'.((!is_null($placeholder)) ? ',{placeholder:"'.$placeholder.'"}':'').');');
    }


    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function autocompleteMultipleArray($options, $minlen=1){
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('
		jQuery( "#'.$this->getId().'" ).autocomplete({
			minLength: '.$minlen.',
			source: function( request, response ) {
				// delegate back to autocomplete, but extract the last term
				response( jQuery.ui.autocomplete.filter(
					'.json_encode($options).', jqf_autocomplete_multiple_extractlast( request.term ) ) );
			},
			focus: function() {
				// prevent value inserted on focus
				return false;
			},
			select: function( event, ui ) {
				var terms = jqf_autocomplete_multiple_split( this.value );
				// remove the current input
				terms.pop();
				// add the selected item
				terms.push( ui.item.value );
				// add placeholder to get the comma-and-space at the end
				terms.push( "" );
				this.value = terms.join( ", " );
				return false;
			}
		});
        ');
        $this->autocompleteMultipleScripts();

        return $this;
    }



    /**
     * @return HTML_QuickForm2_Element
     */
    function autocompleteOneArray($options, $minlen=1){
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('
            jQuery( "#'.$this->getId().'" ).autocomplete({ minLength: '.$minlen.', source: '.json_encode($options).' });
        ');
        return $this;
    }



    /**
     * @return HTML_QuickForm2_Element
     */
    function autocompleteMultipleRemote($url, $minlen=1){
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('
		jQuery( "#'.$this->getId().'" ).autocomplete({
			minLength: '.$minlen.',
			source: function( request, response ) {
				jQuery.getJSON( "'.$url.'", {
					term: jqf_autocomplete_multiple_extractlast( request.term )
				}, response );
			},
			focus: function() {
				// prevent value inserted on focus
				return false;
			},
			select: function( event, ui ) {
				var terms = jqf_autocomplete_multiple_split( this.value );
				// remove the current input
				terms.pop();
				// add the selected item
				terms.push( ui.item.value );
				// add placeholder to get the comma-and-space at the end
				terms.push( "" );
				this.value = terms.join( ", " );
				return false;
			}
		});
        ');
        $this->autocompleteMultipleScripts();

        return $this;
    }



    /**
     * @return HTML_QuickForm2_Element_InputText
     */
    function autocompleteOneRemote($url, $minlen=1){
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('
    jQuery( "#'.$this->getId().'" ).autocomplete({
        source: "'.$url.'"
    });
        ');
        return $this;
    }

   /**
    * proxy
    * @return   HTML_QuickForm2_Element_Textarea
    */
    public function setComment($comment)
    {
        return parent::setComment($comment);
    }

}
?>
