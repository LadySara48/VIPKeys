<?php

namespace hearlov\vipkeys\command;

use pocketmine\{command\Command,
    command\CommandSender,
    player\Player, Server};
use hearlov\vipkeys\VIPKeys;
use pocketmine\world\World;
use pocketmine\world\Position;
use hearlov\vipkeys\forms\ReedemForm;

class reedemCommand extends Command {

    public function __construct(VIPKeys $owner){
        parent::__construct("reedem");
        $this->setDescription("Reedem Command");
	$this->setPermission("vipkeys.menu");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): bool{
        if($player instanceof Player){
		$player->sendForm(new ReedemForm());
        }
        return true;
    }
}
