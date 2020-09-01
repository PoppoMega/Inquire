<?php

require_once('model.php');

class TestModel extends Model
{
    //
    protected static $table_name = 'test';
    protected static $pk_name = 'test_id';
}