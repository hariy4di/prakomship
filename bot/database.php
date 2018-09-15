<?php

class PDOConnection
{
	private $dbh;

	function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "p4ssw0rd!";
		$dbname = "db_peraturan";

		try {
		    $this->dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    // set the PDO error mode to exception
		    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    echo "Connected successfully";
		} catch (PDOException $e) {
		    echo "Connection failed: " . $e->getMessage();
		}
	}

	public function select($sql)
	{
        $result = $this->dbh->query($sql);
        /*$sql_stmt->execute();
        $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);*/

        return $result;
    }

    /*public function insert($sql)
    {
        $sql_stmt = $this->dbh->prepare($sql);
        
        try {
            $result = $sql_stmt->execute();
        } catch (PDOException $e) {
            trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
        }

        if ($result) {
            return $sql_stmt->rowCount();
        }
    }

    function __destruct() {
        $this->dbh = NULL;
    }*/
}

class MIConnection
{
	private $cn;

	function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "p4ssw0rd!";
		$dbname = "db_peraturan";

		try {
		    $this->cn = mysqli_connect($servername, $username, $password, $dbname);
		    
		    echo "Connected successfully";
		} catch (PDOException $e) {
		    echo "Connection failed: " . $e->getMessage();
		}
	}

	public function select($sql)
	{
        $result = mysqli_query($this->cn,$sql);

        return $result;
    }

    /*public function insert($sql)
    {
        $sql_stmt = $this->dbh->prepare($sql);
        
        try {
            $result = $sql_stmt->execute();
        } catch (PDOException $e) {
            trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
        }

        if ($result) {
            return $sql_stmt->rowCount();
        }
    }

    function __destruct() {
        $this->dbh = NULL;
    }*/
}

//$conn = new PDOConnection();
$conn = new MIConnection();


// fungsi pencarian
function search($q)
{
    global $conn;
    $hasil = '';

    try {
    	
    	/*
		|--------------------------------------------------------------------------
		| GET KATA KUNCI - INPUT DARI USER
		|--------------------------------------------------------------------------
		*/
		//Kata Kunci
		$search = htmlspecialchars($q);

		/*
		|--------------------------------------------------------------------------
		| DINAMIC QUERY KATA KUNCI - DINAMIC QUERY KATEGORI
		|--------------------------------------------------------------------------
		*/
		// Kata Kunci
		/*$search_exploded = explode(" ", $search);
		$firsttime=true;
		$construct="";
		foreach ($search as $search_each) {
			if($firsttime){
				$construct .= "WHERE";
				$firsttime  = false;
			}
			else{
				$construct .= "AND";
			}
			$construct .= " (
				UPPER(nomor) LIKE UPPER('%".$search_each."%') OR
				UPPER(tahun) LIKE UPPER('%".$search_each."%') OR
				UPPER(tentang) LIKE UPPER('%".$search_each."%') OR
				UPPER(abstrak) LIKE UPPER('%".$search_each."%')
			) ";
		}*/
		
		/*
		|--------------------------------------------------------------------------
		| TAMPILKAN PERATURAN DENGAN STATUS_ID = 4 (TERBIT)
		|--------------------------------------------------------------------------
		*/
		$datas = $conn->select("
			SELECT 	id,
					nomor,
					tahun,
					tentang
			FROM tb_peraturan
			WHERE UPPER(nomor) LIKE UPPER('%".$search."%') OR
			UPPER(tahun) LIKE UPPER('%".$search."%') OR
			UPPER(tentang) LIKE UPPER('%".$search."%') OR
			UPPER(abstrak) LIKE UPPER('%".$search."%')
			AND status_id='4' AND aktif='1'
			ORDER BY jenis_id
			LIMIT 5
		");

    	if (count($datas) > 0) {
	        
	        $hasil = "Top 5 Hasil Pencarian:";
	        $i=0;
	        foreach ($datas as $data) {
	        	$i++;
	        	$hasil .= "\n".$i.". ".$data->nomor." tentang ".$data->tentang;
	        }

	        return $hasil;
	    }
	    else{
	    	$hasil = 'Maaf, pencarian tidak ditemukan..';

	    	return $hasil;
	    }
    } catch (Exception $e) {
    	//return $e;
    	return 'Terdapat kesalahan program!';
    }
}
