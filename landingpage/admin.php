<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Admin</title>
		<link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
		<style type="text/css">
			body{
				font-family: arial;
				margin: 0;
				background-color: rgba(0, 0, 0, .72);
				color: #3B3B3B;
			}

			#wrap{
				width: 900px;
				margin: auto;
			}
	
			h1{
				color: #FFA600;
				font-style: italic;
			}
			h4{
				margin: 0;
				display: inline-block;
				width: 259px;
				margin-bottom: 10px;
			}
			table{
				width: 900px;
				background-color: grey;
				margin: auto;
				border-collapse: collapse;
				box-shadow: 2px 2px 10px 5px #333333;
			}
			tr:nth-child(even){
				background-color: white;
			}
			tr:nth-child(odd){
				color: rgba(255,255,255,.8);
			}

			tr:first-child td {
			    font-weight: bold;
			    color: rgba(255,255,255,.95);
			}

			td{
				padding: 5px 10px 5px 10px;
			}

			.tdDate{
				width: 100px;
			}

			#msg{
				display: inline-block;
				position: absolute;
				top: 0;
				right: 75px;
				width: 300px;
				height: 370px;
				background-color: white;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
				box-shadow: 2px 2px 10px 5px #333333;
			}

			#dis{
				margin-bottom: 50px;
			}

			#frm{
				padding: 15px 0 0 19px;
			}

			#crss{
				font-size: 14px;
				color: red;
				cursor: pointer;
				position: relative;
				bottom: 8px;
			}			

			textarea{
				width: 257px;
				height: 190px;
				resize: none;
			}

			#lb1{
				margin-right: 19px;
			}
			#lb2{
				margin-right: 7px;
			}

			label{
				/*margin-right: 40px;*/
				width: 178px;
			}

			#msg input{
				margin-bottom: 10px;
				/*padding-left: 5px;*/
				width: 200px;
			}
			#suppr{
				text-align: center;
			}
			#suppr a{
				text-decoration: none;
				color: red;
			}

			#rep{
				
			}
			#crss2{
				color: black;
				position: relative;
				float: right;
				top: 7px;
				left: 6px;
				cursor: pointer;		
			}

		</style>
	</head>
	<body>
		<div id="wrap">
			<h1>Admin - Messages reçus</h1>
				<table id="dis">
					<tr>
						<td>Id</td><td>Prénom</td><td>Nom</td><td>Contenu</td><td>Email</td><td class="tdDate">Date</td><td>Supprimer</td><td>Reponse</td>
					</tr>
			<?php
				date_default_timezone_set('Europe/Paris');

				try{
					$db = new PDO('mysql:host=localhost;dbname=cystopia','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				}
				catch(Exception $e){
					die('Erreur : '.$e);
				}

				if (isset($_GET['del'])) {
					$q =  $db->prepare('DELETE FROM contact WHERE c_id = ?');
					$q->execute(array($_GET['del']));
				}

				$q = $db->query('SELECT * FROM contact c LEFT JOIN reponse r ON c.c_id = r.r_contact_fk GROUP BY c_id ORDER BY c_id');

				while ($res = $q->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr><td>'.$res['c_id'].'</td>
						  <td>'.$res['c_firstname'].'</td>
						  <td>'.$res['c_lastname'].'</td>
						  <td>'.$res['c_content'].'</td>
						  <td><a href="?mail='.$res['c_email'].'&id='.$res['c_id'].'">'.$res['c_email'].'</a></td>
						  <td>'.$res['c_valdate'].'</td>
						  <td id="suppr"><a href="?del='.$res['c_id'].'"<i class="fa fa-times" aria-hidden="true"></i></td>';
					if (!is_null($res['r_contact_fk'])) {
						echo '<td><a href="?rep='.$res['r_id'].'">voir reponse</a></td></tr>';
					}
				else echo '<td>-</td></tr>';
				}	
			?>
			</table>
			<?php 
				if (isset($_GET['rep'])) {

					$q = $db->prepare('SELECT * FROM reponse WHERE r_id = ?');
					$q->execute(array($_GET['rep']));
					$res = $q->fetch();
					if ($res) {
						echo '<table id="rep"><i id="crss2" class="fa fa-times" aria-hidden="true" onclick="hideR()"></i><tr><td>Id Réponse</td><td>Sujet</td><td>Content</td><td>Date</td><td>Id contact</td></tr><tr><td>'.$res['r_id'].'</td><td>'.$res['r_sujet'].'</td><td>'.$res['r_content'].'</td><td>'.$res['r_date'].'</td><td>'.$res['r_contact_fk'].'</td></tr></table>';
					}
				}

				if (isset($_GET['mail'])) { ?>
					<div id="msg"><form action="" method="POST" id="frm">
							<h4>Envoyer mail :</h4><i id="crss" class="fa fa-times" aria-hidden="true" onclick="hide()"></i>
							<label id="lb1">Mail:</label><input type="text" value="<?=$_GET['mail']?>" name="mail">
							<label id="lb2">Sujet :</label><input type="text" name="sujet">
							<label>Message :</label><textarea name="content"></textarea>
							<input type="submit" value="envoyer" name="send">
						  </div>
				<?php }



				if (isset($_POST['send']) && !empty($_POST['sujet']) && !empty($_POST['content'])) {
					_send_email($_POST['mail'], $_POST['sujet'], $_POST['content'], false, 'Sevice Client Cystopia');


					$q = $db->prepare('INSERT INTO reponse (r_sujet, r_content, r_date, r_contact_fk) VALUES (?,?,NOW(),?)');
					$q->execute(array($_POST['sujet'],$_POST['content'], $_GET['id']));

					
					echo '<style>#msg{display:none}</style>';
				}

				function _send_email($to, $subject, $string, $type, $from=array('name'=>'', 'email'=>''), $reply=array('name'=>'', 'email'=>'')) {   // type == false ? TXT : HTML
				
			        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $to)) 
					    $passage_ligne = "\r\n";
					else
						$passage_ligne = "\n";	

			        $result = array('from'=>'', 'reply'=>'');
			       
			            // $result['from'] = "\"".$from['name']."\"<".$from['email'].">";

			      
			            // $result['reply'] = "\"".$reply['name']."\"<".$reply['email'].">";

					$boundary = "-----=".md5(rand());
					// HEADER MAIL
					$header = "From: ".$result['from'].$passage_ligne;
					$header.= "Reply-to: ".$result['reply'].$passage_ligne;
					$header.= "MIME-Version: 1.0".$passage_ligne;
					$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

					$message = $passage_ligne."--".$boundary.$passage_ligne;
					$message.= (!$type) ? "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne : "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
				    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
					$message.= $passage_ligne.$string.$passage_ligne;
					$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
					
					// SEND
					// if(!mail($to,$subject,$message,$header)) return false;
					// return true;
			    }
			?>
		</div>

	</body>
	<script type="text/javascript">
		function hide(){
			document.getElementById('msg').style.display='none';
		}
		function hideR(){
			document.getElementById('rep').style.display='none';
			document.getElementById('crss2').style.display='none';
		}
	</script>
</html>