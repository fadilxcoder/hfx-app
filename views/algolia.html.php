<?php 
    $this->layout('layouts/base.layout', [
        'title' => 'Admin panel - Dashboard'
    ]);
?>
<?php $this->start('body') ?>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Algolia</div>
        <div class="card-body">
            <form class="form-inline text-center" action="" method="POST">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" value="<?php echo $search; ?>" placeholder="Name">
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <button class="btn btn-primary btn-default" name="search">Search..</button>
            </form>
            <hr/>
            <?php if (null !== $results) { ?>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Obj ID</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($results as $_r) {
                    ?>
                        <tr>
                            <td><?php echo $_r['username'] ?></td>
                            <td><?php echo $_r['name'] ?></td>
                            <td><?php echo $_r['objectID'] ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->stop() ?>
    