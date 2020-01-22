
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

            $cont = "<div class='popUpOverlay' id='addblockId'>
                        <div class='popUp'>
                            <div class='innerPopup'>
                                <div class='popUpImage'>
                                    <i class='fa fa-exclamation-circle' aria-hidden='true'></i>
                                </div>
                                <div class='popUpKop'>
                                    Addblocker is gedecteerd
                                </div>
                                <div class='popUpText'>
                                    $popuptext
                                </div>
                                <div class='buttonPos'>
                                    <button class='popUpbutton green' onclick='closeAdblock()'>Ik zet adblocker uit</button>
                                    <button class='popUpbutton' onclick='closeAdblock()'>Nee danje</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";

      	    return $cont;

      	}

        public function onAfterDispatch(){

            $plugin = JPluginHelper::getPlugin('system', 'tks_popUp');
            $pluginParams = new JRegistry($plugin->params);

            $plgURL = JURI::base() . 'plugins/system/tks_popUp';
            $doc = JFactory::getDocument();

            $doc->addStyleSheet($plgURL . '/css/style.css');
            if(!isset($_COOKIE['popUp'])){
                $doc->addScript($plgURL.'/js/advertisement.js');//bait script voor de adblocker
                $doc->addScript($plgURL.'/js/javascript.js');   
            }

            $this->params = $pluginParams;

        }

        public function onAfterRender(){

            $getapp = JFactory::getApplication();
            $pluginParams = $this->params;
            $body = $this->app->getBody();
            $content = $this->createCon($pluginParams);
            $body = str_replace('</body>', $content . '</body>', $body );

            if($this->app->isSite()){
                if(!isset($_COOKIE['popUp'])){
                    $this->app->setBody($body); 
                }
            }

        }

    }

?>
