<?php
	
	# SEND LOCAL FILE TO SERVER
	function TransferFile( $FILE_NAME )
	{
		# FTP CONNECTION DETAILS
		$FTP['USERNAME'] = 'username-here';
		$FTP['PASSWORD'] = 'password-here';
		$FTP['FTP'] = 'ftp.mywebsite.com';
		$FTP['PORT'] = 22;
		$FTP['TIMEOUT'] = 90;
		
		# LOCAL FILE LOCATION
		$FILE = 'files-to-transfer/'.$FILE_NAME;
		
		# TRANSFER DESTINATION
		$REMOTE_LOCATION_FILE = '/transfer-destination/'.$FILE_NAME;
		
		# CONNECTION TO SERVER
		$CONNECTION = ssh2_connect( $FTP['FTP'], 22 );
		
		# CONNECTION SUCCESSFUL
		if ( ssh2_auth_password( $CONNECTION, $FTP['USERNAME'], $FTP['PASSWORD'] ) )
		{
			# SET SFTP CONNECTION
			$SFTP = ssh2_sftp( $CONNECTION );

			# GET CONTENTS AND UPLOAD
			$CONTENTS = file_get_contents( $FILE_NAME );
			file_put_contents( "ssh2.sftp://".intval($SFTP)."/".$REMOTE_LOCATION_FILE, $CONTENTS );			

			return 'Transfer Completed';
		}
		
		# CONNECTION FAILED
		else
		{
			return 'Connection has failed';
		}
	}
	
	# EXECUTE TRANSFER OF TEXT FILE
	echo $RunTransferFunction = TransferFile( 'file-to-transfer.txt' );
?>
