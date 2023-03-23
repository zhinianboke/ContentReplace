<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 文章内容替换工具(启用后，左上角控制台操作)
 * 
 * @package ContentReplace
 * @author zhinianblog
 * @version 1.0.0
 * @link https://zhinianboke.com
 */
class ContentReplace_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */

    /** @var string 控制菜单链接 */
    public static $panel  = 'ContentReplace/console.php';

  
    public static function activate()
    {
      Helper::addPanel(1, self::$panel, '内容替换', '内容替换', 'administrator');
        return _t('启用成功');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
      Helper::removePanel(1, self::$panel); 
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */


}
