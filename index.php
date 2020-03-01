<?
/* 	
	...:::microLogos CMS:::...
	Author : Tomo (tomo.logos@gmail.com)
	License: GNU/GPL 
	Don't remove this comment for Author's Copyright 
*/

define("MVC",microtime(true));
define("BASE","http://localhost/logos/");
define("TITLE","LogosCMS");

class database
{
	protected $dir;
	function __construct($dir=null)
	{
		if(!empty($dir)) {$this->dir="files/".$dir."/";}
		else {$this->dir = "files/";}
	}
	function save($filename,$content)
	{
		$file=$this->dir.$filename.".txt";
		if(!$this->put($file,$content))
		{
			trigger_error(get_class($this)." error: Tidak bisa menyimpan $file",E_USER_WARNING);
			return false;
		}
		return true;
	}
	protected function put($file,$data,$mode=false)
	{
		if(file_exists($file)&&file_get_contents($file)===$data)
		{
			touch($file);
			return true;
		}
		if(!$fp=@fopen($file,'wb'))
		{
			return false;
		}
		$data = serialize($data);
		fwrite($fp,$data);
		fclose($fp);
		$this->chmod($file,$mode);
		return true;
	}
	protected function chmod($file,$mode=false)
	{
		if(!$mode)$mode=0644;return @chmod($file,$mode);
	}
	public function load($filename)
	{
		return $this->get($this->dir.$filename);
	}
	protected function get($filename)
	{
		if(!$this->check($filename))return null;
		$data = file_get_contents($filename);
		$data = unserialize($data);
		return $data;
	}
	protected function check($filename)
	{
		return file_exists($filename);
	}
	public function delete($filename)
	{
		return unlink($this->dir.$filename);
	}
}

class controllers
{
	private $m;
	private $v;
	
	function __construct($dir=null)
	{
		$this->m = new models($dir);
	}
	function load($page)
	{
		$this->m->load($page);
	}
}

class models extends database
{
	private $v;
	private $d;
	private $data=array();
	private $title;
	private $desc;
	private $key;
	private $content;
	private $mvc;
	private $menu;
	
	function __construct($dir=null)
	{
		if ($dir==null OR $dir=="index")
		{
			$this->d = new database();
		}
		else if($dir=="admin")
		{
			include("editor.php");
		}
		else
		{
			$this->d = new database($dir);
		}
	}
	
	private function nav($subdir)
	{
		$dir = "files/".$subdir;
		$look = scandir($dir);
		$menu= "";
		for ($a=2;$a<count($look);$a++)
		{
			$dir = $look[$a];
			$w = pathinfo($dir,PATHINFO_FILENAME);
			$menu .= "<li><a href='".$subdir."/".htmlentities($w)."'>".$w."</a></li>";
		}
		return $menu;
	}
	
	function load($page)
	{
		$this->data=$this->d->load($page.".txt");
		if(!empty($this->data))
		{
			$this->title = $this->data["title"];
			$this->desc = $this->data["desc"];
			$this->key = $this->data["key"];
			$this->content = $this->data["content"];
			$this->mvc = "<center>Page Rendered in: ".substr(((microtime(true))-MVC),0,7)." seconds.</center>";
		} else
		{
			$this->title = TITLE;
			$this->desc = TITLE;
			$this->key = TITLE;
			//if (!empty($_GET["page"])) {$page = $_GET["page"];}
			$this->content = "Halaman :<b><u>".$page."</b></u> Tidak ada dalam database kami.";
			$this->mvc = "<center>Page Rendered in: ".substr(((microtime(true))-MVC),0,7)." seconds.</center>";
		}
		$utama = $this->nav("utama");
		$kategori = $this->nav("kategori");
		$pages = $this->nav("pages");
		$blogroll = $this->nav("blogroll");
		$d = new views("default");
		$d->render($this->title,$this->desc,$this->key,$this->content,$this->mvc,$utama,$kategori,$pages,$blogroll);
	}
}

class views 
{
	public $template;
	
	function __construct($tema)
	{
		$this->template = ("templates/".$tema.".php");
	}
	function render ($title,$desc,$key,$content,$mvc,$utama,$kategori,$pages,$blogroll)
	{
		ob_start();
		require_once($this->template);
		ob_flush();
		ob_get_clean();
	}
}
//Memulai halaman WEB dari CLASS-CLASS diatas!
if (empty($_GET["page"]))
{
	$aksi = "index";
}
else
{
	$aksi = $_GET["page"];
}
//Untuk fix empty $_GET["page"]
if (empty($_GET["page"]))
{
	$page = "";
}
else
{
	$page = $_GET["page"];
}

switch (strtolower($page))
{
	default:
	$mulai = new controllers();
	$mulai->load($aksi);
	break;
	
	case "admin":
	$mulai = new controllers("admin");
	break;
	
	case "utama":
	$mulai = new controllers("utama");
	if (empty($_GET["aksi"]))
	{
		$mulai->load("index");
	}
	else
	{
		$mulai->load($_GET["aksi"]);
	}
	break;
	
	case "pages":
		$mulai = new controllers("pages");
	if (empty($_GET["aksi"]))
	{
		$mulai->load("index");
	}
	else
	{
		$mulai->load($_GET["aksi"]);
	}
	break;
	
	case "kategori":
		$mulai = new controllers("kategori");
	if (empty($_GET["aksi"]))
	{
		$mulai->load("index");
	}
	else
	{
		$mulai->load($_GET["aksi"]);
	}
	break;
	
	case "blogroll":
		$mulai = new controllers("blogroll");
	if (empty($_GET["aksi"]))
	{
		$mulai->load("index");
	}
	else
	{
		$mulai->load($_GET["aksi"]);
	}
	break;
}

?>