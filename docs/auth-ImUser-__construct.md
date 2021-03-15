# [Auth](auth.md) / [ImUser](auth-ImUser.md) :: __construct
 > im\auth\ImUser
____

## Synopsis
```php
public __construct(int $id = im\auth\User::ID_GUEST, null|string $username = NULL)
```

## Parameters
| Name | Description |
| :--- | :---------- |
| id | A user id.<br />This defaults to `User::ID_GUEST`. |
| username | A user name.<br />This defaults to `root`, `guest` or `user` depending on `$id`. |
