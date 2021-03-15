# [Auth](auth.md) / [ImUser](auth-ImUser.md) :: fromSession
 > im\auth\ImUser
____

## Description
Re-create a user from a session.

This will create a guest session if the session passed
does not contain any user information.

## Synopsis
```php
public static fromSession(im\auth\Session $session): static
```
