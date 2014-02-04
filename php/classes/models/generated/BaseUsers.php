<?php

/**
 * BaseUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_USER
 * @property string $NAME
 * @property string $LASTNAME
 * @property string $NICKNAME
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property string $ABOUT
 * @property integer $COUNTRY_ID
 * @property integer $REGION_ID
 * @property integer $CITY_ID
 * @property integer $PIC_ID
 * @property integer $ALBUM_ID
 * @property integer $RANK
 * @property string $TOKEN
 * @property Pics $Pics
 * @property Albums $Albums
 * @property Countries $Countries
 * @property Regions $Regions
 * @property Cities $Cities
 * @property Doctrine_Collection $Answers
 * @property Doctrine_Collection $Blogs
 * @property Doctrine_Collection $Comments
 * @property Doctrine_Collection $Conversations
 * @property Doctrine_Collection $Conversations_2
 * @property Doctrine_Collection $Messages
 * @property Doctrine_Collection $News
 * @property Doctrine_Collection $Organizations
 * @property Doctrine_Collection $Pets
 * @property Doctrine_Collection $Projects
 * @property Doctrine_Collection $Questions
 * @property Doctrine_Collection $Tributes
 * @property Doctrine_Collection $VetTalk
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsers extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('ID_USER', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('NAME', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('LASTNAME', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('NICKNAME', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('EMAIL', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('PASSWORD', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             'fixed' => true,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('ABOUT', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('COUNTRY_ID', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('REGION_ID', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CITY_ID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
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
        $this->hasColumn('ALBUM_ID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('RANK', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('TOKEN', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             'fixed' => true,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pics', array(
             'local' => 'PIC_ID',
             'foreign' => 'ID_PIC'));

        $this->hasOne('Albums', array(
             'local' => 'ALBUM_ID',
             'foreign' => 'ID_ALBUM'));

        $this->hasOne('Countries', array(
             'local' => 'COUNTRY_ID',
             'foreign' => 'CountryId'));

        $this->hasOne('Regions', array(
             'local' => 'REGION_ID',
             'foreign' => 'RegionID'));

        $this->hasOne('Cities', array(
             'local' => 'CITY_ID',
             'foreign' => 'CityId'));

        $this->hasMany('Answers', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Blogs', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Comments', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Conversations', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_1_ID'));

        $this->hasMany('Conversations as Conversations_2', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_2_ID'));

        $this->hasMany('Messages', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('News', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Organizations', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Pets', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Projects', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Questions', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('Tributes', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));

        $this->hasMany('VetTalk', array(
             'local' => 'ID_USER',
             'foreign' => 'USER_ID'));
    }
}