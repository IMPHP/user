# [Auth](auth.md) / ImUser
 > im\auth\ImUser
____

## Description
An implementation of `im\auth\User`

## Synopsis
```php
class ImUser implements im\auth\User {

    // Inherited Constants
    public int ID_ROOT = -1
    public int ID_GUEST = 0

    // Methods
    public __construct(int $id = im\auth\User::ID_GUEST, null|string $username = NULL)
    public static fromSession(im\auth\Session $session): static
    public getSession(): im\auth\Session
    public setSession(im\auth\Session $session): void
    public getUserid(): int
    public setUserid(int $id): void
    public getUsername(): string
    public setUsername(string $name): void
    public getUserlabel(): string
    public setUserlabel(null|string $label): void
    public getGroups(): im\util\ListArray
    public setGroups(string ...$groups): void
    public addGroups(string ...$groups): void
    public inGroup(string $group): bool
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__ImUser&nbsp;::&nbsp;ID\_ROOT__](auth-ImUser-prop_ID_ROOT.md) | The user id for the built-in root user |
| [__ImUser&nbsp;::&nbsp;ID\_GUEST__](auth-ImUser-prop_ID_GUEST.md) | The user id for the built-in guest user |

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImUser&nbsp;::&nbsp;\_\_construct__](auth-ImUser-__construct.md) |  |
| [__ImUser&nbsp;::&nbsp;fromSession__](auth-ImUser-fromSession.md) | Re-create a user from a session |
| [__ImUser&nbsp;::&nbsp;getSession__](auth-ImUser-getSession.md) | Get the user session |
| [__ImUser&nbsp;::&nbsp;setSession__](auth-ImUser-setSession.md) | Attach a session to this user |
| [__ImUser&nbsp;::&nbsp;getUserid__](auth-ImUser-getUserid.md) | Get the user id |
| [__ImUser&nbsp;::&nbsp;setUserid__](auth-ImUser-setUserid.md) | Set a new user id |
| [__ImUser&nbsp;::&nbsp;getUsername__](auth-ImUser-getUsername.md) | Get the user name |
| [__ImUser&nbsp;::&nbsp;setUsername__](auth-ImUser-setUsername.md) | Set a new user name |
| [__ImUser&nbsp;::&nbsp;getUserlabel__](auth-ImUser-getUserlabel.md) | Get the user label |
| [__ImUser&nbsp;::&nbsp;setUserlabel__](auth-ImUser-setUserlabel.md) | Set a new user label |
| [__ImUser&nbsp;::&nbsp;getGroups__](auth-ImUser-getGroups.md) | Get a list of all the groups that this user belongs to |
| [__ImUser&nbsp;::&nbsp;setGroups__](auth-ImUser-setGroups.md) | Set new groups for this user |
| [__ImUser&nbsp;::&nbsp;addGroups__](auth-ImUser-addGroups.md) | Add new groups for this user |
| [__ImUser&nbsp;::&nbsp;inGroup__](auth-ImUser-inGroup.md) | Check to see if the user belongs to a group |
