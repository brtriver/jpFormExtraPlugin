<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * jpWidgetFormTextareaTinyMCE represents a Tiny MCE widget.
 *
 * <code>
 * $this->widgetSchema['detail'] = new jpWidgetFormTextareaTinyMCE();
 * </code>
 * You must include the Tiny MCE JavaScript file by yourself.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Masao Maeda <brt.river@gmail.com>
 * @version    SVN: $Id: jpWidgetFormTextareaTinyMCE.class.php 11894 2008-10-01 16:36:53Z fabien $
 */
class jpWidgetFormTextareaTinyMCE extends sfWidgetFormTextareaTinyMCE
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * theme:  The Tiny MCE theme
   *  * width:  Width
   *  * height: Height
   *  * config: The javascript configuration
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    $this->setOption('theme', 'advanced');
    //$this->setOption('theme', 'simple');
    $this->setOption('config', 'language: "ja"');
  }
  public function getJavaScripts()
  {
    return array(
                 '/jpFormExtraPlugin/js/tiny_mce/tiny_mce.js',
                 );
  }
}
