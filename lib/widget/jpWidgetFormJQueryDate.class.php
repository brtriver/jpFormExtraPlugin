<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * jpWidgetFormJQueryDate represents a date widget rendered by JQuery UI.
 * 
 * <code>
 * $this->widgetSchema['expired_at'] = new jpWidgetFormJQueryDate();
 * </code>
 * 
 * This widget needs JQuery and JQuery UI to work.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Masao Maeda <brt.river@gmai.com>
 * @version    SVN: $Id: jpWidgetFormJQueryDate.class.php 16262 2009-03-12 14:02:33Z fabien $
 */
class jpWidgetFormJQueryDate extends sfWidgetFormJQueryDate
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * image:   The image path to represent the widget (false by default)
   *  * config:  A JavaScript array that configures the JQuery date widget
   *  * culture: The user culture
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {

    parent::configure($options, $attributes);
    $this->addOption('with_time', false);
    $this->addOption('time', array(
                                   'format_without_seconds' => '%hour%時%minute%分',
                                   'minutes' => array('00','10','20','30','40','50'),
                                   ));

    $this->setOption('culture', 'ja');
    $this->getOption('date_widget')->setOption('format', '%year%年%month%月%day%日');
    if ($this->getOption('config') === '{}') {
      $this->setOption('config', '{buttonText: "カレンダーで選択"}');
    }
  }
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return parent::render($name, $value, $attributes, $errors).<<<EOF
<script type="text/javascript">
jQuery(document).ready(function(){
  var  eleYear = ".ui-datepicker-year";
  jQuery(".ui-datepicker-trigger, div#ui-datepicker-div").click(function() {
    jQuery("span.jpYearSuffix").remove();
    jQuery(eleYear).after("<span class='jpYearSuffix'>年</span>");
  });
});
</script>
    &nbsp;&nbsp;
EOF
    .(($this->getOption('with_time'))? $this->getTimeWidget($attributes)->render($name, $value): "");
;
  }
  protected function getTimeWidget($attributes = array())
  {
    return new sfWidgetFormTime($this->getOptionsFor('time'), $this->getAttributesFor('time', $attributes));
  }
  protected function getOptionsFor($type)
  {
    $options = $this->getOption($type);
    if (!is_array($options))
    {
      throw new InvalidArgumentException(sprintf('You must pass an array for the %s option.', $type));
    }

    return $options;
  }
  protected function renderValue(){
  }
  /**
   * Returns an array of HTML attributes for the given type.
   *
   * @param  string $type        The type (date or time)
   * @param  array  $attributes  An array of attributes
   *
   * @return array  An array of HTML attributes
   */
  protected function getAttributesFor($type, $attributes)
  {
    $defaults = isset($this->attributes[$type]) ? $this->attributes[$type] : array();

    return isset($attributes[$type]) ? array_merge($defaults, $attributes[$type]) : $defaults;
  }
  public function getStylesheets()
  {
    return array(
                 '/jpFormExtraPlugin/css/smoothness/jquery-ui-1.7.1.custom.css ' => 'all'
                 );
  }
  public function getJavaScripts()
  {
    return array(
                 '/jpFormExtraPlugin/js/jquery-1.3.2.min' => '/jpFormExtraPlugin/js/jquery/jquery-1.3.2.min',
                 '/jpFormExtraPlugin/js/jquery-ui-1.7.1.custom.min' => '/jpFormExtraPlugin/js/jquery/jquery-ui-1.7.1.custom.min',
                 '/jpFormExtraPlugin/js/jquery/ui/i18n/ui.datepicker-ja' => '/jpFormExtraPlugin/js/jquery/ui/i18n/ui.datepicker-ja'
                 );
  }
}
