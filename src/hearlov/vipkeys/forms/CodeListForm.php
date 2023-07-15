<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{MenuOption, MenuForm, FormIcon};
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;

class CodeListForm extends MenuForm{


    public function __construct(){
		$plugin = VIPKeys::getInstance();
		$buttons = [];
		foreach(array_keys($plugin->getKeyAll()) as $reedem){
			$info = $plugin->getKey($reedem);
			if($info["used"] == false) $buttons[] = new MenuOption($reedem . " §6" . $info["group"], new FormIcon("textures/ui/cancel", FormIcon::IMAGE_TYPE_PATH));
		}
        parent::__construct($plugin->getLanguage("menu.admin.listcode.title"), $plugin->getLanguage("menu.admin.listcode.text"), $buttons, function (Player $player, int $selected): void {});
    }
}