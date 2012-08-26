<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<title>Explore for Wines</title>
</head>
	
<body bgcolor="white">
<?php
	echo "<form action=\"query_results.php\" method=\"GET\">" .
		"<br>Enter a wine to browse : " .
		"<input type=\"text\" name=\"wineName\">" .
		"<br>Enter a winery : " .
		"<input type=\"text\" name=\"wineryName\">\n";
	
		$connection = mysql_connect("yallara.cs.rmit.edu.au:54561", "root", "password");
		mysql_select_db("winestore", $connection);

		echo "\n";	
		echo "\nRegion : ";
		
		selectRegion($connection, "region", "region_name", "regionName");
		
		echo "\nGrape variety : ";
		
		selectGrapeVariety($connection, "grape_variety", "variety", "varietyName");
		
		echo "\nStarting year range : ";
		
		selectStartYear($connection, "wine", "year", "startYear");
		
		echo "\nEnding year range : ";
		
		selectEndYear($connection, "wine", "year", "endYear");		

		echo "<br>Enter minimum no. of stocked wines :" .
		     "<input type=\"text\" name=\"minStock\">" .
		     "<br>Enter minimum no. of ordered wines :" .
		     "<input type=\"text\" name=\"minOrder\">" .
		     "<br>Enter minimum price :" .
		     "<input type=\"text\" name=\"minPrice\">" .
		     "<br>Enter maximum price :" .
		     "<input type=\"text\" name=\"maxPrice\">" .
		     "<br>" .
		     "<input type=\"submit\" value=\"Search wines\">";
	echo "</form>";

	function selectRegion ($connection, $tableName, $columnName, $dropdownName)
	{

		$query = "SELECT DISTINCT $columnName
			  FROM $tableName";
		
		$results = mysql_query($query, $connection);

		$i = 0;
 		while ($row = @ mysql_fetch_array($results))
			$resultBuffer[$i++] = $row[$columnName];

		echo "\n<select name=\"$dropdownName\">";
	
		foreach ($resultBuffer as $result)
			echo "\n\t<option>$result";

		echo "\n</select>";
	}

	function selectGrapeVariety ($connection, $tableName, $columnName, $dropdownName)
        {

                $query = "SELECT DISTINCT $columnName
                          FROM $tableName";

                $results = mysql_query($query, $connection);

                $i = 0;
                while ($row = @ mysql_fetch_array($results))
                        $resultBuffer[$i++] = $row[$columnName];

                echo "\n<select name=\"$dropdownName\">";

                foreach ($resultBuffer as $result)
                        echo "\n\t<option>$result";

                echo "\n</select>";
        }


	function selectStartYear ($connection, $tableName, $columnName, $dropdownName)
        {

                $query = "SELECT DISTINCT $columnName
                          FROM $tableName";

                $results = mysql_query($query, $connection);

                $i = 0;
                while ($row = @ mysql_fetch_array($results))
                        $resultBuffer[$i++] = $row[$columnName];

                echo "\n<select name=\"$dropdownName\">";

                foreach ($resultBuffer as $result)
                        echo "\n\t<option>$result";

                echo "\n</select>";
        }

	function selectEndYear ($connection, $tableName, $columnName, $dropdownName)
        {

                $query = "SELECT DISTINCT $columnName
                          FROM $tableName";

                $results = mysql_query($query, $connection);

                $i = 0;
                while ($row = @ mysql_fetch_array($results))
                        $resultBuffer[$i++] = $row[$columnName];

                echo "\n<select name=\"$dropdownName\">";

                foreach ($resultBuffer as $result)
                        echo "\n\t<option>$result";

                echo "\n</select>";
        }

?>
</body>
</html>
