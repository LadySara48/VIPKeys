<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{MenuOption, MenuForm, FormIcon};
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;
use hearlov\vipkeys\forms\EditLengthForm;

class SettingsForm extends MenuForm{


    public function __construct(){
		$plugin = VIPKeys::getInstance();
		$buttons = [
			new MenuOption($plugin->getLanguage("menu.admin.settings.variant"), new FormIcon("textures/ui/ThinPlus", FormIcon::IMAGE_TYPE_PATH)),
			new MenuOption($plugin->getLanguage("menu.admin.settings.reload"), new FormIcon("textures/ui/Scaffolding", FormIcon::IMAGE_TYPE_PATH))
			];
        parent::__construct($plugin->getLanguage("menu.admin.settings.title"), $plugin->getLanguage("menu.admin.listcode.text"), $buttons, function (Player $player, int $selected) use ($plugin): void {
			switch($selected){
				case 0:
					$player->sendForm(new EditLengthForm());
				break;
				case 1:
					$plugin->reloadPlugin();
				break;
			}
		});
    }

}