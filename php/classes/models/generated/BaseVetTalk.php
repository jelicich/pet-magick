<?php

/**
 * BaseVetTalk
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_VET_TALK
 * @property string $TITLE
 * @property string $CONTENT
 * @property timestamp $DATE
 * @property integer $USER_ID
 * @property integer $PIC_ID
 * @property integer $ANIMAL_CATEGORY_ID
 * @property Users $Users
 * @property Pics $Pics
 * @property AnimalCategories $AnimalCategories
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVetTalk extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('vet_talk');
        $this->hasColumn('ID_VET_TALK', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('TITLE', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('CONTENT', 'string', null, array(
             'type' => 'string',
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
        $this->hasColumn('PIC_ID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ANIMAL_CATEGORY_ID', 'integer', 4, array(
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

        $this->hasOne('Pics', array(
             'local' => 'PIC_ID',
             'foreign' => 'ID_PIC'));

        $this->hasOne('AnimalCategories', array(
             'local' => 'ANIMAL_CATEGORY_ID',
             'foreign' => 'ID_ANIMAL_CATEGORY'));
    }
}