<?php


require("./class.db.php");

// EPA interface class by Jeevan
class Epa {

	public function get_by_zip($zipcode) {

		$zip = (int) $zipcode;
		$res = $this->get_cached( $zip );
		if (is_array($res) && count($res) > 0) {
			// echo "Got cached data";
			return $res;
		} else {

			// Get live
			// echo "Fetching live data";
			$res_api = $this->get_api_contaminants($zip);

			// Insert into DB
			$res_check = $this->parse_csv_to_db($res_api, $zip);

			if ($res_check == true) {
				// echo "Got result from API to DB";
				return $this->get_by_zip($zip);
			}
		}
	}

	private function parse_csv_to_db($res_api, $zip) {

		global $db;

		$db->q("DELETE FROM contaminants WHERE GEOLOCATION_ZIP = '" . $zip . "'");
		$res_split = explode("\n", $res_api);
		$out = array();
		foreach ($res_split as $k => $v) {
			// Ignore first line (columns)
			if ($k == 0) { continue; }

			$res_v = str_getcsv($v);

			$ins = "INSERT INTO contaminants (`PWSID`, `PWSNAME`, `STATE`, `COUNTYSERVED`, `GEOLOCATION_ZIP`, `VIOID`, `CCODE`, `CNAME`, `SOURCES`, `DEFINITION`, `HEALTH_EFFECTS`, `CTYPE`, `VCODE`, `VNAME`, `VTYPE`, `VIOLMEASURE`, `ENFACTIONTYPE`, `ENFACTIONNAME`, `ENFDATE`, `COMPPERBEGINDATE`, `COMPPERENDDATE`, `update_time`) 
			VALUES (";
			foreach ($res_v as $kr => $vr) {
				$ins .= "'" . $db->escape($vr) . "', ";
			}

			$ins .= " NOW())";

			$db->q($ins);

		}

		return true;

	}

	private function get_cached($zip) {
		global $db;

		return $db->all("SELECT * FROM contaminants WHERE GEOLOCATION_ZIP = '" . $zip . "'");
	}

	private function get_api_contaminants($zip) {
		
		$url_contaminants = 'http://iaspub.epa.gov/enviro/efservice/SDW_CONTAM_VIOL_ZIP/GEOLOCATION_ZIP/' . $zip . '/ROWS/0:1000/CSV';

		// create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url_contaminants); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);  

        return $output;

	}

}

$db = new Db();

?>
