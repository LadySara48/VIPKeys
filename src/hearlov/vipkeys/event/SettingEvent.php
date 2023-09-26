<?php

namespace hearlov\vipkeys\event;

use pocketmine\event\plugin\PluginEvent;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use hearlov\vipkeys\VIPKeys;
use pocketmine\player\Player;

//ErvaAblaPro22

Class SettingEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	private $player;
	private $setting;
    private $settingcontent = null;

    CONST RELOAD_PLUGIN = 0;
    CONST CODE_LENGTH = 1;
	
	public function __construct(
	VIPKeys $plugin,
	Player $player,
    Int $setting,
    Array $settingcontent = null
	){
		parent::__construct($plugin);
		$this->player = $player;
		$this->setting = $setting;
        $this->settingcontent = $settingcontent;
	} 

	/*
 	* return Player
	*/
	public function getPlayer(): Player{
		return $this->player;
	}

	/*
 	* return Integer
  	* setting Value
	*/
	public function getSetting(): Int{
		return $this->setting;
	}

    /*
 	* return Array|null
  	* setting Content value
	*/
    public function getSettingContent(): ?Array{
        return $this->settingcontent;
    }

}
