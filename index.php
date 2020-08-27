<?php


require_once 'init/init.php';
// include_once 'res/header.php';

?>


<div class="container">
  <div class="text-center mt-5">
    <p class="display-4">Add new donor</p>
  </div>
    <form class="pt-2 pb-5 mx-auto" method="post" action="<?php echo 'register.php';//php header('location:register.php');?>" style="max-width: 400px">
            <div class="form-group">
                <label>Donor name</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input name="phone" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Current City</label>
                <input name="city" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Blood Group</label>
                <select name="blood_group" class="form-control" id="exampleFormControlSelect1">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="form-group">
                <label>Donation count</label>
                <input name="count" type="number" class="form-control">
                <small id="emailHelp" class="form-text text-muted">This field is optional.</small>
            </div>

            <!-- error message -->
    
            <!-- error message -->
            <button type="submit" name="add_donor" class="btn btn-primary btn-block">Add donor</button>
    </form>
</div>



<?php include 'res/footer.php'; ?>











