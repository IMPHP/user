# [Auth](auth.md) / [ImUser](auth-ImUser.md) :: setSession
 > im\auth\ImUser
____

## Description
Attach a session to this user.

If this session contains user information, then id, name etc. will
be updated. Otherwise the session will be updated with the current
user information.

## Synopsis
```php
public setSession(im\auth\Session $session): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| session | The session to attach |
