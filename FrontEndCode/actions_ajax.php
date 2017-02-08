<?php
//to validate if any operation is selected from choice. if no operation selected return.
if ( $_GET['action'] == ''){
    	return;
}
//Session started for each user login and user ID is extracted to provide user specific functionalities.
session_start();
$userID = $_SESSION['userID'];
if(! isset ($_SESSION['userID'])) {
        header("Location:LoginPage.php");    
}    
//extract the action in the XMLHTTP request sent.
$action = $_GET['action'];
//funtion to delete song from the backend using sql delete query
if (! strcmp($action, "deletesong") )
{
    $conn = ConnectDB();
    $SongID = mysqli_real_escape_string ($conn, $_GET['SongID']);
    $query = "delete from playlist where SongID = {$SongID}";
    mysqli_query($conn, $query);
    $query = "delete from song where SongID = {$SongID}";
    //echo($query);
    mysqli_query($conn, $query);
   
} 
//funtion to add song to likes table using sql insert query
else if (! strcmp($action, "likesong")){
   
    $conn = ConnectDB();
    $SongID = mysqli_real_escape_string($conn,$_GET['SongID']);
    //validate if such entry already exists
    $query="select * from likes where SongID={$SongID} AND userID={$userID};";
    $result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0)
		{
			echo "duplicate";
			return;
		}
    $query= "INSERT into likes (userID,SongID) values  ({$userID},{$SongID});";
    mysqli_query($conn, $query);
}
//funtion to add song to history table using sql insert query
else if (! strcmp($action, "playsong")){
   
    $conn = ConnectDB();
    $SongID = mysqli_real_escape_string($conn,$_GET['SongID']);
    $query= "INSERT into history (userID,SongID,played_time) values  ({$userID},{$SongID},NOW());";    
    mysqli_query($conn, $query);
    
}
//funtion to update song to song table using sql update query
else if (! strcmp($action, "updatesong"))
{   
	$conn = ConnectDB();
 	$SongID = $_GET['SongID'];
	$Title =  $_GET['Title'];
	$Album =  $_GET['Album'];
	$Artist =  $_GET['Artist'];
	$Composer =  $_GET['Composer'];
    $Genre =  $_GET['Genre'];
	//alert($SongID);
	//test for duplicates
	$query = "select SongID from song where Title={$Title} and Album={$Album} and Artist={$Artist} and Composer={$Composer} and Genre={$Genre}";
	$result = mysqli_query($conn, $query);
	//echo mysqli_num_rows("rows",+$result);
	//echo $query;
	if (mysqli_num_rows($result) > 1)
	{
		echo "duplicate";
		return;
	}
	$myrow = mysqli_fetch_array($result, MYSQL_ASSOC);
    //echo $myrow;
	if (mysqli_num_rows($result) > 0 && $myrow["SongID"] != $SongID)
	{
		echo "duplicate";
		return;
	}
	$query = "UPDATE song SET Title={$Title}, Album={$Album}, Artist={$Artist}, Composer={$Composer},Genre={$Genre} where SongID={$SongID}";
   
    //echo $query;
	mysqli_query($conn, $query);
}
//funtion to fetch playlists from playlist_info table using sql select query
else if (! strcmp($action, "getplaylists"))
	{
		$conn = ConnectDB();
		$SongID = $_GET['SongID'];
		$query = "SELECT * FROM playlist_info where userID = {$userID}";
        //echo $query;
		$result = mysqli_query($conn, $query);
        
		echo tablePlaylists($result, $SongID);
	}
//funtion to add song to playlist table using sql insert query
else if (! strcmp($action, "addtolist"))
	{
		$conn = ConnectDB();
		$SongID = $_GET['SongID'];
		$pl_id = $_GET['pl_id'];
		$query = "SELECT * FROM playlist where SongID={$SongID} and playlist_ID={$pl_id}";
		$result = mysqli_query($conn, $query);
        //validate if duplicate entry exists
		if (mysqli_num_rows($result) > 0)
		{
			echo "duplicate";
			return;
		}
		$query = "INSERT into PLAYLIST (SongID,playlist_ID) values  ({$SongID}, {$pl_id});";
		if (!mysqli_query($conn, $query))
        {
            echo "Error: " . mysqli_error($conn);
        }
	}
//funtion to add song to new playlist by creating entry in playlist_info and playlist table
else if (! strcmp($action, "addtonewlist") )
	{
		$conn = ConnectDB();
		$SongID = $_GET['SongID'];
		$pl_name = $_GET['pl_name'];
		$query = "select * from playlist_info where playlist_name = '{$pl_name}' and userID = {$userID}";
		//echo $query;
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0)
		{
			echo "duplicate";
			return;
		}
		$query = "insert into playlist_info (playlist_name, userID) values ('{$pl_name}', {$userID})";

        $error = '';
		if ($result = mysqli_query($conn, $query)) {
		    $row = mysqli_fetch_row($result);
            $query = "select playlist_ID from playlist_info where playlist_name = '{$pl_name}' and userID = {$userID}";
            if ($result1 = mysqli_query($conn, $query)) {
                $r1 = mysqli_fetch_row($result1);
                $plId = $r1[0];
           		$query = "INSERT into PLAYLIST (SongID , playlist_ID) values  ({$SongID}, {$plId});";
		        if (!mysqli_query($conn, $query))
                {
                    $error = "1". mysqli_error($conn);
                }
            }
            else {
                $error = "2". mysqli_error($conn);
            }
        }
		else {
		    $error = "3". mysqli_error($conn);
		}
        if ($error != '')
            echo "Error: " . $error;
	}
