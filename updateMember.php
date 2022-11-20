<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Process Update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
</head>

<body>
    <form method="POST" action="updateMemberProcess.php"> 
    <div class="w-50 ml-auto mr-auto mt-5">
        <div class="mb-3 ">
            <label for="exampleFormControlInput1" class="form-label">Please Input the ID of the user that you want to update.</label>
            <input name="id" type="text" class="form-control" id="exampleFormControlInput1" placeholder="ID">
        </div>
        <div class="mb-3 ">
            <label for="exampleFormControlInput1" class="form-label">Please put the Status that you would like to change to</label>
            <input name="status" type="text" class="form-control" id="exampleFormControlInput1" placeholder="status">
        </div>
    
        <button type="submit" name="updateStatusSubmit" class="btn btn-primary mb-3">Update</button>
        </form>
        <form method="POST" action="main_page_manager.php"> 
        <div class = "mb-3 ">
        <button type="submit" name="return" class="btn btn-primary mb-3">Return to Main Page</button>
        </div>
        </form>
    </div>
    </form>
</body>

</html>