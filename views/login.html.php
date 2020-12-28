<?php 
    $this->layout('layouts/auth.layout', [
        'title' => 'Admin panel - Login'
    ]);
?>

<?php $this->start('body') ?>
    <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">
            <span class="text-center"><strong>Welcome to the Admin Panel</strong></span><br>
        </div>
        <div class="card-body">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input class="form-control" id="exampleInputEmail1" type="email" name="adm_email" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" name="password" placeholder="Password" required>
                </div>
                <button class="btn btn-primary btn-block" name="login">Login</button>
            </form>
        </div>
    </div>
<?php $this->stop() ?>


















