<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
// Page Replacements


define('Z', $_SERVER['DOCUMENT_ROOT'].'/');
define('H', 'includes/templates/');
class ambientHTML
{
  public static function page()
  {
    global $conn,$ambient;
      if(isset($_GET['url']))
      {
        $page = filter($_GET['url']);
        $allowed = array();
        foreach (new DirectoryIterator(Z . H . THEME) as $file)
        {
          $file = explode('.php', $file);
          $allowed[] = $file[0];
        }
        if($page)
        {
          if($page == 'maintenance' && maintenance == '0')
          {
            header('Location: /index');
          }
          if (!maintenance == '1')
          {
            $fileExists = Z . H . THEME ."/{$page}.php";
            if(file_exists($fileExists))
            {
              if (in_array($page, $allowed))
              {
                ob_start();
                include $fileExists;
                $contents = ob_get_contents();
                ob_end_flush();
              }
            }
            else
            {
              header('Location: /404');
            }
          }
          else
          {
              include Z . H . THEME.'/maintenance.php';
          }
        }
        else
        {
          include Z . H . THEME .'/index.php';
        }
    }

    else
    {
      header('Location: /index');
    }
  }
  public static function error($errorName)
  {
    echo '<div class="error" style="display: block;">'.$errorName.'</div>';
  }
  public static function errorSucces($succesMessage)
  {
    echo '<div class="errorSucces" style="display: block;">'.$succesMessage.'</div>';
  }
  public static function loadPlugins()
  {
    $pluginDir = '/includes/addons/';
    foreach (glob($pluginDir."*.php") as $filename) {
      require_once $pluginDir."".basename($filename)."";
    }
  }
}
class AmbientTpl {
  private $outputData;
  public function AddTemplate($tpl)
	{
		$this->outputData .= $tpl->GetHtml();
	}
  public function AddGeneric($tplName)
	{
		$tpl = new Template($tplName);
		$this->outputData .= $tpl->GetHtml();
	}
  public function AddIncludeFile($incFile)
	{
		$this->includeFiles[] = $incFile;
	}

	public function WriteIncludeFiles()
	{
		foreach ($this->includeFiles as $f)
		{
			$this->Write($f->GetHtml() . LB);
		}
	}
  public function Write($str)
	{
		$this->outputData .= $str;
	}
  public function Output()
	{
		global $core;

		$this->Write(LB . LB . '<!-- AmbientCMS: Took ' . (microtime(true)) . ' to output this page -->' . LB . LB);

		echo $this->FilterParams($this->outputData);
	}
  public function SetParam($param, $value)
	{
		$this->params[$param] = is_object($value) ? $value->fetch() : $value;
	}

	public function UnsetParam($param)
	{
		unset($this->params[$param]);
	}
  public function FilterParams($str)
	{
		foreach ($this->params as $param => $value)
		{
			$str = str_ireplace('%' . $param . '%', $value, $str);
		}

		return $str;
	}
}
  class Template
  {
  	private $params = Array();
  	private $tplName = '';

  	public function Template($tplName)
  	{
  		$this->tplName = $tplName;
  	}

  	public function GetHtml()
  	{
  		global $users;

  		extract($this->params);

  		$file = './includes/templates/'.THEME.'/widgets/'.$this->tplName.'.tpl';

  		if (!file_exists($file))
  		{
  			ambientCore::SystemError('Error in the AmbientCMS File System', 'The Following Template could not be be loaded <b> '.$this->tplName.'</b>');
  		}

  		ob_start();
  		include($file);
  		$data = ob_get_contents();
  		ob_end_clean();

  		return $this->FilterParams($data);
  	}

  	public function FilterParams($str)
  	{
  		foreach ($this->params as $param => $value)
  		{
  			if (is_object($value))
  			{
  				continue;
  			}

  			$str = str_ireplace('%' . $param . '%', $value, $str);
  		}

  		return $str;
  	}

  	public function SetParam($param, $value)
  	{
  		$this->params[$param] = $value;
  	}

  	public function UnsetParam($param)
  	{
  		unset($this->params[$param]);
  	}
  }
class IncludeFile
{
	private $type;
	private $src;
	private $rel;
	private $name;

	public function IncludeFile($type, $src, $rel = '', $name = '')
	{
		global $tpl;

		$this->type = $type;
		$this->src = $src;
		$this->rel = $rel;
		$this->name = $name;
	}

	public function GetHtml()
	{
		switch ($this->type)
		{
			case 'application/rss+xml':

				return '<link rel="' . $this->rel . '" type="' . $this->type . '" title="' . $this->name . '" href="' . $this->src . '" />';

			case 'text/javascript':

				return '<script src="' . $this->src . '" type="text/javascript"></script>';

			case 'text/css':
			default:

				return '<link rel="' . $this->rel . '" href="' . $this->src . '" type="' . $this->type . '" />';
		}
	}
}

?>
