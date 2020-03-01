<?php
/*------------------------------------------------------------------------------
|	Dibuat Oleh	: 	Tomo.Logos													|
|	Website 	:	www.topdesain.com											|
|	Ubah username dan password sesuai keinginan Anda di Line 52 dan Line 53		|
|	Tanggal Pembuatan : 5 Maret 2013											|
--------------------------------------------------------------------------------*/
if (!defined("BASE")) exit ("Direct Access Not Allowed!");

class login
{
	/*------- CONFIG Username dan PASSWORD -----------------*/
	private $username = 'logos'; // Ubah property $username sesuai dengan yang Anda inginkan.
	private $password = '23'; // Ubah property $password sesuai dengan yang Anda inginkan.
	/*------- END CONFIG --------------*/
	private $sesi;
	private $filename;
	
	function insert()
	{	
		
		echo "<center>SELAMAT! halaman ".$this->filename." Telah berhasil ditulis!<br>";
		echo "<a href='submit'><button>Buat Halaman Baru</button></a></center>";
	}
	
	function prosesLogin()
	{
		echo "<html><head><title>..::: Login Administration :::..</title>
			<style>
				.s1 {color:#FFF !important; font-weight:bold;}
				.s5 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
				.s6 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold;}
				a {text-decoration:none;}
				a:hover{font-weight:bold}
			</style>
		</head>
		<body>
			<form method='POST' action='admin/validasi'>
				<table width='308' style='margin-top:100px;border:1px solid #999;-webkit-box-shadow:0px 0px 10px rgba(50, 50, 50, 1); -moz-box-shadow:0px 0px 10px rgba(50, 50, 50, 1);box-shadow:0px 0px 10px rgba(50, 50, 50, 1);' align='center' cellpadding='1' cellspacing='0'>
					<tr>
						<td height='30' colspan='3' bgcolor='#0000CC'>
							<div align='center' class='s1 s5'>Login Administrator : </div>
						</td>
					</tr>
					<tr>
						<td width='123' height='35' bgcolor='#FFF'>
							<div align='right' class='s5'>Username :</div>
						</td>
						<td width='8' bgcolor='#FFF'>&nbsp;
						</td>
						<td width='162' bgcolor='#FFF'>
							<span class='s5'>
								<input type='text' name='pengguna'>
							</span>
						</td>
					</tr>
					<tr>
						<td height='29' bgcolor='#FFF'>
							<div align='right' class='s5'>Password :</div>
						</td>
						<td height='29' bgcolor='#FFF'>&nbsp;
						</td>
						<td bgcolor='#FFF'>
							<span class='s5'>
								<input type='password' name='sandi'>
							</span>
						</td>
					</tr>
					<tr>
						<td height='36' bgcolor='#FFF'>&nbsp;
						</td>
						<td bgcolor='#FFF'>&nbsp;
						</td>
						<td bgcolor='#FFF'>
							<span class='s5'>
								<input type='submit' name='submit' value='Submit'>
							</span>
						</td>
					</tr>
					<tr>
						<td height='30' colspan='3' bgcolor='#0000CC'>
							<div align='center' class='s1 s5'>Secure Admin</div>
						</td>
					</tr>
				</table>
			</form>
		</body>
		</html>";
	}
	function validasiUser()
	{
		if (empty($_POST['pengguna'])) {$j=null;} else {$j=$_POST['pengguna'];}
		if (empty($_POST['sandi'])) {$k=null;} else {$k=$_POST['sandi'];}
		if ($this->username == $j AND $this->password == $k) 
		{
			session_start();
			session_regenerate_id();
			$this->sesi = session_id();
			$_SESSION['reg'] = session_id();
			$this->sapaUser();
			echo "<center><a href='admin/logout'><button>Logout</button></a></center>";
			$this->redirect();
		}else
		{
			echo "Username dan password Anda salah!";
			$this->prosesLogin();
			
		}
	}
	function redirect()
	{
		if (empty($_POST['filename'])) {$s=null;} else {$s=$_POST['filename'];$this->filename = $s;}
		if (empty($_POST['title'])) {$t=null;} else {$t=$_POST['title'];}
		if (empty($_POST['desc'])) {$u=null;} else {$u=$_POST['desc'];}
		if (empty($_POST['key'])) {$v=null;} else {$v=$_POST['key'];}
		if (empty($_POST['content'])) {$w=null;} else {$w=$_POST['content'];}
		if (empty($_POST['letak'])) {$x=null;} else {$x=$_POST['letak'];}
		//if(!session_start()){session_start();}
		if (isset($s) AND isset($t) AND isset($u) AND isset($v) AND isset($w))
		{
			$tulis = new database($x);
			$array = array("title"=>$t,"desc"=>$u,"key"=>$v,"content"=>$w);
			$tulis->save($s,$array);
			$this->insert();
		} else 
		{
		?>
			<html>
			<head>
			<title>..:: Tambah Halaman ::..</title>
				<style>
					html, body, div, span, h1, h2, h3, h4, h5, h6, p, table, tbody, tfoot, thead, tr, th, td,
					{
						margin: 0 auto;
						padding: 0;
						font-size: 100%;
						font: inherit;
						vertical-align: baseline;
					}
					body 
					{
						line-height: 1;
						padding:20px;
					}
					table 
					{
						border-collapse: collapse;
						border-spacing: 0;
					}
					.s1 {color:#FFF; font-weight:bold;}
					.s5 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding:4px;}
					.s6 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold;}
					.s7 {color:#000;font-weight:bold;}
					a{text-decoration:none;}
					a:hover{font-weight:bold}
				</style>
				<script src="../templates/js/nicEdit.js" type="text/javascript"></script>
				<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
			</head>
			<body>
				<form action='submit' method="POST">
					<table width="866" border="1" style="margin-top:30px;margin-bottom:50px;border:1px solid #999999;-webkit-box-shadow:0px 0px 10px rgba(50, 50, 50, 1); -moz-box-shadow:0px 0px 10px rgba(50, 50, 50, 1);box-shadow:0px 0px 10px rgba(50, 50, 50, 1);" align="center" cellpadding="0" cellspacing="0">
						<thead>
							<th height="30" colspan="6" bgcolor="#0000CC">
								<div align="center" class="s1 s5">Tambah Halaman</div>
							</th>
						</thead>
						<tbody>
							<tr>
								<td width="100" colspan="1" bgcolor="#CCCC00">
									<div align="right" class="s7 s5">Page/Filename:</div>
								</td>
								<td colspan="5" bgcolor="#CCCC00">
									<div align="left" class="s7 s5"><input type="text" name="filename" style="width:750px; border:inset 2px #CCCC00;" value=''></div>
								</td>
							</tr>
							<tr>
								<td width="100" colspan="1" bgcolor="#CCCC00">
									<div align="right" class="s7 s5">Title :</div>
								</td>
								<td colspan="5" bgcolor="#CCCC00">
									<div align="left" class="s7 s5"><input type="text" name="title" style="width:750px; border:inset 2px #CCCC00;" value=''></div>
								</td>
							</tr>
							<tr>
								<td width="100" colspan="1" bgcolor="#CCCC00">
									<div align="right" class="s7 s5">Description :</div>
								</td>
								<td colspan="5" bgcolor="#CCCC00">
									<div align="left" class="s7 s5"><input type="text" name="desc" style="width:750px; border:inset 2px #CCCC00;" value=''></div>
								</td>
							</tr>
							<tr>
								<td width="100" colspan="1" bgcolor="#CCCC00">
									<div align="right" class="s7 s5">Keywords :</div>
								</td>
								<td colspan="5" bgcolor="#CCCC00">
									<div align="left" class="s7 s5"><input type="text" name="key" style="width:750px; border:inset 2px #CCCC00;" value=''></div>
								</td>
							</tr>
							<tr>
								<td width="100" colspan="1" bgcolor="#CCCC00">
									<div align="right" class="s7 s5">Content :</div>
								</td>
								<td colspan="5" bgcolor="#CCCC00">
									<div align="left" style="padding:4px;"><textarea id="editor" name="content" style="width:100%;min-height:200px;"></textarea></div>
								</td>
							</tr>
							<tr>
								<td width="100" colspan="1" bgcolor="#CCCC00">
									<div align="right" class="s7 s5">Letak :</div>
								</td>
								<td colspan="5" bgcolor="#CCCC00">
									<div align="left" class="s7 s5"><input type="radio" name="letak" value='utama' required />Utama<input type="radio" name="letak" value='kategori' required />Kategori<input type="radio" name="letak" value='pages' required />Pages<input type="radio" name="letak" value='blogroll'required />Blogroll<input type="radio" name="letak" value='' required />Parent Folder</div>
								</td>
							</tr>
							<tr>
								<td height="30" colspan="6" bgcolor="#CCCC00">
									<center><input type='submit' name='submit' value='submit'></center>
				</form>
								</td>
							</tr>
							<tr>
								<td height="30" colspan="6" bgcolor="#0000CC">
									<div align="center" class="s1 s5">
										Written By : Tomo
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</body>
				</html>
		<?php
		}
	}
	function sapaUser()
	{
		echo "<center>Selamat Datang $this->username !</center>";
	}
	function prosesLogout()
	{
		session_start();
		session_destroy();
		echo "Anda Sudah berhasil Logout! <br> Silahkan login kembali jika ingin melanjutkan!";
		$this->prosesLogin();
	}	
}
//ALUR PROGRAM LogosCMS EDITOR By me
/*------------------------------------------------------------------------------
|	Dibuat Oleh	: 	Tomo.Logos													|
|	Website 	:	www.topdesain.com											|
|	Ubah username dan password sesuai keinginan Anda di Line 52 dan Line 53		|
|	Tanggal Pembuatan : 5 Maret 2013											|
--------------------------------------------------------------------------------*/
if (empty($_GET['aksi'])) $_GET['aksi']="";
$ok = new login();
switch ($_GET['aksi']){
	default:
		$ok->prosesLogin();
	break;
	
	case 'validasi':
		$ok->validasiUser();
	break;
	
	case "submit":
		$ok->redirect();
	break;
	
	case 'logout':
		$ok->prosesLogout();
	break;
	
	case 'create':
		$ok->insert();
	break;
}
?>