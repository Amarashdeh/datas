<?
	session_start();

	/* load settings */
	if (!isset($_CONFIG))
		require 'config.php';
	
	/* define constants */
	require 'chessconstants.php';

	/* include outside functions */
#	if (!isset($_CHESSUTILS))
	require 'chessutils.php';
	require 'gui.php';
	require 'chessdb.php';
//	require 'move.php';
//	require 'undo.php';

	/* allow WebChess to be run on PHP systems < 4.1.0, using old http vars */
#	fixOldPHPVersions();

	/* check session status */
//	require 'sessioncheck.php';
	
	/* debug flag */
	define ("DEBUG", 0);

	/* connect to database */
	require 'connectdb.php';
	/* load game */

header("Content-Type: application/x-chess-pgn");
header("Content-Disposition: attachment; filename=game".$_SESSION['gameID'].".pgn");
loadHistory();
ReturnGameInfo($_SESSION['gameID']); 
writePGN(); 
mysql_close();
?>
