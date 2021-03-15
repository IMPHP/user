<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\io\RawStream;
use im\auth\StreamSession;
use im\auth\TmpSession;
use im\auth\UserSession;
use im\auth\ImUser;
use im\auth\User;

final class UserTest extends TestCase {

    /**
     *
     */
    public function test_userSession(): void {
        $stream = new RawStream();
        $session = new UserSession(new StreamSession(null, $stream));
        $session->set("name", "Some Value");
        $session->save();

        $this->assertEquals(
            'a:1:{s:6:":user:";O:11:"im\util\Map":2:{s:6:"locked";b:0;s:4:"data";a:1:{s:4:"name";s:10:"Some Value";}}}',
            $stream->toString()
        );

        $session = new UserSession(new StreamSession(null, $stream));

        $this->assertEquals(
            'Some Value',
            $session->get("name")
        );
    }

    /**
     *
     */
    public function test_user(): void {
        $user = new ImUser();

        $this->assertEquals(
            'guest',
            $user->getUsername()
        );

        $user->setSession($session = new TmpSession());
        $user->setUserid(User::ID_ROOT);

        $this->assertEquals(
            'root',
            $user->getUsername()
        );

        $user = new ImUser();
        $user->setSession($session);

        $this->assertEquals(
            'root',
            $user->getUsername()
        );
    }
}
