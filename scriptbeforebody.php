<?php
defined('_JEXEC') or die('Restricted access');

class plgSystemScriptbeforebody extends JPlugin {

  public function onAfterRender()
  {

    $app = JFactory::getApplication();

    // only insert the script in the frontend
    if ($app->isClient('site')) {

      // Get all script files paths from the plugins configuration
      $scripts = explode(PHP_EOL, $this->params->get('scriptFiles'));

      $i=0;
      foreach ($scripts as $file) {
        $scripts[$i] = trim($file);
        $i++;
      }

      // retrieve all the response as an html string
      $html = $app->getBody();

      // replace the closing body tag with your scripts appending to the closing body tag

      $tags = "";
        foreach($scripts as $s){
        $tags .= '<script src="' . $s . '"></script>';
      }

      $html = str_replace('</body>',$tags . '</body>',$html);

      // override the original response
      $app->setBody($html);
    }
  }
}
