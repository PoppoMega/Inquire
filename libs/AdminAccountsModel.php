<?php
require_once(BASEPATH . '/libs/model.php');

class AdminAccountsModel extends Model
{
    //
    protected static $table_name = 'admin_accounts';
    protected static $pk_name = 'login_id';
    
}