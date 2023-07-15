<?php

namespace hearlov\vipkeys\forms;

use hearlov\vipkeys\libs\dktapps\pmforms\{CustomForm, CustomFormResponse, element\Input, element\Label};
use pocketmine\player\Player;
use pocketmine\Server;
use hearlov\vipkeys\VIPKeys;
use _64FF00\PurePerms\PurePerms;
use onebone\economyapi\EconomyAPI;
use hearlov\vipkeys\event\KeyUseEvent;

class ReedemForm extends CustomForm{

    public function __construct(){
		$plugin = VIPKeys::getInstance();
		$pureperms = PurePerms::getInstance();
        parent::__construct($plugin->getLanguage("menu.reedem.title"),[
		new Label("label", "§6Enter to Reedem Code"),
		new Input("input", "Reedem Code")
		],function (Player $player, CustomFormResponse $response) use ($plugin, $pureperms): void {
			$evetmi = $plugin->in_Key($response->getString("input"));
            if($evetmi){
				$keyinfo = $plugin->getKey($response->getString("input"));
				if($pureperms->getGroup($keyinfo["group"]) !== null){
					if($keyinfo["used"] == false){
						$pureperms->setGroup($player, $pureperms->getGroup($keyinfo["group"]), null, -1);
						$config = $plugin->getConfig();
						$player->sendMessage("§a> " . $plugin->getLanguage("menu.reedem.success") . " " . $keyinfo["group"]);
						$plugin->useKey($player, $response->getString("input"));
						if($config->get("economy") == true && isset($config->get("givemoney")[$keyinfo["group"]])){
							EconomyAPI::getInstance()->addMoney($player, $config->get("givemoney")[$keyinfo["group"]]);
						}
						$event = new KeyUseEvent($plugin, $player, $response->getString("input"), $keyinfo["group"]);
						$event->call();
					} else $player->sendMessage("§c> " . $plugin->getLanguage("menu.reedem.error.used"));
				} else $player->sendMessage("§c> " . $plugin->getLanguage("menu.reedem.error.vipexists"));
			}else $player->sendMessage("§c> " . $plugin->getLanguage("menu.reedem.error.reedemexists"));
        });
		
    }
	
}