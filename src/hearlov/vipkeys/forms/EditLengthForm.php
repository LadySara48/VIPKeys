<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{CustomForm, CustomFormResponse, element\Slider};
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;
use hearlov\vipkeys\event\SettingEvent;
use hearlov\vipkeys\forms\SettingsForm;

class EditLengthForm extends CustomForm{

    public function __construct(){
		$plugin = VIPKeys::getInstance();
        parent::__construct($plugin->getLanguage("menu.admin.settings.editlength.title"),[
        new Slider("slider", $plugin->getLanguage("menu.admin.settings.editlength.text"), 8, 32, 1 , $plugin->getConfig()->get("code-length"))
		],function (Player $player, CustomFormResponse $response) use ($plugin): void {

            $event = new SettingEvent($plugin, $player, SettingEvent::CODE_LENGTH, ["length" => ((int) $response->getFloat("slider"))]);
			$event->call();
			if($event->isCancelled()) return;

			$plugin->setConfigVariant((int) $response->getFloat("slider"));
            $player->sendMessage($plugin->getLanguage("menu.admin.settings.editlength.success"));
            $player->sendForm(new SettingsForm());

        });
		
    }
	
}