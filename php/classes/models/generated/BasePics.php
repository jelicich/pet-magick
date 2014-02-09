<?php

/**
 * BasePics
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_PIC
 * @property string $PIC
 * @property string $THUMB
 * @property timestamp $DATE
 * @property string $CAPTION
 * @property integer $THUMBNAIL
 * @property integer $ALBUM_ID
 * @property Doctrine_Collection $Pics
 * @property Albums $Albums
 * @property Doctrine_Collection $Blogs
 * @property Doctrine_Collection $Organizations
 * @property Doctrine_Collection $Pets
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $VetTalk
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePics extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pics');
        $this->hasColumn('ID_PIC', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('PIC', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('THUMB', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
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
        $this->hasColumn('CAPTION', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('THUMBNAIL', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ALBUM_ID', 'integer', 4, array(
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
        $this->hasMany('Pics', array(
             'local' => 'ID_PIC',
             'foreign' => 'THUMBNAIL'));

        $this->hasOne('Albums', array(
             'local' => 'ALBUM_ID',
             'foreign' => 'ID_ALBUM'));

        $this->hasMany('Blogs', array(
             'local' => 'ID_PIC',
             'foreign' => 'PIC_ID'));

        $this->hasMany('Organizations', array(
             'local' => 'ID_PIC',
             'foreign' => 'PIC_ID'));

        $this->hasMany('Pets', array(
             'local' => 'ID_PIC',
             'foreign' => 'PIC_ID'));

        $this->hasMany('Users', array(
             'local' => 'ID_PIC',
             'foreign' => 'PIC_ID'));

        $this->hasMany('VetTalk', array(
             'local' => 'ID_PIC',
             'foreign' => 'PIC_ID'));
    }
}