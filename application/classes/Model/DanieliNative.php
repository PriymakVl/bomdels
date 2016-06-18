<?php defined('SYSPATH') or die('No direct script access.');

class Model_DanieliNative extends Model_Detail {
    
    public function __construct()
    {
        $this->tableName = 'danieli_native';
    }
    
     public function addAuto($data)
    {
        $sql = "INSERT INTO $this->tableName (Job, Owner, Member, Item, Revision,  Version, Sheet, Sheets, Size, Assembly, File, Norme, Drawing, Weight, Quantity, Total, MU, DimUnit, Costruction, Title, Title_other) 
        VALUES (:Job, :Owner, :Member, :Item, :Revision,  :Version, :Sheet, :Sheets, :Size, :Assembly, :File, :Norme, :Drawing, :Weight, :Quantity, :Total, :MU, :DimUnit, :Costruction, :Title, :Title_other)";
        $query = DB::query(Database::INSERT, $sql)->bind(':Job', $data['Job'])->bind(':Owner', $data['Owner'])->bind(':Member', $data['Member'])->bind(':Item', $data['Item'])
        ->bind(':Revision', $data['Revision'])->bind(':Version', $data['Version'])->bind(':Sheet', $data['Sheet'])->bind(':Sheets', $data['Sheets'])        
        ->bind(':Size', $data['Size'])->bind(':Assembly', $data['Assembly'])->bind(':File', $data['File'])->bind(':Norme', $data['Norme'])
        ->bind(':Drawing', $data['Drawing'])->bind(':Weight', $data['Weight'])->bind(':Quantity', $data['Quantity'])->bind(':Total', $data['Total']) 
        ->bind(':MU', $data['MU'])->bind(':DimUnit', $data['Dim Unit'])->bind(':Costruction', $data['Costruction'])->bind(':Title', $data['Title'])->bind(':Title_other', $data['Title(other)']);        
        return $query->execute();
    }
    
    public function getDetailByCode($code) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `Member` = :code LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code); 
        $res = $query->execute()->as_array();
        return $res;
    }
}