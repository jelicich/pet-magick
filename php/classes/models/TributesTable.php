<?php

/**
 * TributesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TributesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TributesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Tributes');
    }

    public function createTribute($array)
    {
    	//var_dump($array);
    	$t = new Tributes;
    	$t->TITLE = $array['tr-title'];
    	$t->CONTENT = $array['tr-msg'];

    	if(!empty($array['tr-since']))
    		$t->SINCE = $array['tr-since'];
    	if(!empty($array['tr-thru']))
    		$t->THRU = $array['tr-thru'];
    	
    	$t->USER_ID = $array['u'];
    	$t->PET_ID = $array['p'];

    	$t->save();
    	return $t->ID_TRIBUTE;
    }

    public function updateTribute($array)
    {
        $q = Doctrine_Query::create()
            ->update('Tributes t')
            ->set('t.TITLE', '?', $array['tr-title'] )
            ->set('t.CONTENT', '?', $array['tr-msg'] );
            if(!empty($array['tr-since']))
                $q->set('t.SINCE','?',$array['tr-since']);
            if(!empty($array['tr-thru']))
                $q->set('t.THRU','?',$array['tr-thru']);
            $q->where('t.ID_TRIBUTE =?',$array['tr-id']);

        $q->execute();
    }

    public function getTribute($id)
    {
    	$q = Doctrine_Query::create()
    		->from('Tributes t')
    		->where('t.ID_TRIBUTE = ?', $id);
    	$r = $q->execute();
    	return $r->toArray();

    }

    public function getTributeByPet($id)
    {
        $q = Doctrine_Query::create()
            ->from('Tributes')
            ->where('PET_ID =?',$id);

        $r = $q->execute();
        return $r->toArray();
    }

    public function deleteTribute($id)
    {
        $q = Doctrine_Query::create()
            ->delete('Tributes t')
            ->where('t.ID_TRIBUTE = ?', $id );
        $q->execute();
    }

    public function deleteTributeByPet($id)
    {
        $q = Doctrine_Query::create()
            ->delete('Tributes t')
            ->where('t.PET_ID = ?', $id );
        $q->execute();
    }
}