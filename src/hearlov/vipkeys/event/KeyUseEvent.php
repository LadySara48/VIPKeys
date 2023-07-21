<?php

namespace hearlov\vipkeys\event;

use pocketmine\event\plugin\PluginEvent;
use hearlov\vipkeys\VIPKeys;
use pocketmine\player\Player;

//ErvaAblaPro22

Class KeyUseEvent extends PluginEvent{

	private $player;
	private $key;
	private $buyname;
	
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

	/*
 	* return Player
	*/
	public function getPlayer(): Player{
		return $this->player;
	}

	/*
 	* return String
  	* key code
	*/
	public function getKey(){
		return $this->key;
	} 

	/*
 	* return String (Group Name)
	*/
	public function getBuyName(){
		return $this->buyname;
	}  

}
