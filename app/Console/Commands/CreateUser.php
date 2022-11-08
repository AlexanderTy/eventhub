<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--email=} {--password=} {--first_name=} {--last_name=} {--role=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user with an --email, a --password and a --name';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $user = User::create([
            'email'    => $this->option('email'),
            'password' => Hash::make($this->option('password')),
            'role'     => $this->option('role'),
            'first_name'     => $this->option('first_name'),
            'last_name'     => $this->option('last_name'),

        ]);

        $this->info("Successfully created user $user->name with email $user->email role: {$user->role->name()}");
    }
}
