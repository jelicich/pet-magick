<?php

/**
 * BaseProjects
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_PROJECT
 * @property string $TITLE
 * @property string $DESCRIPTION
 * @property integer $USER_ID
 * @property integer $ALBUM_ID
 * @property Users $Users
 * @property Albums $Albums
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProjects extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('projects');
        $this->hasColumn('ID_PROJECT', 'integer', 4, array(
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
        $this->hasColumn('DESCRIPTION', 'string', null, array(
             'type' => 'string',
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
        $this->hasOne('Users', array(
             'local' => 'USER_ID',
             'foreign' => 'ID_USER'));

        $this->hasOne('Albums', array(
             'local' => 'ALBUM_ID',
             'foreign' => 'ID_ALBUM'));
    }
}