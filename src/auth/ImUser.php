<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2017 Daniel Bergløv, License: MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace im\auth;

use im\util\ListArray;
use im\util\HashSet;

/**
 * An implementation of `im\auth\User`
 */
class ImUser implements User {

    /** @internal */
    protected string $key = ":user#";

    /** @internal */
    protected int $id;

    /** @internal */
    protected string $name;

    /** @internal */
    protected ?string $label = null;

    /** @internal */
    protected ListArray $groups;

    /** @internal */
    protected ?Session $session = null;

    /**
     * @param $id
     *      A user id.
     *      This defaults to `User::ID_GUEST`.
     *
     * @param $username
     *      A user name.
     *      This defaults to `root`, `guest` or `user` depending on `$id`.
     */
    public function __construct(int $id = User::ID_GUEST, string $username = null) {
        $this->id = $id;
        $this->groups = new HashSet();

        if ($username == null) {
            $this->name = match ($id) {
                -1 => "root",
                0 => "guest",

                default => "user"
            };

        } else {
            $this->name = $username;
        }
    }

    /**
     * Re-create a user from a session.
     *
     * This will create a guest session if the session passed
     * does not contain any user information.
     */
    public static function fromSession(Session $session): static {
        $user = new static();
        $user->setSession($session);

        return $session;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\User")]
    public function getSession(): Session {
        if ($this->session == null) {
            $this->session = new UserSession( new TmpSession() );
        }

        return $this->session;
    }

    /**
     * Attach a session to this user.
     *
     * If this session contains user information, then id, name etc. will
     * be updated. Otherwise the session will be updated with the current
     * user information.
     *
     * @param $session
     *      The session to attach
     */
    public function setSession(Session $session): void {
        $session = new UserSession($session);
        $handler = $session->getHandler();

        if ($handler->has("{$this->key}id")) {
            $this->id = $handler->get("{$this->key}id");
            $this->name = $handler->get("{$this->key}name");
            $this->label = $handler->get("{$this->key}label");
            $this->groups = $handler->get("{$this->key}groups");

        } else {
            $handler->set("{$this->key}id", $this->id);
            $handler->set("{$this->key}name", $this->name);
            $handler->set("{$this->key}label", $this->label);
            $handler->set("{$this->key}groups", $this->groups);
        }

        $this->session = $session;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\User")]
    public function getUserid(): int {
        return $this->id;
    }

    /**
     * Set a new user id
     *
     * @note
     *      The user session will be updated with the new id
     *
     * @param $id
     *      The new user id
     */
    public function setUserid(int $id): void {
        if ($this->id != $id) {
            $handler = $this->getSession()->getHandler();
            $handler->set("{$this->key}id", $this->id = $id);

            if (in_array($this->name, ["root", "guest", "user"])) {
                $this->setUsername(match ($id) {
                    -1 => "root",
                    0 => "guest",

                    default => "user"
                });
            }
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\User")]
    public function getUsername(): string {
        return $this->name;
    }

    /**
     * Set a new user name
     *
     * @note
     *      The user session will be updated with the new user name
     *
     * @param $name
     *      The new user name
     */
    public function setUsername(string $name): void {
        if ($this->name != $name) {
            $handler = $this->getSession()->getHandler();
            $handler->set("{$this->key}name", $this->name = $name);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\User")]
    public function getUserlabel(): string {
        return $this->label ?? $this->name;
    }

    /**
     * Set a new user label
     *
     * @note
     *      The user session will be updated with the new user label
     *
     * @param $label
     *      The new user label
     */
    public function setUserlabel(?string $label): void {
        if ($this->label !== $label) {
            $handler = $this->getSession()->getHandler();
            $handler->set("{$this->key}label", $this->label = $label);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\User")]
    public function getGroups(): ListArray {
        return $this->groups->copy();
    }

    /**
     * Set new groups for this user
     *
     * @note
     *      This will override any existing groups
     *
     * @param $groups
     *      New groups to set on this user
     */
    public function setGroups(string ...$groups): void {
        $this->groups->clear();

        foreach ($groups as $group) {
            $this->groups->add($group);
        }
    }

    /**
     * Add new groups for this user
     *
     * @note
     *      This will add the new groups to the existing groups
     *
     * @param $groups
     *      New groups to add to this user
     */
    public function addGroups(string ...$groups): void {
        foreach ($groups as $group) {
            $this->groups->add($group);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\User")]
    public function inGroup(string $group): bool {
        return $this->id != User::ID_GUEST
                    && ($this->id == User::ID_ROOT || $this->groups->contains($group));
    }
}
