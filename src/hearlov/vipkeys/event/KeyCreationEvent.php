<?php

namespace hearlov\vipkeys\event;

use pocketmine\event\plugin\PluginEvent;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use hearlov\vipkeys\VIPKeys;
use pocketmine\player\Player;

//ErvaAblaPro22

Class KeyCreationEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	private $player;
	private $itemname;
	
	public function __construct(
	VIPKeys $plugin,
	Player $player,
	String $itemname
	){
		parent::__construct($plugin);
		$this->player = $player;
		$this->itemname = $itemname;
	} 

	/*
 	* return Player
	*/
	public function getPlayer(): Player{
		return $this->player;
	}

	/*
 	* return String (Group Name)
	*/
	public function getItemName(){
		return $this->itemname;
	}  

}
