<?php 
    $this->layout('layouts/base.layout', [
        'title' => 'Admin panel - Dashboard'
    ]);
?>
<?php $this->start('body') ?>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> 10 Latest Products</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            // $result = latest10products();
                            // if(!empty($result)){
                                // foreach($result as $_result){
                    ?>
                        <tr>
                            <td width="25%"><?php //echo $_result['name']; ?></td>
                            <td width="60%"><?php //echo $_result['description']; ?></td>
                            <td width="10%"><?php //echo $_result['price']; ?></td>
                            <td width="5%"><img src="../images/<?php //echo $_result['main_image']; ?>" class="img-fluid rounded-circle"></td>
                        </tr>
                        <?php
                                // }
                            // }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>
    