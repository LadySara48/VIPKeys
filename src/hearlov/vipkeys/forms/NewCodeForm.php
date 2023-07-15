<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{MenuOption, MenuForm, FormIcon};
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;

class NewCodeForm extends MenuForm{


    public function __construct(){
		$plugin = VIPKeys::getInstance();
		$config = $plugin->getConfig();
		$buttons = [];
		foreach($config->get("vips") as $vip){
			$buttons[] = new MenuOption($vip, new FormIcon("textures/ui/camera-small", FormIcon::IMAGE_TYPE_PATH));
		}
        parent::__construct($plugin->getLanguage("menu.admin.newcode.title"), $plugin->getLanguage("menu.admin.newcode.text"), $buttons, function (Player $player, int $selected) use ($plugin): void {
			$group = $this->getOption($selected)->getText();
            $newcode = $plugin->generateKey($group);
			if($newcode != "none"){
				$player->sendMessage("§a> " . $plugin->getLanguage("menu.admin.newcode.success") . "\n" . $plugin->getLanguage("menu.admin.newcode.success.role") . $group . "\n" . $plugin->getLanguage("menu.admin.newcode.success.code") . $newcode);
			} else $player->sendMessage("§c> " . $plugin->getLanguage("menu.admin.newcode.err"));
        });
    }
}