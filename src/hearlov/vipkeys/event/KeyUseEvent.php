<?php

namespace hearlov\vipkeys\event;

use pocketmine\event\plugin\PluginEvent;
use hearlov\vipkeys\VIPKeys;
use pocketmine\player\Player;

//ErvaAblaPro22

Class KeyUseEvent extends PluginEvent{

	public function __construct(
	VIPKeys $plugin,
	Player $player,
	String $key,
	String $buyname
	){
		parent::__construct($plugin);
		$this->player = $player;
		$this->key = $key;
		$this->buyname = $buyname;
	} 

	public function getPlayer(): Player{
		return $this->player;
	}

	public function getKey(){
		return $this->key;
	} 

	public function getBuyName(){
		return $this->buyname;
	}  

}
