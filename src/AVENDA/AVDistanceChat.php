<?php

namespace AVENDA;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;

class AVDistanceChat extends PluginBase implements Listener {
	public $chat, $cDB;
	public function onEnable() {
		@mkdir ( $this->getDataFolder () );
		$this->chat = new Config ( $this->getDataFolder () . "chat.yml", Config::YAML, [ 
				"distance" => 100 
		] );
		$this->cDB = $this->chat->getAll ();
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
	}
	public function Chat(PlayerChatEvent $event) {
		$player = $event->getPlayer ();
		$distance = $player->getLevel ()->getPlayers ();
		foreach ( $distance as $players ) {
			if ($player->distance ( $players ) > $this->cDB ["distance"]) {
			} else {
				$player->sendMessage ( $event->getMessage () );
			}
		}
	}
}