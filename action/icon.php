<?php
/**
 * DokuWiki Plugin skilltagicon (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Michael Große <grosse@cosmocode.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_skilltagicon_icon extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {

       $controller->register_hook('TPL_CONTENT_DISPLAY', 'BEFORE', $this, 'handle_tpl_content_display');
   
    }

    /**
     * [Custom event handler which performs action]
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return mixed, false if tagging plugin is missing, void otherwise.
     */

    public function handle_tpl_content_display(Doku_Event &$event, $param) {
        global $ID,$ACT;

        if ($ACT != 'show'){
            return;
        }

        $tags = plugin_load('helper', 'tagging');
        if(is_null($tags)) {
            msg('The skilltagicon plugin needs the tagging plugin', -1);
            return false;
        }
        $tags = $tags->findItems(array('pid' => $ID),'tag');
        
        $easy_tag = $this->getConf('easy_tag');
        $intermediate_tag = $this->getConf('intermediate_tag');
        $expert_tag = $this->getConf('expert_tag');

        $icon = false;
        if (array_key_exists($easy_tag,$tags)) {
            $icon = 'easy.png';
            $icon_title = $this->getLang('easy_page');
        } elseif (array_key_exists($intermediate_tag,$tags)) {
            $icon = 'intermediate.png';
            $icon_title = $this->getLang('intermediate_page');
        } elseif (array_key_exists($expert_tag,$tags)) {
            $icon = 'expert.png';
            $icon_title = $this->getLang('expert_page');
        }

        if ($icon !== false) {
            $icon_html = '<img src="lib/plugins/skilltagicon/icon/' . $icon . '" alt="" title="' . $icon_title . '" class="skilltagicon">';
            $event->data = $icon_html . $event->data;
        }
    }

}

// vim:ts=4:sw=4:et:
