# [Auth](auth.md) / [User](auth-User.md) :: inGroup
 > im\auth\User
____

## Description
Check to see if the user belongs to a group

 > The user id `User::ID_GUEST` will always return `FALSE` while `User::ID_ROOT` will always return `TRUE`.  

## Synopsis
```php
inGroup(string $group): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| group | The group to check |
