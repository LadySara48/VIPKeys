<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{MenuOption, MenuForm, FormIcon};
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;
use hearlov\vipkeys\forms\NewCodeForm;
use hearlov\vipkeys\forms\RemCodeForm;
use hearlov\vipkeys\forms\UsedListForm;
use hearlov\vipkeys\forms\CodeListForm;

class VIPKeysMainForm extends MenuForm{


    public function __construct(){
		$plugin = VIPKeys::getInstance();
		$buttons = [
		new MenuOption($plugin->getLanguage("menu.admin.button.newcode"), new FormIcon("textures/ui/ThinPlus", FormIcon::IMAGE_TYPE_PATH)),
		new MenuOption($plugin->getLanguage("menu.admin.button.remcode"), new FormIcon("textures/ui/Scaffolding", FormIcon::IMAGE_TYPE_PATH)),
		new MenuOption($plugin->getLanguage("menu.admin.button.codes"), new FormIcon("textures/ui/New_confirm_Hover", FormIcon::IMAGE_TYPE_PATH)),
		new MenuOption($plugin->getLanguage("menu.admin.button.usedcodes"), new FormIcon("textures/ui/cancel", FormIcon::IMAGE_TYPE_PATH))
		];
        parent::__construct($plugin->getLanguage("menu.admin.title"), $plugin->getLanguage("menu.admin.text"), $buttons, function (Player $player, int $selected) use ($plugin): void {
            if(isset($selected)){
				$select = $this->getOption($selected)->getText();
				switch($select){
					case $plugin->getLanguage("menu.admin.button.newcode"):
					if($player->hasPermission("vipkeys.admin.menu.newkey")){
					$player->sendForm(new NewCodeForm());
					} else $player->sendMessage($plugin->getLanguage("error.permission"));
					break;
					case $plugin->getLanguage("menu.admin.button.remcode"):
					if($player->hasPermission("vipkeys.admin.menu.remkey")){
					$player->sendForm(new RemCodeForm());
					} else $player->sendMessage($plugin->getLanguage("error.permission"));
					break;
					case $plugin->getLanguage("menu.admin.button.codes"):
					$player->sendForm(new CodeListForm());
					break;
					case $plugin->getLanguage("menu.admin.button.usedcodes"):
					$player->sendForm(new UsedListForm());
					break;
				}
			}
        });
    }
}