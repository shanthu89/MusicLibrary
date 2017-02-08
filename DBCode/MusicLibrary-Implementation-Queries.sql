#Choosing the database
Use dbproject;

/***************************  User Functionalities *****************************/

#New User Registration
SET @user_name = 'testuser', @password = 'test', @first_name='test' , @last_name='user';
INSERT INTO user (user_name, password, first_name, last_name) VALUES (@user_name, @password, @first_name, @last_name);

#Display all songs
SELECT * FROM song;

#Search Song - @val stores the search query entered by the user
#Below search is done on with query 'bom'
SET @val = 'bom';
SELECT * FROM song WHERE Title LIKE CONCAT('%', @val, '%') or Album LIKE CONCAT('%', @val, '%') or Artist LIKE CONCAT('%', @val, '%') or Composer LIKE CONCAT('%', @val, '%') or Genre LIKE CONCAT('%', @val, '%');

#Advance Searc Song - @val stores the search query entered by the user
#Below search is done on 'Album' field with attribute 'bom'
SET @val = 'bom';
SELECT * FROM song WHERE Title LIKE CONCAT('%','%') and Album LIKE CONCAT('%', @val, '%') and Artist LIKE CONCAT('%','%') and Composer LIKE CONCAT('%','%') and Genre LIKE CONCAT('%','%');

#View All Playlist 
#Below query displays all playlist of userID=1002.
SET @userID = 1002;
SELECT *  FROM playlist_info where userID= @userID;

#Like Song
SET @userID_like = 1000;
SET @SongID_like = 10;
INSERT INTO likes (userID,SongID) VALUES  (@userID_like,@SongID_like);

#View all Likes
#Below query displays all songs liked by userID=1002.
SET @userID = 1000;
SELECT *  FROM song WHERE SongID IN (SELECT SongID FROM LIKES WHERE userID=@userID); 

#Play Song
SET @userID_play = 1000;
SET @SongID_play = 10;
INSERT into history (userID,SongID,played_time) values  (@userID_play,@SongID_play,NOW());

#View History
#Below query displays all songs played by userID=1000.
SET @userID_play = 1000;
SELECT Title,Album,played_time  FROM song JOIN history ON song.SongID = history.SongID AND userID=@userID_play;

#Create Playlist
SET @pl_name='testpl' ,@userID=1000;
INSERT INTO playlist_info (playlist_name, userID) values (@pl_name, @userID);

#Add song to existing playlist
SET @SongID_add = 1;
SET @pl_id_add =  1;
INSERT into PLAYLIST (SongID,playlist_ID) VALUES  (@SongID_add, @pl_id_add);

#Delete Song from Playlist
/*When a user deletes a song from the playlist in 'Playlist' table trigger 'playlist_AFTER_DELETE' validates if the playlist is empty.
If empty, a request to delete the corresponding playlist in the 'Playlist_info' table. */
SET @song_id_pldel= 1;
SET @pl_id_pldel = 1;
delete from playlist where SongID=@song_id_pldel and playlist_ID=@pl_id_pldel;


#Trigger on Playlist table
/*
DELIMITER$$
CREATE DEFINER=`root`@`localhost` TRIGGER `dbproject`.`playlist_AFTER_DELETE` AFTER DELETE ON `playlist` FOR EACH ROW
BEGIN
DELETE FROM playlist_info where playlist_ID NOT IN (select distinct playlist_ID from playlist);
END$$
DELIMITER ; */

#Trigger on Playlist_info table
/*
USE `dbproject`
DELIMITER$$
CREATE DEFINER=`root`@`localhost` TRIGGER `dbproject`.`playlist_info_AFTER_INSERT` AFTER INSERT ON `playlist_info` FOR EACH ROW
BEGIN
  UPDATE user SET num_of_playlists = num_of_playlists + 1 WHERE userID = NEW.userID;
END$$
DELIMITER ;


USE `dbproject`
DELIMITER$$
CREATE DEFINER=`root`@`localhost` TRIGGER `dbproject`.`playlist_info_AFTER_DELETE` AFTER DELETE ON `playlist_info` FOR EACH ROW
BEGIN
  UPDATE user SET num_of_playlists = num_of_playlists - 1 WHERE userID = OLD.userID;
END$$
DELIMITER ;
*/

#Delete playlist
SET @pl_id_del = 1;
delete from playlist_info where playlist_ID = @pl_id_del;
#The above query will do a cascade delete of the same playlist in the 'playlist' table

/****************************Admin functionalities*********************************/
#Add song to library
SET @Title = 'Oh baby' , @Album='May Maatham' , @Artist='yesudas' , @Composer='Rahman', @Genre='romance',@path ='Music/May_Maatham/';
INSERT INTO song (Title, Album, Artist, Composer, Genre , Filepath) VALUES (@Title, @Album, @Artist, @Composer, @Genre, @Path);

#Update Song in the library
#Admin will enter the new value attribute to be updated.
UPDATE song SET Title=@Title and Album=@Album and Artist=@Artist and Composer=@Composer and Genre=@Genre where SongID=@songID;

#Below is an example to update songID = '1' with Genre = 'semi classical'
SET @songID_update=207;
SET @Genre_update = 'semi classical';
UPDATE song SET Genre=@Genre_update where SongID=@songID_update;

#Delete song from library
SET @songID_del = 207;
delete from song where SongID = @songID_del;

