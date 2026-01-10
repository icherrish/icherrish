<?php
    require_once("../configuration/connection.php");

    $query = "SELECT * FROM `tabs` ";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    $records = [];
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
            $records[] = $row;
        }
    }
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
           <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title mb-0">Tab</h4>
                    </div>
                    <!-- <a href="?page=tabs_create" class="btn btn-primary">Add New</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th data-orderable="false">Image</th>
                                    <th data-orderable="false">Status</th>
                                    <th data-orderable="false" width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(count($records) > 0){
                                        foreach( $records as $data ){
                                        ?>
                                            <tr>
                                                <td><?= $data['title'] ?></td>
                                                <td><?= $data['url'] ?></td>
                                                <td>
                                                    <div class="mm-avatar col-md-2">
                                                        <img class="avatar-40 rounded" src="<?= '../upload/tabs/'.$data['image'] ?>" alt="#img" data-original-title="" title="">
                                                    </div>    
                                                </td> 
                                                <td><?= ($data['status'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center list-action">
                                                        <a class="badge bg-primary-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="?page=tabs_create&id=<?= $data['id'] ?>" ><i class="las la-edit"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php 
                                        }
                                    }else{ ?>
                                            <tr>
                                                <td class="text-center" colspan="5">No Record Found</td>
                                            </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>