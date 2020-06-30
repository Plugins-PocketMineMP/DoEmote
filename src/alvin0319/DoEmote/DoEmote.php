<?php

/*
 *     ___        __                _
 *    /   \___   /__\ __ ___   ___ | |_ ___
 *   / /\ / _ \ /_\| '_ ` _ \ / _ \| __/ _ \
 *  / /_// (_) //__| | | | | | (_) | ||  __/
 * /___,' \___/\__/|_| |_| |_|\___/ \__\___|
 *
 * Copyright (C) 2020 alvin0319
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);
namespace alvin0319\DoEmote;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\EmotePacket;
use pocketmine\plugin\PluginBase;

class DoEmote extends PluginBase implements Listener{

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDataPacketReceived(DataPacketReceiveEvent $event) : void{
		$packet = $event->getPacket();
		if($packet instanceof EmotePacket){
			$emoteId = $packet->getEmoteId();
			$this->getServer()->broadcastPacket($event->getPlayer()->getViewers(), EmotePacket::create($event->getPlayer()->getId(), $emoteId, 1 << 0));
		}
	}
}