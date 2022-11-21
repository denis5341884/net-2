<?
class jQuickForm_GroupCheckbox extends HTML_QuickForm2_Container_Group {
   /**
    * Returns Javascript code for getting the element's value
    *
    * @return   string
    */
    public function getJavascriptValue1()
    {
        $args = array();
        foreach ($this as $child) {
            if ($child instanceof HTML_QuickForm2_Container) {
                $args[] = $child->getJavascriptValue();
            } else {
                $args[] = "'" . $child->getId() . "'";
            }
        }
        return 'jQuery("input[name='.$this->getName().'[]]:checked")';
    }
}
?>