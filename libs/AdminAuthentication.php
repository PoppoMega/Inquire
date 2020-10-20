<?php
require_once(BASEPATH . '/libs/AdminAccountsModel.php');

class AdminAuthentication
{
    public static function login($id,$pass)
    {
        //簡単にヴァり
        if(( '' === $id) || ('' === $pass))
        {
            //突っ返す
            return null;
        }

        $admin_account_obj = AdminAccountsModel::find($id);
        if(null === $admin_account_obj)
        {
            //NG
            return null;
        }
        //XXX
        /*
        if(null !== $admin_account_obj->lock_datetime)
        {
            //locktimeが今よりも先だったら

        }
        */
        //passwordチェック
        if(false !== password_verify($pass, $admin_account_obj->password))
        {
            //NG

            //XXXeroornumをインクリメント
            /*
                if(time() < strtotime())
            */
            return null;

        }
        //
        //XXX認証OKでエラーをクリア
        return $admin_account_obj;
        
    }    
}