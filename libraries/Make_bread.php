<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Make_bread
{
    private $_breadcrumb = array();
    private $_include_home;
    private $_container_open;
    private $_container_close;
    private $_divider;
    private $_crumb_open;
    private $_crumb_close;
    
    private $_anchor_format;

    private $_all_configs;
    private $_sub_url = '';
    
    public function __construct($configs = NULL)
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        if(!$configs){
            $CI->config->load('phpmailer', TRUE);
            $configs = $CI->config->item('phpmailer');
        }
        $this->_all_configs = $configs;        

        $configs = $configs['make_bread_default'];

        $this->set_configs($configs);
    }

    public function add($title = NULL, $href = '', $segment = FALSE)
    {
        // if the method won't receive the $title parameter, it won't do anything to the $_breadcrumb
        if (is_null($title)) return;
        // first let's find out if we have a $href
        if(isset($href) && strlen($href)>0)
        {
            // if $segment is not FALSE we will build the URL from the previous crumb
            if ($segment)
            {
                $previous = $this->_breadcrumb[sizeof($this->_breadcrumb) - 1]['href'];
                $href = $previous . '/' . $href;
            } // else if the $href is not an absolute path we compose the URL from our site's URL
            elseif (!filter_var($href, FILTER_VALIDATE_URL))
            {
                $href = site_url($this->_sub_url . $href);
            }
        }
        // add crumb to the end of the breadcrumb
        $this->_breadcrumb[] = array('title' => $title, 'href' => $href);
    }

    public function output()
    {
        // we open the container's tag
        $output = $this->_container_open;
        if(sizeof($this->_breadcrumb) > 0)
        {
            $i = 1;
            foreach($this->_breadcrumb as $key=>$crumb)
            {
                // we put the crumb with open and closing tags
                $output .= $this->_crumb_open;
                if(strlen($crumb['href'])>0)
                {
                    $output .= '<a itemprop="item" href="' . $crumb['href'] . '">
                    <span itemprop="name">' .  $crumb['title'] . '</span></a>
                    <meta itemprop="position" content="' .$i . '" />';
                }
                else
                {

                    $output .= '<span>'.$crumb['title'].'</span>';
                }
                $output .= $this->_crumb_close;
                // we end the crumb with the divider if is not the last crumb
                if($key < (sizeof($this->_breadcrumb)-1))
                {
                    $output .= $this->_divider;
                }
                $i++;
            }
        }
        // we close the container's tag
        $output .= $this->_container_close;
        return $output;
    }
    
    public function reset_bread_crumbs(){
        $new_bread_crumb[0] = $this->_breadcrumb[0];
        $this->_breadcrumb = $new_bread_crumb;
    }
    
    public function set_configs($configs)
    {
        $this->_include_home = $configs['include_home'];
        $this->_container_open = $configs['container_open'];
        $this->_container_close = $configs['container_close'];
        $this->_divider = $configs['divider'];
        $this->_crumb_open = $configs['crumb_open'];
        $this->_crumb_close = $configs['crumb_close'];
        $this->_sub_url = isset($configs['sub_url']) ? $configs['sub_url'] : '';

        if(isset($this->_include_home) && (strlen($this->_include_home)>0))
        {
            $this->_breadcrumb[0] = array('title'=>$this->_include_home, 'href'=>rtrim(base_url($this->_sub_url),'/'));
        }
    }

    public function switch_config($config_name)
    {
        if(isset($this->_all_configs[$config_name])){
            $this->set_configs($this->_all_configs[$config_name]);
            return true;
        }
        return false;
    }
}
