<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
   private $userService;

   public function __construct($name = null, array $data = [], $dataName = '')
   {
       parent::__construct($name, $data, $dataName);
       $this->userService = new UserService();
   }

    /**
     * Test if the created user is an instance of the User class
     */
   public function testCreate()
   {
       $user = $this->userService->create(
           array_merge(factory(User::class)->make()->toArray(), ['password' => 'secret'])
       );
       $this->assertInstanceOf(User::class, $user);
   }

    /**
     * Test if the found user is equal to created user
     */
    public function testFind()
    {
        $user = $this->userService->create(
            array_merge(factory(User::class)->make()->toArray(), ['password' => 'secret'])
        );
        $userFindInstance = $this->userService->find($user->id);

        $this->assertEquals($user->toArray(), $userFindInstance->toArray());
    }

    public function testDelete()
    {
        $this->expectException(ModelNotFoundException::class);
        $user = factory(User::class)->create();
        $this->userService->delete($user);
        $this->userService->find($user->id);
    }
}
