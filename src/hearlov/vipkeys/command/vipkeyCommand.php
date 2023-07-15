<?php

namespace hearlov\vipkeys\command;

use pocketmine\{command\Command,
    command\CommandSender,
    player\Player, Server};
use hearlov\vipkeys\VIPKeys;
use pocketmine\world\World;
use pocketmine\world\Position;
use hearlov\vipkeys\forms\VIPKeysMainForm;

class vipkeyCommand extends Command {

	private VIPKeys $owner;

    public function __construct(VIPKeys $owner){
        parent::__construct("vipkeys");
		$this->owner = $owner;
        $this->setDescription("VIP Keys open");
		$this->setPermission("vipkeys.admin.menu");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): bool{
        if($player instanceof Player){
			$player->sendForm(new VIPKeysMainForm());
        }
        return true;
    }
}