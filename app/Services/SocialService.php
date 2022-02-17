<?php
declare(strict_types=1);
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User;
use App\Contracts\Social;
use App\Models\User as Model;


class SocialService implements Social
{

    private function generateRandomPassword($length = 8)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $password;
    }
    /**
     * @param User $socialUser
     * @param string $network
     * @return string
     * @throws Exception
     */
    public function setUser(User $socialUser, string $network): string
    {
        $user = Model::query()->where('email', $socialUser->getEmail())->first();
        if($user) {

            $user->name = $socialUser->getName();
            $user->avatar = $socialUser->getAvatar();

            if($user->save()) {
                Auth::loginUsingId($user->id);
                return route('account');
            }
        } else {
            //            return route('register');
            $password = $this->generateRandomPassword(8);
            $user = Model::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make($password),
                'avatar' => $socialUser->getAvatar(),
            ]);
            Auth::loginUsingId($user->id);

            $message = 'Ваш логин: '. $user->email . ', Ваш пароль: ' . $password;
            session(['message'=> $message]);
            return route('account');

        }
        throw new Exception('We get error via social network: '. $network);
    }
}
