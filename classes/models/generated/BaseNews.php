<?php

/**
 * BaseNews
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_NEWS
 * @property string $NEWS
 * @property date $DATE
 * @property integer $USER_ID
 * @property Users $Users
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNews extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('news');
        $this->hasColumn('ID_NEWS', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('NEWS', 'string', 300, array(
             'type' => 'string',
             'length' => 300,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('DATE', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('USER_ID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users', array(
             'local' => 'USER_ID',
             'foreign' => 'ID_USER'));
    }
}