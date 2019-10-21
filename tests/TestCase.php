<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn()
    {
        $user = factory(User::class)->create();

        auth()->login($user);

        return $user;
    }

    public function create($model, $overrides = [], $count = null)
    {
        return factory($model, $count)->create($overrides);
    }

    public function make($model, $overrides = [])
    {
        return factory($model)->make($overrides);
    }

    public function raw($model, $overrides = [])
    {
        return factory($model)->raw($overrides);
    }
}
