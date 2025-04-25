<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="/edit-user/{{$user->id}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{$user->name}}">
    <input type="text" name="username" value="{{$user->username}}">
    <input type="password" name="password" value="{{$user->password}}">
    <div class="mb-3">
        <label class="form-label">User Type</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="usertype_id" id="cashier" value="2" checked>
            <label class="form-check-label" for="cashier">Cashier</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="usertype_id" id="admin" value="1">
            <label class="form-check-label" for="admin">Admin</label>
        </div>
    </div>
    <input type="email" name="email" value="{{$user->email}}">
    <button>Save Changes</button>
    
    </form>
</body>
</html>