<?php

namespace Savion;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;


use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\CallbackTask;

use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\math\Vector3;

use pocketmine\block\Block;

use pocketmine\tile\Sign;
use pocketmine\tile\Tile;

use pocketmine\level\Position;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener
{

	public function onEnable()
	{
		$this->getServer()->getPluginManager()->registerEvents($this,$this);	
		}
		
		public function onCommand(CommandSender $sender, Command $command, $label, array $args)
	{
		if(strtolower($command->getName()) === "setgame"){
		
		
		}
		}
		
		}
			
