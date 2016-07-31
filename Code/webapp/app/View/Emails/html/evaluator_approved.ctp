<p>Dear <?php echo $User['User']['first_name'].' '.$User['User']['last_name']; ?>,</p>

<p>Congratulations!, your evaluator account has been approved.</p>
<?php // $url = FULL_BASE_URL . '/users/reset_password_token/' . $User['User']['reset_password_token']; ?>
<p><?php // echo $this->html->link("Dr", 'http://ec2-107-22-140-190.compute-1.amazonaws.com/'); ?></p>

<p>You may start using our application by clicking on the following link: <?php echo $this->html->link("DRAMA", 'http://ec2-107-22-140-190.compute-1.amazonaws.com/users/login'); ?></p>

<p>Thanks and have a nice day!</p>