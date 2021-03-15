# [Auth](auth.md) / User
 > im\auth\User
____

## Description
Defiens the interface for a user.

This interface creates a statically typed way of parsing a user around
in a system.

## Synopsis
```php
interface User {

    // Constants
    int ID_ROOT = -1
    int ID_GUEST = 0

    // Methods
    getSession(): im\auth\Session
    getUserid(): int
    getUsername(): string
    getUserlabel(): string
    getGroups(): im\util\ListArray
    inGroup(string $group): bool
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__User&nbsp;::&nbsp;ID\_ROOT__](auth-User-prop_ID_ROOT.md) | The user id for the built-in root user |
| [__User&nbsp;::&nbsp;ID\_GUEST__](auth-User-prop_ID_GUEST.md) | The user id for the built-in guest user |

## Methods
| Name | Description |
| :--- | :---------- |
| [__User&nbsp;::&nbsp;getSession__](auth-User-getSession.md) | Get the user session |
| [__User&nbsp;::&nbsp;getUserid__](auth-User-getUserid.md) | Get the user id |
| [__User&nbsp;::&nbsp;getUsername__](auth-User-getUsername.md) | Get the user name |
| [__User&nbsp;::&nbsp;getUserlabel__](auth-User-getUserlabel.md) | Get the user label |
| [__User&nbsp;::&nbsp;getGroups__](auth-User-getGroups.md) | Get a list of all the groups that this user belongs to |
| [__User&nbsp;::&nbsp;inGroup__](auth-User-inGroup.md) | Check to see if the user belongs to a group |
