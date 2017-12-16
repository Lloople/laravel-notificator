# Laravel Notificator

Simple session flashing messages manager for Laravel

Notifications are stored in Laravel's session flash input, keyed by `notifications`
### Create a notification

    Notificator::success('This is a success notification');
    
You can choose between 4 types
- `success`
- `info`
- `error`
- `warning`

### Print a notification

```php
@foreach(Notificator::all() as $notification)
    <div class="alert alert-{{ $notification->getBootstrapClass() }}>
        <p>{{ $notification->getMessage() }}</p>
    </div>
@endforeach
```

`getBootstrapType()` transforms the `error` type into `danger` to use it with Bootstrap default CSS alerts.
 If you're not using Bootstrap, you can use `getType` to get it as `error`.
 
 If you just want the first notification or you know you'll work with just one, you can use 
 
     Notificator::first()->getMessage();

### Duration

Notification's Messages also have an integer `$duration` in case you use a javscript library like [toastr.js](https://github.com/CodeSeven/toastr)

You can modify the default duration of 5 seconds when creating the notification
   
    Notificator::success('Message', 10000); // 10 seconds