//funtion to open a playlist and view all songs in that playlist
else if (! strcmp($action, "openplaylist"))
	{
		$conn = ConnectDB();
		$pl_id = $_GET['pl_id'];
		$query = "select playlist_name from playlist_info where playlist_ID={$pl_id}";
        //echo ($query);
		$result = mysqli_query($conn, $query);
        //echo mysqli_num_rows($result);
		$myrow = mysqli_fetch_array($result, MYSQL_NUM);
		//echo $myrow[0];

		$query = "select * from song where SongID in (select SongID from playlist where playlist_ID = {$pl_id})";
        //echo($query);
		$result = mysqli_query($conn, $query);
		echo tableSongs($result, $pl_id, $myrow[0]); // last field is the name!	
	}
//function to delte song from playlist
else if (! strcmp($action, "deletefrompl"))
	{   
        //echo ("delete from pl");
		$conn = ConnectDB();
		$pl_id = $_GET['pl_id'];
		$song_id = $_GET['SongID'];
		$query = "delete from playlist where SongID={$song_id} and playlist_ID={$pl_id}";
        //echo ($query);
		if (!mysqli_query($conn, $query))
        {
            $error = "1". mysqli_error($conn);
        }
	}
//function to delete a playlist 
else if (! strcmp($action, "deletepl"))
	{
		$conn = ConnectDB();
		$pl_id = $_GET['pl_id'];
		$query = "delete from playlist_info where playlist_ID = {$pl_id}";
		mysqli_query($conn, $query);

		//$query = "delete from playlist where playlist_ID = {$pl_id}";
		//mysqli_query($conn, $query);
	}
//function to establish connection with db and choose database 
function ConnectDB()
{
    $conn = mysqli_connect("localhost:3306", "root", "shanthu89", "dbproject");   
    //alert($conn);
    if (!$conn) 
    {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
	//$conn = mysqli_connect("localhost", "root", "shanthu89") or die("Cannot Connect to DB");
	//mysqli_select_db("vc_playlist",$db);
	return $conn;
}
//function to display songs inside a playlist in a table format
function tableSongs($result, $pl_id, $pl_name)
{
	$str = "<center><h3>Playlist: {$pl_name}</h3></center><TABLE border='1' id='playlist_ed' name='playlist_ed' >";
	$str .= "<TR><td>S.No</td><TD width='20%'><center><B>Title</B></center></td><TD width='20%'><center><B>Album</B></center></td><TD width='20%'><center><B>Artist</B></center></td><TD width='10%'><center><B>Composer</B></center></td><TD width='20%'><center><B>Genre</B></center></td><TD width='10%'><center><B>Action</B></center></td></TR>";

	$row_count = 1;
	while ($myrow = mysqli_fetch_array($result))
	{
		$str .= "<TR><TD>";
		$str .= (string)$row_count;
		$str .= "</td><td>";
		$str .= $myrow["Title"];
		$str .= "</td><td>";
		$str .= $myrow["Album"];
		$str .= "</td><td>";
		$str .= $myrow["Artist"];
		$str .= "</td><TD>";
		$str .= $myrow["Composer"];
		$str .= "</td><TD>";
		$str .= $myrow["Genre"];
        $str .= "</td><TD>";
        $str .= "<button title='Delete from Playlist' type='button' onclick='DeleteFromPl(".$myrow['SongID'].",".$pl_id.",".$row_count.");' style='background-color:transparent; border-color:transparent;'><img src ='http://findicons.com/files/icons/2226/matte_basic/32/trash_can_delete.png' height=22px width=22px></button>";
		//$str .= "<a href='javascript:DeleteFromPl(".$myrow["SongID"].",".$pl_id.",".$row_count.");'>DeleteFromPl</a>";
		$str .= "</td></tr>";

		$row_count++;
	}

	$str .= "</TABLE>";
	if ($row_count > 1)
		return $str;
	else
		return "<font color='red'><h3><center>No Result Found!</center></h3></font>";
}
//function to display songs inside a playlist in a table format
function tablePlaylists($result, $SongID)
{
	$str_create = "<h4>Playlist:</h4>";
	$str_create .= "<button type='button' onClick='CreateNewPlaylist({$SongID});'>Create New</button>"; 
	$str_create .= "<input id='newpl_name' name='newpl_name' type='text'/>";
	$str = "<TABLE border='1' id='playlists' name='playlists' >";
	$str .= "<TR><td width='10%'>S.No</td><TD><center><B>Name</B></center></td><TD><center><B>Action</B></center></td></TR>";

	$row_count = 1;
	while ($myrow = mysqli_fetch_array($result))
	{
		$str .= "<TR><TD>";
		$str .= (string)$row_count;
		$str .= "</td><td><center>";
		$str .= $myrow["playlist_name"];

		$str .= "</center></td><TD>";
		$str .= "<a href='javascript:AddToPlaylist (".$SongID.",".$myrow["playlist_ID"].");'>Add here</a>";
		$str .= "</td></tr>";

		$row_count++;
	}
	$str .= "</TABLE>";
	if ($row_count > 1)
		return $str_create . $str;
	else
		return $str_create . "<font color='red'><h4><center>No existing playlist! Create new playlist</center></h4></font>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
