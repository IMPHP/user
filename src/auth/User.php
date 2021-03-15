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

/**
 * Defiens the interface for a user.
 *
 * This interface creates a statically typed way of parsing a user around
 * in a system.
 */
interface User {

    /**
     * The user id for the built-in root user.
     *
     * @note
     *      This user is the default administrator and has all privileges regardless of groups
     *
     * @var int
     */
    const ID_ROOT = -1;

    /**
     * The user id for the built-in guest user.
     *
     * @note
     *      This user never have any privileges regardless of groups
     *
     * @var int
     */
    const ID_GUEST = 0;

    /**
     * Get the user session
     */
    function getSession(): Session;

    /**
     * Get the user id
     */
    function getUserid(): int;

    /**
     * Get the user name
     */
    function getUsername(): string;

    /**
     * Get the user label
     *
     * @note
     *      Unlike user name, this is a more presentable name like
     *      a full name or first name.
     */
    function getUserlabel(): string;

    /**
     * Get a list of all the groups that this user belongs to.
     */
    function getGroups(): ListArray;

    /**
     * Check to see if the user belongs to a group
     *
     * @note
     *      The user id `User::ID_GUEST` will always return `FALSE`
     *      while `User::ID_ROOT` will always return `TRUE`.
     *
     * @param $group
     *      The group to check
     */
    function inGroup(string $group): bool;
}
