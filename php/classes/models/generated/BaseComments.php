<?php

/**
 * BaseComments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_COMMENT
 * @property string $COMMENT
 * @property timestamp $DATE
 * @property integer $USER_ID
 * @property integer $TRIBUTE_ID
 * @property Users $Users
 * @property Tributes $Tributes
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComments extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('comments');
        $this->hasColumn('ID_COMMENT', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('COMMENT', 'string', 300, array(
             'type' => 'string',
             'length' => 300,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('DATE', 'timestamp', null, array(
             'type' => 'timestamp',
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
        $this->hasColumn('TRIBUTE_ID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users', array(
             'local' => 'USER_ID',
             'foreign' => 'ID_USER'));

        $this->hasOne('Tributes', array(
             'local' => 'TRIBUTE_ID',
             'foreign' => 'ID_TRIBUTE'));
    }
}