# [Auth](auth.md) / UserSession
 > im\auth\UserSession
____

## Description
A session wrapper that adds a layer ontop of a session.

This wrapper adds a layer on top of a session to be specifically used
as a user session, without affecting the underlaying session data.

## Synopsis
```php
class UserSession implements im\auth\Session {

    // Methods
    public __construct(im\auth\Session $handler)
    public getHandler(): im\auth\Session
    public get(string $name): mixed
    public set(string $name, mixed $value): void
    public has(string $name): bool
    public remove(string $name): void
    public clear(): void
    public save(): void
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__UserSession&nbsp;::&nbsp;\_\_construct__](auth-UserSession-__construct.md) |  |
| [__UserSession&nbsp;::&nbsp;getHandler__](auth-UserSession-getHandler.md) | Get the wrapped session handler |
| [__UserSession&nbsp;::&nbsp;get__](auth-UserSession-get.md) | Get a value from the session |
| [__UserSession&nbsp;::&nbsp;set__](auth-UserSession-set.md) | Set/Change a value in the session |
| [__UserSession&nbsp;::&nbsp;has__](auth-UserSession-has.md) | Check to see if a value exists |
| [__UserSession&nbsp;::&nbsp;remove__](auth-UserSession-remove.md) | Remove a value from the session |
| [__UserSession&nbsp;::&nbsp;clear__](auth-UserSession-clear.md) | Clear the entire session |
| [__UserSession&nbsp;::&nbsp;save__](auth-UserSession-save.md) | Save the current session to storage  A session may load all content to a cache upon creation and work with that cache from that point forward |

## Example 1
```php
$sess = new FileSession();
$sess->set("key", "Value");

$u_sess = new UserSession( new FileSession() );
$u_sess->set("key", "Value");

print_r($sess);
print_r($u_sess);
```

```
Outpout:

Array
(
    [key] => Value
)

Array
(
    [:user:] => Array
        (
            [key] => Value
        )
)
```
