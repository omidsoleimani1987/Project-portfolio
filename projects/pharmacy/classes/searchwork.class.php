<?php
/**
 * this class gets a title for medicine from user and reads just related record to the given title and show it to the user
 * in this class(page) we need to create a sum row and sum column of the values from table and update it every time we get to this page, because or default structure is that our excel file has no sum row and column
 */
class Searchwork extends SetQuery {
    
    /**
     * these three properties are string values
     *
     * @var string
     */
    public  $title = '';
    public  $tableName = '';
    public  $error = array('title'=>'');
    /**
     * these properties are integer values
     *
     * @var int
     */
    public $rowSumme_k = 0;
    public $rowSumme_v = 0;
    
    public $Adler_k = 0;
    public $Billroth_k = 0;
    public $Citygate_k = 0;
    public $Hoffnung_k = 0;
    public $Retz_k = 0;
    public $Wienerberg_k = 0;
    public $phoenix_k = 0;
    public $Kwizda_k = 0;
    public $Herba_k = 0;
    public $Summe_k = 0;
    public $Adler_v = 0;
    public $Billroth_v = 0;
    public $Citygate_v = 0;
    public $Hoffnung_v = 0;
    public $Retz_v = 0;
    public $Wienerberg_v = 0;
    public $phoenix_v = 0;
    public $Kwizda_v = 0;
    public $Herba_v = 0;
    public $Summe_v = 0;

    /**
     * by the creation of class , we need the name of table for further operations
     *
     * @param string $data
     */
    function __construct($data) {
        $this->tableName = $data;
    }

    /**
     * by the loading the page, first we read all the data from table(in DB)
     *
     * @return array
     */
    public function readMed() {
        $allResult = $this->readAllMed($this->tableName);
        return $allResult;
    }
    
    /**
     * validate the title of medicine, which user searched for it
     *
     * @param string $data
     * @return void
     */
    public function titleValidate($data) {
        if(empty($data) || trim($data) == '') {
            $this->error['title'] = 'Das Feld "Bezeichnung" ist auszufüllen.';
        } else {
            $this->title = htmlspecialchars($data);
        }
    }

