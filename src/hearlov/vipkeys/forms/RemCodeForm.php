<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{MenuOption, MenuForm, FormIcon};
use hearlov\vipkeys\event\KeyDeletionEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;

class RemCodeForm extends MenuForm{


    public function __construct(){
		$plugin = VIPKeys::getInstance();
		$buttons = [];
		foreach(array_keys($plugin->getKeyAll()) as $reedem){
			$aktif = $plugin->getKey($reedem)["used"] ? $plugin->getLanguage("menu.admin.remcode.used") : $plugin->getLanguage("menu.admin.remcode.active") ;
			$buttons[] = new MenuOption($reedem . " §l" . $aktif, new FormIcon("textures/ui/cancel", FormIcon::IMAGE_TYPE_PATH));
		}
        parent::__construct($plugin->getLanguage("menu.admin.remcode.title"), $plugin->getLanguage("menu.admin.remcode.text"), $buttons, function (Player $player, int $selected) use ($plugin): void {
			$key = explode(" ", $this->getOption($selected)->getText())[0];
			if($plugin->in_key($key)){

				$event = new KeyDeletionEvent($plugin, $player, $key);
				$event->call();
				if($event->isCancelled()) return;
				
				$plugin->removeKey($key);
				$player->sendMessage("§a> " . $plugin->getLanguage("menu.admin.remcode.success"));
			} else $player->sendMessage("§c> " . $plugin->getLanguage("menu.admin.remcode.err"));
        });
    }
}