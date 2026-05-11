<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

#[Signature('cms:make-admin {email} {password} {--name=Admin}')]
#[Description('Buat / update akun admin untuk CMS')]
class CmsMakeAdmin extends Command
{
    public function handle()
    {
        $email = (string) $this->argument('email');
        $password = (string) $this->argument('password');
        $name = (string) $this->option('name');

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $name !== '' ? $name : $user->name;
        $user->password = Hash::make($password);
        $user->save();

        $this->info('Admin siap: '.$user->email);

        return self::SUCCESS;
    }
}