    /**
     * checks first the error array, when there is an error or errors, it returns an html to the screen to shows to the user that inserted field are not correct or fix the issues
     *
     * @return void
     */
    public function checkError() {
        $check = true;
        $error = $this->error;
        foreach($error as $key=>$value) {
            if($value !== '') {
                echo '<h1 class="error"><i class="fas fa-exclamation-triangle"></i> Bitte überprüfen Sie Ihre Eingaben!</h1>';
                $check = false;
                break;
            }
        }
        
        //the main function(s) of class - showing to user a html table with the infos of related title
        if($check) {
            $titleArray = $this->getTitlename($this->tableName, $this->title);
            echo '<table class="second">';
            echo '<tr id="header">';
            echo "<th>ID</th><th>PZN</th><th>Bezeichnung</th><th>Menge</th><th>Einheit</th><th>Ablauf</th><th>Charge</th><th>Bestellt</th><th>Bekommt</th><th>Datum</th>";
            echo "</tr>";
            for($i=0; $i<count($titleArray); $i++) {
                echo '<tr class="second">';
                foreach($titleArray[$i] as $key => $value) {
                    $medId = $titleArray[$i]['id'];
                    $class = '';
                    $Summe_k = intval($titleArray[$i]['Summe_k']);
                    $Summe_v = intval($titleArray[$i]['Summe_v']);
                    if($Summe_v == $Summe_k){
                        $class = 'full';
                    } elseif(0 < $Summe_v) {
                        $class = 'half';
                    } else {
                        $class = 'none';
                    }
                    echo '<td class="' . $class . '"><a class="table-link" href="main_page.php?medId=' . $medId . '">'. $value . '</a></td>';
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    /**
     * here we create the sum column (the sum of each row)
     * and update the sum row of the table every time that page loads
     * @return void
     */
    public function setRowSumme() {
        $ResultArray = $this->readAllMed($this->tableName);
        $summeId = count($ResultArray) - 1;
        $failed = [];
        
        for($i=0; $i<$summeId; $i++) {
            $id = $i + 1;
            $this->rowSumme_k = intval($ResultArray[$i]['adler_k']) + intval($ResultArray[$i]['billroth_k']) + intval($ResultArray[$i]['citygate_k']) + intval($ResultArray[$i]['hoffnung_k']) + intval($ResultArray[$i]['retz_k']) + intval($ResultArray[$i]['wienerberg_k']) + intval($ResultArray[$i]['phoenix_k']) + intval($ResultArray[$i]['kwizda_k']) + intval($ResultArray[$i]['herba_k']);

            $this->rowSumme_v = intval($ResultArray[$i]['adler_v']) + intval($ResultArray[$i]['billroth_v']) + intval($ResultArray[$i]['citygate_v']) + intval($ResultArray[$i]['hoffnung_v']) + intval($ResultArray[$i]['retz_v']) + intval($ResultArray[$i]['wienerberg_v']) + intval($ResultArray[$i]['phoenix_v']) + intval($ResultArray[$i]['kwizda_v']) + intval($ResultArray[$i]['herba_v']);

            $createColumn = $this->createSummeColumn($this->tableName, $id, $this->rowSumme_k, $this->rowSumme_v);
            if($createColumn != true) {
                $failed[] = $i;
            }
        }
        if(count($failed) == 0) {
            return true;
        }
    }
    
    /**
     * here we create the sum row (the sum of each column)
     * and update the sum column of the table every time that page loads
     * @return void
     */
    public function setcolumnSumme() {
        $ResultArray = $this->readAllMed($this->tableName);
        $summeId = count($ResultArray) - 1;
        
        for($i=0; $i<$summeId; $i++) {
            $this->Adler_k += intval($ResultArray[$i]['adler_k']);
            $this->Billroth_k += intval($ResultArray[$i]['billroth_k']);
            $this->Citygate_k += intval($ResultArray[$i]['citygate_k']);
            $this->Hoffnung_k += intval($ResultArray[$i]['hoffnung_k']);
            $this->Retz_k += intval($ResultArray[$i]['retz_k']);
            $this->Wienerberg_k += intval($ResultArray[$i]['wienerberg_k']);
            $this->phoenix_k += intval($ResultArray[$i]['phoenix_k']);
            $this->Kwizda_k += intval($ResultArray[$i]['kwizda_k']);
            $this->Herba_k += intval($ResultArray[$i]['herba_k']);
            $this->Summe_k += intval($ResultArray[$i]['Summe_k']);
            $this->Adler_v += intval($ResultArray[$i]['adler_v']);
            $this->Billroth_v += intval($ResultArray[$i]['billroth_v']);
            $this->Citygate_v += intval($ResultArray[$i]['citygate_v']);
            $this->Hoffnung_v += intval($ResultArray[$i]['hoffnung_v']);
            $this->Retz_v += intval($ResultArray[$i]['retz_v']);
            $this->Wienerberg_v += intval($ResultArray[$i]['wienerberg_v']);
            $this->phoenix_v += intval($ResultArray[$i]['phoenix_v']);
            $this->Kwizda_v += intval($ResultArray[$i]['kwizda_v']);
            $this->Herba_v += intval($ResultArray[$i]['herba_v']);
            $this->Summe_v += intval($ResultArray[$i]['Summe_v']);
        }

        $createRow = $this->createSummeRow($this->tableName, $this->Adler_k, $this->Billroth_k, $this->Citygate_k, $this->Hoffnung_k, $this->Retz_k, $this->Wienerberg_k, $this->phoenix_k, $this->Kwizda_k, $this->Herba_k, $this->Summe_k, $this->Adler_v, $this->Billroth_v, $this->Citygate_v, $this->Hoffnung_v, $this->Retz_v, $this->Wienerberg_v, $this->phoenix_v, $this->Kwizda_v, $this->Herba_v, $this->Summe_v);
        if($createRow == true) {
            return $ResultArray;
        } else{
            echo '<h1 class="error">Die Summe Reihe wurde nicht aktuallisiert<h1>';
        }

    }

    /**
     * get the info of table to preview to user
     *
     * @return array
     */
    public function getSumme() {
        $ResultArray = $this->readAllMed($this->tableName);
        return $ResultArray;
    }
        
}