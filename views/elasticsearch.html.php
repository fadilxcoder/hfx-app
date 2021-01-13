<?php 
    $this->layout('layouts/base.layout', [
        'title' => 'Admin panel - Dashboard'
    ]);
?>
<?php $this->start('body') ?>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Elasticsearch</div>
        <div class="card-body">
            <form class="form-inline text-center" action="" method="POST">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Name">
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="addr" placeholder="Address">
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="Email">
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
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($results as $_r) {
                    ?>
                        <tr>
                            <td><?php echo $_r['name'] ?></td>
                            <td><?php echo $_r['address'] ?></td>
                            <td><?php echo $_r['email'] ?></td>
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
    