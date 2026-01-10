<?php
    require_once("../configuration/connection.php");

    $query = "SELECT * FROM `right_header_icon` ";
    
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
                        <h4 class="card-title mb-0">Right Header Icon List</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th data-orderable="false">Image</th>
                                    <th>URL</th>
                                    <th data-orderable="false">Status</th>
                                    <th data-orderable="false" width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(count($records) > 0){
                                        foreach( $records as $k => $data ){                
                                        ?>
                                            <tr>
                                                <td><?= $data['title'] ?></td>
                                                <td>
                                                    <div class="mm-avatar col-md-2">
                                                        <img class="avatar-40 rounded" src="<?= '../upload/righticon/'.$data['image'] ?>" alt="#img" data-original-title="" title="">
                                                    </div>    
                                                </td>
                                                <td>
                                                    <?= $data['url'] ?>
                                                    <?php if($data['type'] == 'url' ) { ?>
                                                        <a class="badge bg-primary-light mr-2" data-toggle="modal" data-target="#exampleModal<?= $data['id'] ?>" title="" data-original-title="Edit" href="#" ><i class="las la-edit"></i></a>
                                                    <?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update URL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="exapleFormModal<?= $data['id'] ?>" method="post" action="./navigationicon/update.php">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                    <input type="hidden"  name="cat" value="right">
                    <div class="form-group col-md-12">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" class="form-control" name="url" id="url" value ="<?= isset($data['url'])  ? $data['url'] : '' ?>" placeholder="Enter URL" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                                
                                                
                                                </td>
                                                <td><?= ($data['status'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center list-action">
                                                        <form method="post" action="./navigationicon/update.php">
                                                            <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                            <input type="hidden"  name="cat" value="right">
                                                            <input type="hidden"  name="is_status" value="1">
                                                            <input type="hidden"  name="status" value="1">
                                                            
                                                            <button type="submit" class="btn btn-success btn-sm mr-2 <?= $data['status'] == 1 ? 'disabled' : '' ?>" <?= $data['status'] == 1 ? 'disabled' : '' ?>>Enable</button>
                                                        </form>
                                                        <form method="post" action="./navigationicon/update.php">
                                                            <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                            <input type="hidden"  name="cat" value="right">
                                                            <input type="hidden"  name="is_status" value="1">
                                                            <input type="hidden"  name="status" value="0">
                                                            <button type="submit" class="btn btn-secondary btn-sm  <?= $data['status'] == 0 ? 'disabled' : '' ?>" <?= $data['status'] == 0 ? 'disabled' : '' ?>>Disable</button>
                                                        </form>
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