<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/29/2019
     * Time: 2:31 PM
     */
    ?>
<form action="" method="post" id="editCar" name="editCar">
    <div class="modal-body">
    
        <input type="hidden" name="editId" id="editId" value="<?= $row['id']; ?>">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input type="text" value="<?= $row['name']; ?>" name="name" class="form-control" id="name">
                    <span id="name_error"></span>
                </div>
                
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Color:</label>
                    <input type="text" value="<?= $row['color']; ?>" name="color" class="form-control" id="color">
                    <span id="color_error"></span>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Price:</label>
                    <input type="text" value="<?= $row['price']; ?>" name="price" class="form-control" id="price">
                    <span id="price_error"></span>
                </div>
                
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Transmission:</label>
                    <select name="transmission" class="form-control" id="">
                        <option value="">Chose</option>
                        <option value="Automatic" <?= ($row['transmission'] == "Automatic")? 'selected' : ''?>>Automatic</option>
                        <option value="Menual" <?= ($row['transmission'] == "Menual")? 'selected' : ''?>>Menual</option>
                    </select>
                </div>
            </div>
        </div>
    
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
