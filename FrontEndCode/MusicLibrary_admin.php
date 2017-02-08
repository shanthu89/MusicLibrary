<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();    
    
    if(! isset($_SESSION['userID'])) {
         header("Location:LoginPage.php");  
    } elseif ($_SESSION['userID'] != 1) { // if not admin, redirect to user page
        header("Location:MusicLibrary_user.php");  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="LibraryStylesheet.css">
    <title>MusicLibraryAdmin</title>
    
    <h2>Music Library Admin <br/><a href="logout.php" style="float: right; font-size: 15px" title="Logout">Logout</a></h2>
    <script>
        //function to show and hide the container as per user choice of selection operation
        function selectChoice(choice) {
 
            document.getElementById('Search_Container').style.display = 'none';
            document.getElementById('Adv_Search_Container').style.display = 'none';
            document.getElementById('results_Container').style.display = 'none';
            document.getElementById('add_song_container').style.display = 'none';
        
            if (choice == "search_song") {
                //alert("searchform");
                document.getElementById('Search_Container').style.display = 'inline';
            }
            else if (choice == "advsearch_song")
		    {
			    document.getElementById('Adv_Search_Container').style.display='inline';
		    }
            else if (choice == "add_song")
		    {
			document.getElementById('add_song_container').style.display='inline';
		    }
            //alert(choice);
        }
        //function to set the select operation field as per user's choice
        function setFields(){
            var choiceIndex = <?php echo choiceIndex(); ?>;
            //alert(choiceIndex);
            document.getElementById('choice').selectedIndex=choiceIndex;
            var operation = "<?php echo getChoice(); ?>";
            //alert(operation);
            selectChoice(operation);
        }
        //function to fill the results as per the function call and display results on screen
        function fillResults(){
            //alert("fillresult"); 
            document.getElementById('results_Container').style.display = 'inline';
           
        document.getElementById('results_Container').innerHTML="<?php echo GetResults(); ?>";
        }
        //XMLHTTP Ajax request to delete song in the row user has chosen
        function DeleteRecord(SongID,row_num){
            //alert(SongID);
            //alert(row_num);
            document.getElementById("results_table").rows[row_num].style.display = 'none'; 
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=deletesong&SongID="+SongID;
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send();
	        //alert(xmlhttp.responseText);
	        alert('Deleted!');
        }
        update_song_id=0;
        //function to hide all containers and show the update container when user choses update song
        function UpdateRecord(SongID,row_num){
            // alert(SongID);
             //alert(row_num);
             update_song_id = SongID;
	        
        	document.getElementById('Search_Container').style.display = 'none';
            document.getElementById('Adv_Search_Container').style.display = 'none';
            document.getElementById('results_Container').style.display = 'none';
            document.getElementById('main_submit_btn_container').style.display = 'none';
            document.getElementById('add_song_container').style.display='none';
	        document.getElementById("update_song_container").style.display = 'inline'; 
	       
        	$rowobj = document.getElementById("results_table").rows[row_num];
        //  alert( document.getElementById("update_genre"));
	    	document.getElementById("update_title").value = $rowobj.cells[1].innerHTML ; 
	        document.getElementById("update_album").value = $rowobj.cells[2].innerHTML ; 
	        document.getElementById("update_artist").value =  $rowobj.cells[3].innerHTML ; 
	        document.getElementById("update_composer").value =  $rowobj.cells[4].innerHTML ; 
            document.getElementById("update_genre").value =  $rowobj.cells[5].innerHTML ; 
	       
        }
        //XMLHTTP Ajax request to update song in the row user has chosen with all attributes filled
        function UpdateSong(){
             xmlhttp=new XMLHttpRequest();
	         var url = "actions_ajax.php?action=updatesong&SongID="+update_song_id;
	         url = url + "&Title='"+document.getElementById("update_title").value+"'";
	         url = url + "&Album='"+document.getElementById("update_album").value+"'";
             url = url + "&Artist='"+document.getElementById("update_artist").value+"'";
             url = url + "&Composer='"+document.getElementById("update_composer").value+"'";
	         url = url + "&Genre='"+document.getElementById("update_genre").value+"'";
	         
	        

	         xmlhttp.open("GET", url, false);
	         xmlhttp.send();
            //alert(xmlhttp.responseText);   
	        if (xmlhttp.responseText == "duplicate")
	         {
		        alert("Song with Similar Attributes exists in the library!");
	         }
	         else
	         {
		        alert("Update Success!");
	         }
            
             document.getElementById("mainform").submit();
             
        }
        //XMLHTTP Ajax request to add song by passing all the attributes user has filled
        function AddSongtoPl(SongID,rowcount){
             //alert(SongID);
             //alert(rowcount);
              
	        document.getElementById("results_table").style.display = 'none';
	        document.getElementById("results_Container").style.display = 'inline';

	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=getplaylists&SongID="+SongID;
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send(null);
	        //alert(xmlhttp.responseText);

	        document.getElementById("results_Container").innerHTML = xmlhttp.responseText;	
        
        }
        /*
        function AddToPlaylist(SongID, pl_id)
        {
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=addtolist&SongID="+SongID;
	        url = url + "&pl_id="+pl_id;
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send(null);
	        if (xmlhttp.responseText == "duplicate")
		        alert("Song already in this playlist!");
	        else
		        alert("Song added to the playlist!");

	        document.getElementById("results_table").style.display = 'inline';
	        document.getElementById("results_Container").innerHTML = '' 
	        //document.getElementById("playlist_editor").style.display = 'none';
        }
        function CreateNewPlaylist(SongID)
        {
	        var name = document.getElementById("newpl_name").value;
	        if (name.length == 0)
	        {
		        alert("Please enter a name!");
		        return;
	        }
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=addtonewlist&SongID="+SongID;
	        url = url + "&pl_name="+name;
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send(null);
	        if (xmlhttp.responseText == "duplicate")
		        alert("Song already in this playlist!");
	        else
		       alert("Song added to the playlist!");
               // alert(xmlhttp.responseText);

	        //alert("Create new playlist!");
        }
        function EditPlaylist(pl_id)
        {   
            //alert("Entered edit");
	        document.getElementById("pl_results_table").style.display = 'none';
	        document.getElementById("results_Container").style.display = 'inline';
            //alert(pl_id);
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=openplaylist&pl_id="+pl_id;
	
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send();
	        if (xmlhttp.statusCode != 400)
	        {
		        document.getElementById("results_Container").innerHTML = xmlhttp.responseText;	
	        }
	        else
	        {
		        alert("Cannot Open Playlist!");
		        alert(xmlhttp.responseText);
	        }
        }
        function DeletePlaylist(pl_id, row_num)
        {
	        document.getElementById("pl_results_table").rows[row_num].style.display = 'none'; 
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=deletepl&pl_id="+pl_id;
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send();
            alert("Delete Playlist!");
	        //alert(xmlhttp.responseText);
        }
        function DeleteFromPl(SongID, pl_id, row_num)
        {   
            //alert("Deletefrompl");
	        document.getElementById("playlist_ed").rows[row_num].style.display = 'none'; 
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=deletefrompl&pl_id=" + pl_id;
	        url = url + "&SongID="+SongID;
            //alert(url);
	        xmlhttp.open("GET", url, false);
	        xmlhttp.send();
            alert("Song deleted from playlist!");
	        //alert(xmlhttp.responseText);
        }*/
      
        
    </script>
</head>
<body>  
        <!--Main form container that has the various choices from which user can select operations-->
        <div id="MainForm_Container" >
            <form id="mainform" name="mainform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <table>
                    <tr><td><label class="description" for="element_1"><b>Select Operation</b></label></td> </tr>
                    <tr><td><select id="choice" name="choice" onchange="selectChoice(this.value)">
                        <option value="" selected="selected"></option>
                        <option value="display_allsongs">Display all songs</option>
                        <option value="search_song">Search Song</option>
                        <option value="advsearch_song">Advanced Search Song</option>
                        <option value="add_song">Add Song</option>
                    </select></td></tr>
                 </table>
                    <!--Search container that has the search field enclosed which will be visible various user operations when user performs search-->
                    <div id="Search_Container" style="display:None"> 
                        <table>
                        <tr><td><label class="description" for="element_2"><u>Simple Search</u></label></td></tr>
                        <tr><td><input type="text" id="searchquery" name="searchquery" class="search" value="<?php print GetField('searchquery'); ?>" /></td></tr>
                        <tr></tr>
                        </table>
                    </div>
                    <!--Advanced Search container that has the search field enclosed which will be visible various user operations when user performs advanced search-->
                    <div id="Adv_Search_Container" style="display:None"> 
                        <table>
                        <tr><td><label class="description" for="element_3"><u>Advanced Search</u></label></td></tr>
                        <tr><td><label class="description" for="element_4">Title</label></td></tr>
                        <tr><td><input type="text" id="asearch_title" name="asearch_title" class="search" value="<?php print GetField('asearch_title'); ?>" /></td></tr>
                        <tr><td><label class="description" for="element_5">Album</label></td></tr>
                        <tr><td><input type="text" id="asearch_album" name="asearch_album" class="search" value="<?php print GetField('asearch_album'); ?>" /></td></tr>
                        <tr><td><label class="description" for="element_6">Artist</label></td></tr>
                        <tr><td><input type="text" id="asearch_artist" name="asearch_artist" class="search" value="<?php print GetField('asearch_artist'); ?>" /></td></tr>
                        <tr><td><label class="description" for="element_7">Composer</label></td></tr>
                        <tr><td><input type="text" id="asearch_composer" name="asearch_composer" class="search" value="<?php print GetField('asearch_composer'); ?>" /></td></tr>
                        <tr><td><label class="description" for="element_8">Genre</label></td></tr>
                        <tr><td><input type="text" id="asearch_genre" name="asearch_genre" class="search" value="<?php print GetField('asearch_genre'); ?>" /></td></tr>
                        
                        </table>
                    </div>
                    
                       <!--Update container that has the fields of the song to get the input attributes from user perform update function-->   
                    <div id="update_song_container" style="display:None">
                        <table>
                            <tr><td>Title</td></tr>
                            <tr><td><input type="text" id="update_title" class="update_table" /></td></tr>
                            <tr><td>Album</td></tr>
                            <tr><td><input type="text" id="update_album" class="update_table" /></td></tr>
                            <tr><td>Artist</td></tr>
                            <tr><td><input type="text" id="update_artist" class="update_table" /></td></tr>
                            <tr><td>Composer</td></tr>
                            <tr><td><input type="text" id="update_composer" class="update_table" /></td></tr>
                            <tr><td>Genre</td></tr>
                            <tr><td><input type="text" id="update_genre" class="update_table" /></td></tr>
                            <tr style="float:left">
                                <td><button type="button" onClick="javasript:UpdateSong();">Update</button></td>
					            <td><button type="button" onClick="mainform.submit();"> Cancel</button></td>
                            </tr>
                         </table>
                    </div>
                    <!--Add container that has the fields of the song to get the input attributes from user perform add function-->   
                    <div id="add_song_container" style="display:None">
                         <table>
                            <tr><td>Title</td></tr>
                            <tr><td><input type="text" id="add_title" name="add_title" value="<?php echo GetField('add_title');?>" /></td></tr>
                            <tr><td>Album</td></tr>
                            <tr><td><input type="text" id="add_album" name="add_album" value="<?php echo GetField('add_album');?>"/></td></tr>
                            <tr><td>Artist</td></tr>
                            <tr><td><input type="text" id="add_artist" name="add_artist" value="<?php echo GetField('add_artist');?>" /></td></tr>
                            <tr><td>Composer</td></tr>
                            <tr><td><input type="text" id="add_composer" name="add_composer" value="<?php echo GetField('add_composer');?>" /></td></tr>
                            <tr><td>Genre</td></tr>
                            <tr><td><input type="text" id="add_genre" name="add_genre" value="<?php echo GetField('add_genre');?>"/></td></tr>
                             <tr><td>Path</td></tr>
                            <tr><td><input type="text" id="add_path" name="add_path" value="<?php echo GetField('add_path');?>"/></td></tr>
                          </table>

                    </div>
                   <!--Submit container that has submit button-->   
                    <div id="main_submit_btn_container">            
                        <button id="submit_btn" type="button" onClick="mainform.submit();"> Submit </button>
                    </div>
                    <br/>
					<!--Results container that displays the table of results-->
                    <div id="results_Container" style="display: none">
                        <script> setFields(); fillResults(); </script>
                    </div>
            </form>
          </div>
</body>
</html> 
<?php
     //function to connect to the db with login details and the database selection.
    //Modify the localhost,username,password,database name as per individual credentials.
    function connectDB()
    {
        $conn = mysqli_connect("localhost:3306", "root", "shanthu89", "dbproject");   
        //echo"connected DB"     ;
        if (!$conn) 
        {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $conn;
    }
    //function to search songs in the library on all fields
    function SearchSongs()
    {  
        //echo "hi";
        $conn = ConnectDB();    
        $val = mysqli_real_escape_string ($conn, $_POST['searchquery']);
        $query = "SELECT * FROM song WHERE Title LIKE '%".$val."%' or Album LIKE '%".$val."%' or Artist LIKE '%".$val."%' or Composer LIKE '%".$val."%' or Genre LIKE '%".$val."%'";
        if ($result = mysqli_query($conn, $query)) 
        {
            //printf ("Select returned %d rows.\n", mysqli_num_rows($result));
            $returnVal = table_songs($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else
        {
          echo(mysqli_error($conn));
        }
    }  
    //function to search songs in the library on a particular attribute of song
    function AdvancedSearchSongs()
    {
	    $conn = ConnectDB();
	    $title = $_POST['asearch_title'];
	    $album = $_POST['asearch_album'];
	    $artist = $_POST['asearch_artist'];
	    $composer = $_POST['asearch_composer'];
        $genre = $_POST['asearch_genre'];
	    $query = "select * from song where Title LIKE '%".$title."%' and Album LIKE '%".$album."%' and Artist LIKE '%".$artist."%' and Composer LIKE '%".$composer."%' and Genre LIKE '%".$genre."%'";
    	    
        $result = mysqli_query($conn, $query);
	    return table_songs($result);
    }
    //function to display all songs from library
    function GetAllSongs(){
           //echo "isset";
        $conn = ConnectDB();      
        $query = "SELECT * FROM song";
        if ($result = mysqli_query($conn, $query)) 
        {
            //printf("Select returned %d rows.\n", mysqli_num_rows($result));
            $returnVal = table_songs($result);
            //echo ($returnVal);
            mysqli_close($conn);
            return $returnVal;
        }
        else
        {
           echo(mysqli_error($conn));
        }
    
    }
    /* function GetPlayList(){
           //echo "isset";
        $conn = ConnectDB();      
        $query = "SELECT * FROM playlist_info";
        if ($result = mysqli_query($conn, $query)) 
        {
            //printf("Select returned %d rows.\n", mysqli_num_rows($result));
            $returnVal = table_pl($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else
        {
           echo(mysqli_error($conn));
        }
    
    }*/
    //Function to add song to a library
    function AddSong()
    {   
		$conn = ConnectDB();

		$Title = $_POST['add_title'];
		$Album = $_POST['add_album'];
		$Artist = $_POST['add_artist'];
		$Composer = $_POST['add_composer'];
        $Genre = $_POST['add_genre'];
		$Path = $_POST['add_path'];

		$message = "Song Added!";
		$query = "select SongID from song where Title='{$Title}' and Album='{$Album}' and Artist='{$Artist}' and Composer='{$Composer}' and Genre='{$Genre}' and Filepath='{$Path}'";
        //echo $query;
		if ($result = mysqli_query($conn, $query)) 
        {   //echo("enterd if");
            if (mysqli_num_rows($result) > 0)
		    {
		    	$message = "Song with these attributes already exists!";	
                

	    	}
		   else
		    {
			    $query = "insert into song (Title, Album, Artist, Composer, Genre , Filepath) values ('{$Title}', '{$Album}', '{$Artist}', '{$Composer}', '{$Genre}', '{$Path}')" ;
			
                mysqli_query($conn, $query) or die("Unable to Insert");
                
		    }
        }

        else
        {
            echo mysqli_error($conn);
            //echo "test";
            //printf ("Error: %s\n", mysqli_error($conn));
        }
       	echo "<h2><font color='green'><center>".$message."</center></font></h2>";        
		
		
		
    }

    //Function to display all songs in a table
    function table_songs($result){
        if(mysqli_num_rows($result)==0){
            return "<font color='red'><h3><center>No Result Found!</center></h3></font>";
        }
        
         $row_count = 1;
         
        echo "<table border = '1' id='results_table' name='results_table'>";
        echo "<tr>";
        echo "<th><b>S.No</b></th>";
        echo "<th><b>Title</b></th>";
        echo "<th><b>Album</b></th>";
        echo "<th><b>Artist</b></th>";
        echo "<th><b>Composer</b></th>";
        echo "<th><b>Genre</b></th>";
        echo "<th><b>Action</b></th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
            echo "<tr>";
            echo  "<td>" . (string)$row_count . "</td>";
            echo  "<td>" . $row['Title'] . "</td>";
            echo  "<td>" . $row['Album'] . "</td>";
            echo  "<td>" . $row['Artist'] . "</td>";
            echo  "<td>" . $row['Composer'] . "</td>";
            echo  "<td>" . $row['Genre'] . "</td>";
            echo "<td><table><tr><td><button type='button' title='Edit Song' onclick='UpdateRecord(".$row['SongID'] . "," . $row_count ." )' style='background-color:transparent; border-color:transparent;'><img src ='http://www.iconsdb.com/icons/preview/caribbean-blue/edit-property-xxl.png' height=25px width=25px></button></td>";
           
            echo "<td><button type='button' title='Delete song' onclick='DeleteRecord(".$row['SongID'] . "," . $row_count ." )' style='background-color:transparent; border-color:transparent;'><img src ='http://findicons.com/files/icons/2226/matte_basic/32/trash_can_delete.png' height=25px width=25px></button></td></tr></table></td>";
            echo "</tr>";      
            $row_count++;
        }
       echo "</table>";
    }
     /*function table_pl($result){
    //$rowcount=1;
        //echo $result;
        //echo "entered table_songs";
        //$row=mysqli_fetch_array($result);// or die (mysql_error());
        $row_count = 1;
        echo "<table border ='1' id='pl_results_table' name='pl_results_table'>";
        echo "<tr>";
        echo "<th><b>S.No</b></td>";
        echo "<th><b>PlaylistName</b></th>";
        echo "<th><b>Action</b></th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
        
        echo    "<tr>";
        echo  "<td>" . (string)$row_count . "</td>";
        echo  "<td>" . $row['playlist_name'] . "</td>";
         echo "<td><button title='Edit Playlist' type='button' onclick='EditPlaylist(".$row['playlist_ID'].");'></button>";
          echo "<button type='button' onclick='DeletePlaylist(".$row['playlist_ID'].",".$row_count.");'>Del</button></td>";
        
        echo "</tr>"; 
        $row_count++;     
        }
        echo "</table>";
    }*/
    //Function to get the index of choice the user choses from the select operation
    function choiceIndex(){
        if (count($_POST) == 0)
		    return 0;
	    $choice = $_POST['choice'];
         if(!strcmp($choice,"display_allsongs")){
            return 1;
        }
        if(!strcmp($choice,"search_song")){
            return 2;
        }
        if(!strcmp($choice,"advsearch_song")){
            return 3;
        }
        if(!strcmp($choice,"add_song")){
            return 4;
        }
        
        return 0;
    }
    //Function to get the choice value the user choses from the select operation
    function getChoice()
    {
	    if (count($_POST) == 0)
		    return "";
	    return $_POST['choice'];
    }
    function GetField($str)
    {   
	    if (count($_POST) == 0)
           // echo ("if");
		    return "";
	    else
            //echo ("else");
		    return $_POST[$str];
    }
    //Function to get call the respective operations as per user's selection of operation
    function GetResults()
    {
	if (count($_POST) == 0)
		return "";
	$operation = $_POST['choice'];
    if (! strcmp($operation, "display_allsongs"))
		return GetAllSongs();
	else if(! strcmp($operation, "search_song"))
		return SearchSongs();
    else if(! strcmp($operation, "advsearch_song"))
		return AdvancedSearchSongs();
    else if(! strcmp($operation, "add_song"))
		return AddSong();
	
    }

?>
