<p>Dear <?php echo $User['User']['first_name'].' '.$User['User']['last_name']; ?>,</p>

<p>You may change your password using the link below.</p>
<?php $url = FULL_BASE_URL . '/users/reset_password_token/' . $User['User']['reset_password_token']; ?>
<p><?php echo $this->html->link('Click here', $url); ?></p>

<p>Your password won't change until you access the link above and create a new one.</p>