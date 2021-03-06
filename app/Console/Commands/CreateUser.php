<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2018 Andrew Ying and other contributors.
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

namespace Jano\Console\Commands;

use Illuminate\Console\Command;
use Jano\Contracts\StaffContract;
use Jano\Contracts\UserContract;
use Jano\Models\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create
        {email : Email address of the new user}
        {--admin=999 : Level of backend access privileges}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * @var \Jano\Contracts\UserContract
     */
    private $user;

    /**
     * @var \Jano\Contracts\StaffContract
     */
    private $staff;

    /**
     * Create a new command instance.
     *
     * @param \Jano\Contracts\UserContract $contract
     * @param \Jano\Contracts\StaffContract $staff
     * @return void
     */
    public function __construct(UserContract $contract, StaffContract $staff)
    {
        $this->user = $contract;
        $this->staff = $staff;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = array();
        $user['email'] = $this->argument('email');
        $user['password'] = $this->secret('Password');
        $user['title'] = $this->choice('Title', __('system.titles'), 0);
        $user['first_name'] = $this->ask('First Name');
        $user['last_name'] = $this->ask('Last Name');
        $user['group_id'] = 1;
        $user['method'] = User::DATABASE_METHOD;

        $user = $this->user->store($user);

        if ($level = $this->option('admin')) {
            $this->staff->store($user, $level);
        }

        $this->info('Successfully created new user.');
    }
}
