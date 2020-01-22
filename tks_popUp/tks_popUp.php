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

            $popuptext = $pluginParams->get('popuptext');

            $cont = "<div class='popUpOverlay' id='popUpId'>
                        <div class='popUp'>
                            <div class='innerPopup'>
                                <div class='popUpClose' onclick='closePop()'><i class='fa fa-times-circle-o'></i></div>
                                <div class='popUpKop'>Dont want to miss anything ?</div>
                                <div class='popUpText'>
                                    Maecenas hendrerit dapibus leo eu aliquet. Cras pellentesque fermentum 
                                    sollicitudin.Pellentesque in porttitor mauris. Phasellus id metus tincidunt,
                                </div>
                            </div>
                        </div>
                    </div>";//body content

      	    return $cont;

      	}

        public function onAfterDispatch(){

            $plugin = JPluginHelper::getPlugin('system', 'tks_popUp');
            $pluginParams = new JRegistry($plugin->params);

            $plgURL = JURI::base() . 'plugins/system/tks_popUp';
            $doc = JFactory::getDocument();

            $doc->addStyleSheet($plgURL . '/css/style.css');
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
