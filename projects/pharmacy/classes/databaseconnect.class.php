<?php

/**
 * this class is the only class that communicate with the database for starting the connection to db 
 */
class DatabaseConnect {
    /**
     * all these are string properties for db connection
     *
     * @var string
     */
    private $host = "mysql.omid-soleimani.com";
    private $username = "omidsoleimani";
    private $password = "Registered1366";
    private $databaseName = "pharmacyprojectomid";
    
    /**
     * this method runs the pdo connection 
     *
     * @return void
     */
    protected function connect() {
      
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName;
        
        $pdo = new PDO($dsn, $this->username, $this->password);
        
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo; 
    }
}