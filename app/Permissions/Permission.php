<?php

namespace App\Permissions;

class Permission
{
    public const CAN_ADD_MEMBER = 'add-member';
    public const CAN_DELETE_MEMBER = 'delete-member';
    public const CAN_EDIT_MEMBER = 'edit-member';

    public const CAN_ADD_USER = 'add-user';
    public const CAN_DELETE_USER = 'delete-user';

    public const CAN_ADD_COURSE = 'add-course';
    public const CAN_DELETE_COURSE = 'delete-course';
    public const CAN_EDIT_COURSE = 'edit-course';

    public const CAN_ADD_COMPANY = 'add-compant';

    public const CAN_ADD_PAYMENT = 'add-payment';
    public const CAN_DELETE_PAYMENT = 'delete-payment';

    public const CAN_SEND_QUOTA = 'send-quota';

    public const CAN_OPEN_YEAR = 'open-year';

    public const CAN_ACCESS_SETTINGS = 'app-settings';

    public const CAN_EDIT_EMAIL_SETTING = 'email-settings';
}
