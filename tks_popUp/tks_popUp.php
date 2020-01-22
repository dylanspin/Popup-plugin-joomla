
<?php


  //@author     Dylan spin

    defined('_JEXEC') or die;
    jimport('joomla.plugin.plugin');

    class PlgSystemtks_popUp extends JPlugin{

        protected $app;
        public $params;

        function __construct(&$subject, $config) {
            parent :: __construct($subject, $config);
        }

        public function createCon($pluginParams){

            $popupkop = $pluginParams->get('popupkop');
            $popuptext = $pluginParams->get('popuptext');

            $cont = "<div class='popUpOverlay' id='popUpId'>
                        <div class='popUp'>
                            <div class='innerPopup'>
                                <div class='popUpText'>
                                    $popuptext
                                </div>
                                <img src='images/adblock.png'>
                            </div>
                        </div>
                    </div>
                    ";//body content

      	    return $cont;

      	}

        public function onAfterDispatch(){

            $plugin = JPluginHelper::getPlugin('system', 'tks_popUp');
            $pluginParams = new JRegistry($plugin->params);

            $plgURL = JURI::base() . 'plugins/system/tks_popUp';
            $doc = JFactory::getDocument();

            $doc->addStyleSheet($plgURL . '/css/style.css');
            $doc->addScript($plgURL.'/js/advertisement.js');
            $doc->addScript($plgURL.'/js/javascript.js');

      	    $css = "";

            $doc->addStyleDeclaration($css);
            $this->params = $pluginParams;

        }

        public function onAfterRender(){

            $getapp = JFactory::getApplication();

            $pluginParams = $this->params;

            $body = $this->app->getBody();
            $content = $this->createCon($pluginParams);
            $body = str_replace('</body>', $content . '</body>', $body );

            if(!isset($_COOKIE['popUp'])){
                $this->app->setBody($body);
            }

        }

    }

?>
