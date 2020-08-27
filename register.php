<?php
require_once 'init/init.php';
    if(Input::exists())
    {
        // echo $_POST['blood_group'];
        $validate = new Validate();
        $validation = $validate->check($_POST,array(

            'name' => array(
                'require' => true,
                'min' => 3,
                'max' => 30
            ),
            'phone' => array(
                'require' => true,
                'fixed' => 11
            ),
            'city' => array(
                'require' => true,
                'min' => 4,
                'max' => 40
            ),
            'blood_group' => array(
                'require' => true
            ),
            'count' => array()
        ));
       /// $err = $validate->error();

        if($validate->passed())
        {
            $value = array('name'=>Input::get('name'),
            'phone'=>Input::get('phone'),
            'city' => Input::get('city'),
            'blood_group'=>Input::get('blood_group'),
            'count'=>(empty(Input::get('count'))) ? 0: Input::get('count'));
            if(DB::connect()->insert('donor',$value)){
                echo 'Successfully Inserted!';
                ///header('location:register.php');
            }
            else{
                echo "no";
            }
        }
    }

?>

<!-- ################### something wrong ##################-->


<!-- my code ends here -->
