<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="row col-lg-11 border rounded mx-auto mt-5 p-2 shadow-lg">
        <div class="col-md-3 text-center">
            <?php if(isset($_POST['image'])): ?>
            <img src="<?php echo $_POST['image']; ?>" class="js-image img-fluid rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
            <?php else: ?>
            <img src="/Pictures/no-user-images.png" class="js-image img-fluid rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
            <?php endif; ?>
            <div class="mb-3">
                <label for="formFile" class="form-label">Click to select an image</label>
                <input onchange="display_image(this.files[0])" type="file" id="formFile" class="form-control">
            </div>
        </div>
        <div class="col-md-9">
            <div class="h2">Edit Profile</div>

            <form method="post">
                <table class="table table-striped">
                    <tr>
                        <th colspan="2">User Details:</th>
                    </tr>
                    <tr>
                        <th><i class="bi bi-envelope"></i> Email</th>
                        <td>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-key"></i> Password</th>
                        <td>
                            <input type="text" name="password" class="form-control" placeholder="Password">
                        </td>
                    </tr>
                    <tr>
                        <th style="display: inline-flex;"><i class="bi bi-journal-text"></i> Description</p></th>
                        <td>
                            <textarea cols="100" rows="4"></textarea>
                        </td>
                    </tr>
                </table>

                <div class="p-2">
                    <button class="btn btn-primary float-end">Save</button>
                    <a href="ProfilePage.php">
                        <label class="btn btn-secondary">Back</label>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    function display_image(file) 
    {
        var img = document.querySelector(".js-image");
        img.src = URL.createObjectURL(file);
    }
</script>
