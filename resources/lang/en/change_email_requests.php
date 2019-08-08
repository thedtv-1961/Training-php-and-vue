<?php

return [
    'status' => [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ],
    'index' => [
        'change_email_requests_management' => 'Change email request management',
        'status' => 'Status',
        'user_name' => 'User Name',
        'email_change' => 'Email change',
        'approve' => 'Approve',
        'reject' => 'Reject',
        'action' => 'Action',
        'update_fail' => "Update failed!",
        'email_existed' => "Email existed",
        'successfully_updated' => 'Successfully updated',
    ],
    'mail_title' => [
        'approve' => '[Training-php-and-vue] Your update email has been approved',
        'reject' => '[Training-php-and-vue] Your update email has been rejected',
    ],
    'mail_content' => [
        'approve' => 'Hi <strong>:name</strong>,<br> We glad inform for you about your request change mail has been approved,<br>If you have any question please let us know,<br><br>Thanks,',
        'reject' => 'Hi <strong>:name</strong>,<br> We really sorry inform for you about your request change mail has been rejected,<br>If you have any question please let us know,<br><br>Thanks,',
    ],
    'confirm_message' => 'Are you sure?',
];
