<?php
    require_once("../configuration/connection.php");

    $query = "SELECT * FROM `walkthrough` ";
    
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
                        <h4 class="card-title mb-0">WalkThrough</h4>
                    </div>
                        <a href="?page=walkthrough_create" class="btn btn-primary">Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th data-orderable="false">Image</th>
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
                                                <td><?= $data['subtitle'] ?></td>
                                                <td>
                                                    <div class="mm-avatar col-md-2">
                                                        <img class="avatar-40 rounded" src="<?= '../upload/walkthrough/'.$data['image'] ?>" alt="#img" data-original-title="" title="">
                                                    </div>    
                                                </td>
                                                <td><?= ($data['status'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center list-action">
                                                        <a class="badge bg-primary-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="?page=walkthrough_create&id=<?= $data['id'] ?>" ><i class="las la-edit"></i></a>
                                                       
                                                        <a class="badge bg-danger-light mr-2" data-toggle="modal" data-target="#exampleModal<?= $data['id'] ?>" data-placement="top" title="" data-original-title="Delete" href="#"><i class="las la-trash-alt"></i></a>
                                                       
                                                    </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are You Sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="exapleFormModal<?= $data['id'] ?>" method="post" action="./walkthrough/delete.php">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                            <h4>Are you sure want to delete ?</h4> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
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