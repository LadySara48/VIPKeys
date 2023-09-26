<?php

namespace hearlov\vipkeys\command;

use pocketmine\{command\Command,
    command\CommandSender,
    player\Player, Server};
use hearlov\vipkeys\VIPKeys;
use pocketmine\world\World;
use pocketmine\world\Position;
use pocketmine\plugin\PluginOwned;
use hearlov\vipkeys\forms\VIPKeysMainForm;

class vipkeyCommand extends Command implements PluginOwned{

    public function __construct(){
        parent::__construct("vipkeys");
        $this->setDescription("VIP Keys open");
	    $this->setPermission("vipkeys.admin.menu");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): bool{
        if($player instanceof Player){
		$player->sendForm(new VIPKeysMainForm());
        }
        return true;
    }

    public function getOwningPlugin(): VIPKeys{
        return VIPKeys::getInstance();
    }
}
