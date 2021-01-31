<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class core 
{
  private $controller = 'user';
  private $method     = 'index';
  private $params     = [];
  private $type = 'user';

  public function __construct($t)
  {
    $this->type = $t;
    $url = $this->getUrl();
    if(file_exists('controllers/' . $url[0]. '.php'))
    {
      $this->controller = $url[0];
      unset($url[0]);
    }

    include 'controllers/'. $this->controller . '.php';

    $this->controller = new $this->controller; // Call to constructor of class (this->controller)

    if(isset($url[1]))
    {
      if(method_exists($this->controller, $url[1]))
      {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    $this->params = $url ? array_values($url) : [];

    call_user_func_array([$this->controller, $this->method], $this->params);
  }


  public function getUrl()
  {
      $url = ($this->type == 'admin') ? 'admin/index' : 'user/index';  
      if(isset($_GET['url']))
      {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
      }
      $url = explode('/', $url);
      return $url;
  }
}  
?>