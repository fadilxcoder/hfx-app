<?php 
    $this->layout('layouts/base.layout', [
        'title' => 'Admin panel - Dashboard'
    ]);
?>
<?php $this->start('body') ?>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> <?php echo $this->e($this->uppercase('users'))?></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>UUID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Last login (Time)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if (!empty($users)) {
                            foreach ($users as $_users) {
                    ?>
                        <tr>
                            <td><?php echo $_users['uuid'] ?></td>
                            <td><?php echo $_users['name'] ?></td>
                            <td><?php echo $_users['username'] ?></td>
                            <td><?php echo $_users['last_login'] ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>
    