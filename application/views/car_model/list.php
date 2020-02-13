<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/28/2019
     * Time: 2:59 PM
     */
    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codingnator Crud</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap-asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap-asset/css/style.css">
    
</head>
<body>

<div class="header">
    <div class="container">
        <h3 class="heading">First Codingnator Application</h3>
    </div>
</div>

<div class="container">
    <div class="row pt-5">
        
        <div class="col-md-6">
            <h4>Car Model</h4>
        </div>
        
        <div class="col-md-6 text-right">
            <a href="javascript:void(0);" class="btn btn-primary" onclick="showModel();">Create</a>
        </div>
        
        <div class="col-md-12 pt-3">
            <table class="table table-striped" id="carModelList">
                
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Transmission</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                
                <?php if(!empty($rows)){?>
                    <?php foreach ($rows as $row) {
                        $data['row'] = $row;
                        $this->load->view('car_model/car_row',$data);
                    }
                        ?>
                <?php }else{?>
                    <tr>
                        <td>Record Not Found</td>
                    </tr>
                <?php } ?>
               
            </table>
        </div>
    </div>
</div>

<!--Add Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Car </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="response">
    
            </div>
            
        </div>
    </div>
</div>

<!--Message response-->
<div class="modal fade" id="messageModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body">
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>

<!--Delete Data-->
<div class="modal fade" id="DeleteModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="deleteNow()" class="btn btn-danger">Yes</button>
            </div>
        
        </div>
    </div>
</div>

<!--This is bootstrap js load file-->
<script src="<?php echo base_url(); ?>/bootstrap-asset/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap-asset/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function showModel() {
        $("#addModal").modal("show");
        $("#addModal .modal-title").html("Create Car");
        
        $.ajax({
            url: '<?php echo base_url(),'/index.php/CarModel/showCreateFrom'; ?>',
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (response) {
                $("#response").html(response['html']);
            }
        });
    }
    
    //Add Modal
    $(document).ready(function () {
        $("body").on("submit","#createCar",function (e) {
            e.preventDefault();
    
            $.ajax({
                url: '<?php echo base_url(),'/index.php/CarModel/save'; ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                    
                    if(response['status'] == 0)
                    {
                        if(response['name'] != "")
                        {
                            $("#name_error").html(response['name']).addClass('invalid-feedback d-block');
                            $("#name").addClass('is-invalid');
                        }else {
                            $("#name_error").html("").removeClass('invalid-feedback d-block');
                            $("#name").removeClass('is-invalid');
                        }
    
                        if(response['color'] != "")
                        {
                            $("#color_error").html(response['color']).addClass('invalid-feedback d-block');
                            $("#color").addClass('is-invalid');
                        }else {
                            $("#color_error").html("").removeClass('invalid-feedback d-block');
                            $("#color").removeClass('is-invalid');
                        }
    
                        if(response['price'] != "")
                        {
                            $("#price_error").html(response['price']).addClass('invalid-feedback d-block');
                            $("#price").addClass('is-invalid');
                        }else {
                            $("#price_error").html("").removeClass('invalid-feedback d-block');
                            $("#price").removeClass('is-invalid');
                        }
                    }else {
    
                        $("#addModal").modal("hide");
                        $("#messageModel .modal-body").html(response['message']);
                        $("#messageModel").modal("show");
                        
                        $("#name_error").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
    
                        $("#color_error").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');
    
                        $("#price_error").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');
                        
                        $("#carModelList").append(response['row']);
                    }
                }
            });
        });
    });
    
    function showEditForm(id) {
        $("#addModal .modal-title").html("Edit Car");
        
        $.ajax({
            url: '<?php echo base_url(),'/index.php/CarModel/getCarModel/'; ?>'+id,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                $("#addModal #response").html(response['html']);
                $("#addModal").modal("show");
            }
        });
    }
    
    //edit Modal
    $(document).ready(function () {
        $("body").on("submit","#editCar",function (e) {
            e.preventDefault();
            
            //var editId = $("#editId").val();
        
            $.ajax({
                url: '<?php echo base_url(),'/index.php/CarModel/updateModal'; ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                
                    if(response['status'] == 0)
                    {
                        if(response['name'] != "")
                        {
                            $("#name_error").html(response['name']).addClass('invalid-feedback d-block');
                            $("#name").addClass('is-invalid');
                        }else {
                            $("#name_error").html("").removeClass('invalid-feedback d-block');
                            $("#name").removeClass('is-invalid');
                        }
    
                        if(response['color'] != "")
                        {
                            $("#color_error").html(response['color']).addClass('invalid-feedback d-block');
                            $("#color").addClass('is-invalid');
                        }else {
                            $("#color_error").html("").removeClass('invalid-feedback d-block');
                            $("#color").removeClass('is-invalid');
                        }
    
                        if(response['price'] != "")
                        {
                            $("#price_error").html(response['price']).addClass('invalid-feedback d-block');
                            $("#price").addClass('is-invalid');
                        }else {
                            $("#price_error").html("").removeClass('invalid-feedback d-block');
                            $("#price").removeClass('is-invalid');
                        }
                        
                    }else {
                        $("#addModal").modal("hide");
                        $("#messageModel .modal-body").html(response['message']);
                        $("#messageModel").modal("show");
    
                        $("#name_error").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
    
                        $("#color_error").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');
    
                        $("#price_error").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');
                        
                        var id = response['row']['id'];
                        $("#row-"+id+" .modelName").html(response['row']['name']);
                        $("#row-"+id+" .modelColor").html(response['row']['color']);
                        $("#row-"+id+" .modelPrice").html(response['row']['price']);
                        $("#row-"+id+" .modelTransmission").html(response['row']['transmission']);
                    }
                }
            });
        });
    });
    
    function confirmDeleteModel(id)
    {
        $("#DeleteModel").modal("show");
        $("#DeleteModel .modal-body").html("Are your sure want to Delete #"+id);
        $("#DeleteModel").data("id",id);
        
    }
    
    function deleteNow() {
        var id = $("#DeleteModel").data('id');
    
        $.ajax({
            url: '<?php echo base_url(),'/index.php/CarModel/deleteModel/'; ?>'+id,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['status'] == 1)
                {
                    $("#DeleteModel").modal("hide");
                    $("#messageModel .modal-body").html(response['msg']);
                    $("#messageModel").modal("show");
                }else {
                    $("#DeleteModel").modal("hide");
                    $("#messageModel .modal-body").html(response['msg']);
                    $("#messageModel").modal("show");
                }
            }
        });
    }
</script>
</body>
</html>
