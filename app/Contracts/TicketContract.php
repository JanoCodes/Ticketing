<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2017 Andrew Ying
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v3.0 as
 * published by the Free Software Foundation. You must preserve all legal
 * notices and author attributions present.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Jano\Contracts;

use Jano\Models\Charge;
use Jano\Models\Ticket;
use Jano\Models\User;

interface TicketContract
{
    /**
     * Store a newly created ticket class instance.
     *
     * @param array $data
     * @return \Jano\Models\Ticket
     */
    public function store($data);

    /**
     * Retrieve a collection of ticket classes.
     *
     * @param mixed $query
     * @return \Illuminate\Support\Collection
     */
    public function search($query);

    /**
     * Update the attributes of the ticket class instance.
     *
     * @param \Jano\Models\Ticket $ticket
     * @param array $data
     * @return \Jano\Models\Ticket
     */
    public function update(Ticket $ticket, $data);

    /**
     * Hold tickets for the user.
     *
     * @param \Jano\Models\User $user
     * @param array $request
     * @return array
     */
    public function hold(User $user, $request);

    /**
     * Reserve a ticket for the user.
     *
     * @param array $data
     * @param boolean $frontend
     * @return \Jano\Models\Attendee
     */
    public function reserve($data, $frontend);

    /**
     * Get ticket price.
     *
     * @param Ticket $ticket
     * @param User $user
     * @return float
     */
    public function getPrice(Ticket $ticket, User $user);

    /**
     * Destroy a ticket class instance.
     *
     * @param \Jano\Models\Ticket $ticket
     * @return void
     */
    public function destroy(Ticket $ticket);
}
