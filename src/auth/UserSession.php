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

use im\util\Map;
use im\util\MapArray;

/**
 * A session wrapper that adds a layer ontop of a session.
 *
 * This wrapper adds a layer on top of a session to be specifically used
 * as a user session, without affecting the underlaying session data.
 *
 * @example
 *
 *      ```php
 *      $sess = new FileSession();
 *      $sess->set("key", "Value");
 *
 *      $u_sess = new UserSession( new FileSession() );
 *      $u_sess->set("key", "Value");
 *
 *      print_r($sess);
 *      print_r($u_sess);
 *      ```
 *
 *      ```
 *      Outpout:
 *
 *      Array
 *      (
 *          [key] => Value
 *      )
 *
 *      Array
 *      (
 *          [:user:] => Array
 *              (
 *                  [key] => Value
 *              )
 *      )
 *      ```
 */
class UserSession implements Session {

    /** @internal */
    protected Session $handler;

    /** @internal */
    protected string $key = ":user:";

    /**
     * @param $handler
     *      A session handler to wrap
     */
    public function __construct(Session $handler) {
        if ($handler instanceof UserSession) {
            $handler = $handler->getHandler();
        }

        $this->handler = $handler;

        if (!$this->handler->has($this->key)) {
            $this->handler->set($this->key, new Map());

        } else {
            $map = $this->handler->get($this->key);

            if (!($map instanceof MapArray)) {
                $this->handler->set($this->key, new Map($map));
            }
        }
    }

    /**
     * @php
     */
    public function __get(string $name): string {
        return $this->$name;
    }

    /**
     * Get the wrapped session handler
     */
    public function getHandler(): Session {
        return $this->handler;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function get(string $name): mixed {
        return $this->handler->get($this->key)->get($name);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function set(string $name, mixed $value): void {
        $this->handler->get($this->key)->set($name, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function has(string $name): bool {
        return $this->handler->get($this->key)->isset($name);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function remove(string $name): void {
        $this->handler->get($this->key)->remove($name);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function clear(): void {
        $this->handler->get($this->key)->clear();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function save(): void {
        $this->handler->save();
    }

    /**
     * @php
     */
    public function __debugInfo(): array {
        return $this->handler->__debugInfo();
    }
}
