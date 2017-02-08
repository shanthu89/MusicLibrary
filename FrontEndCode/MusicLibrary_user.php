
<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();

    if(! isset ($_SESSION['userID'])) {
         header("Location:LoginPage.php");    
        }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="LibraryStylesheet.css">
    <title>MusicLibraryUser</title>
    <h2>Music Library User <br/>
        <a href="logout.php" style="float: right; font-size: 15px" title="Logout">Logout</a></h2>
    <p style="float: left;"><b>Profile summary: </b><br/><i><?php GetUserSummary();?> </i></p>
    <script>
        //function to show and hide the container as per user choice of selection operation
        function selectChoice(choice) {
 
            document.getElementById('Search_Container').style.display = 'none';
            document.getElementById('Adv_Search_Container').style.display = 'none';
            document.getElementById('results_Container').style.display = 'none';
        
            if (choice == "search_song") {
                //alert("searchform");
                document.getElementById('Search_Container').style.display = 'inline';
            }
            else if (choice == "advsearch_song")
		    {
			    document.getElementById('Adv_Search_Container').style.display='inline';
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
        //XMLHTTP Ajax request to like song in the row user has chosen
        function LikeSong(SongID,row_num){
            //alert(SongID);
            //alert(row_num);
            //document.getElementById("results_table").rows[row_num].style.display = 'none'; 
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=likesong&SongID="+SongID;
           // alert(url);
	        xmlhttp.open("GET", url, false);
            //alert(url);
	        xmlhttp.send();
	            if (xmlhttp.responseText == "duplicate")
		        alert("Song already liked!");
	        else
		        alert("Song liked!");
        }
         //XMLHTTP Ajax request to play song in the row user has chosen
        function PlaySong(SongID,row_num){
            //alert(SongID);
            //alert(row_num);
            //document.getElementById("results_table").rows[row_num].style.display = 'none'; 
	        xmlhttp=new XMLHttpRequest();
	        var url = "actions_ajax.php?action=playsong&SongID="+SongID;
            //alert(url);
	        xmlhttp.open("GET", url, false);
            //alert(url);
	        xmlhttp.send();
	        //alert(xmlhttp.responseText);
		    alert("Song Played! Added to your history");
	        
        }
        //XMLHTTP Ajax request to add song the in the row user has chosen to already existing playlist
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
        //XMLHTTP Ajax request to add song the in the row user has chosen to new playlist
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
        //XMLHTTP Ajax request to create new playlist
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
		       alert("Song added to the new playlist!");
               // alert(xmlhttp.responseText);

	        //alert("Create new playlist!");
        }
        //XMLHTTP Ajax request to edit playlist
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
        //XMLHTTP Ajax request to delete playlist
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
        //XMLHTTP Ajax request to delete chosen song in the row from playlist
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
        }
        
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
                        <option value="view_pl">View Playlists</option>
                        <option value="view_likes">View Liked Songs</option>
                        <option value="view_history">View History</option>
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
            printf("Error: %s\n", mysqli_error($conn));
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
        //echo ($query);
	    
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
            printf("Error: %s\n", mysqli_error($conn));
        }
    
    }
    //function to display all playlist that belong to the user
     function GetPlayList(){
        $userID = $_SESSION['userID'];
        $conn = ConnectDB();
        //echo "Get Playlist {$userID}";   
        $query = "SELECT * FROM playlist_info where userID = {$userID}";
        //echo $query;
        
        if ($result = mysqli_query($conn, $query)) 
        {
            //printf("Select returned %d rows.\n", mysqli_num_rows($result));
            $returnVal = table_pl($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else
        {
            printf("Error: %s\n", mysqli_error($conn));
        }
    
    }
    //function to display all songs liked by the user
    function GetLikes(){
        //session_start();
        $userID = $_SESSION['userID'];
        $conn = ConnectDB();      
        $query = "SELECT * FROM song WHERE SongID IN ( SELECT SongID FROM likes WHERE userID={$userID});";
        if ($result = mysqli_query($conn, $query)) 
        {
            //printf("Select returned %d rows.\n", mysqli_num_rows($result));
            $returnVal = table_songs($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else
        {
            printf("Error: %s\n", mysqli_error($conn));
        }
    }
    //function to display all songs played by the user
    function GetHistory(){
        $userID = $_SESSION['userID'];
        $conn = ConnectDB();      
        $query = "select * from song join history on song.SongID = history.SongID where userID={$userID};";
        if ($result = mysqli_query($conn, $query)) 
        {
            //printf("Select returned %d rows.\n", mysqli_num_rows($result));
            $returnVal = table_history($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else
        {
            printf("Error: %s\n", mysqli_error($conn));
        }
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
           echo "<td><table><tr><td><button type='button' title ='Play Song' onclick='PlaySong(".$row['SongID'] . "," . $row_count ." )' style='background-color:transparent; border-color:transparent;'><img src = 'http://www.theideawall.com/img/RESOURCES/video-play-button-icon.png' height=25px width=25px></button></td>";
            echo "<td><button type='button' title ='Add to Playlist' onclick='AddSongtoPl(".$row['SongID'] . "," . $row_count ." )' style='background-color:transparent; border-color:transparent;'><img src = 'http://findicons.com/files/icons/1035/human_o2/128/playlist_new.png' height=25px width=25px></button></td>";
            echo "<td><button type='button' title ='Like Song' onclick='LikeSong(".$row['SongID'] . "," . $row_count ." )' style='background-color:transparent; border-color:transparent;'><img src = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/Facebook_like_thumb.png/1196px-Facebook_like_thumb.png' height=25px width=25px></button></td></tr></table></td>";
            
    
            echo "</tr>";      
            $row_count++;
        }
       echo "</table>";
    }
    //Function to display all playlist in a table
     function table_pl($result){
        if(mysqli_num_rows($result)==0){
            return "<font color='red'><h3><center>No Result Found!</center></h3></font>";
        }
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
         echo "<td><button title='Edit Playlist' type='button' onclick='EditPlaylist(".$row['playlist_ID']." );' style='background-color:transparent; border-color:transparent;'><img src ='http://www.iconsdb.com/icons/preview/caribbean-blue/edit-property-xxl.png' height=25px width=25px></button>";
          echo "<button title='Delete Playlist' type='button' onclick='DeletePlaylist(".$row['playlist_ID'].",".$row_count.");' style='background-color:transparent; border-color:transparent;'><img src ='http://findicons.com/files/icons/1786/oxygen_refit/128/media_playlist_clear.png' height=25px width=25px></button></td>";
        
        echo "</tr>"; 
        $row_count++;     
        }
        echo "</table>";
    }
    //Function to display history of user in a table
    function table_history($result){
        if(mysqli_num_rows($result)==0){
            return "<font color='red'><h3><center>No Result Found!</center></h3></font>";
        }
        $row_count = 1;
        echo "<table border ='1' id='table_history' name='table_history'>";
        echo "<tr>";
        echo "<th><b>S.No</b></td>";
        echo "<th><b>Song Title</b></th>";
        echo "<th><b>Album</b></th>";
        echo "<th><b>Last Played</b></th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
        
        echo    "<tr>";
        echo  "<td>" . (string)$row_count . "</td>";
        echo  "<td>" . $row['Title'] . "</td>";
        echo  "<td>" . $row['Album'] . "</td>";
        echo  "<td>" . $row['played_time'] . "</td>";
            
        echo "</tr>"; 
        $row_count++;     
        }
        echo "</table>";
    }
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
        if(!strcmp($choice,"view_pl")){
            return 4;
        }
        if(!strcmp($choice,"view_likes")){
            return 5;
        }
        if(!strcmp($choice,"view_history")){
            return 6;
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
	else if (! strcmp($operation, "view_pl"))
		return GetPlayList();
    else if (! strcmp($operation, "view_likes"))
		return GetLikes();
    else if (! strcmp($operation, "view_history"))
		return GetHistory();
        
    }

    function GetUserSummary()
    {
        $userID = $_SESSION['userID'];

        $conn = ConnectDB();
        
        $query = "select first_name from user where userID = {$userID}";
        if ($result = mysqli_query($conn, $query)) 
        {
            $returnVal = mysqli_fetch_array($result, MYSQL_ASSOC);
            echo " Hello ". $returnVal['first_name']. "!!";

            $query = "select count(*) as playlistCount from playlist_info where userID = {$userID}";    
            $result = mysqli_query($conn, $query);
            $returnVal = mysqli_fetch_array($result, MYSQL_ASSOC);
            echo "<br/> PlaylistsOwned: ". $returnVal['playlistCount'];
            
            
            $result = mysqli_query($conn, "select count(*) as likedSongCount from likes where userID = {$userID}");
            $returnVal = mysqli_fetch_array($result, MYSQL_ASSOC);
            echo "<br/> SongsLiked: ". $returnVal['likedSongCount'];

            $result = mysqli_query($conn, "select count(*) as playedSongs from history where userID = {$userID}");
            $returnVal = mysqli_fetch_array($result, MYSQL_ASSOC);
            echo "<br/> SongsPlayed: ". $returnVal['playedSongs'];
            
        }
        else
        {
            printf("Error: %s\n", mysqli_error($conn));
        }
    }
?>
