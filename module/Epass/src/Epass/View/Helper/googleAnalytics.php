<?php

namespace Epass\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Helper for add gA Script
 */
class googleAnalytics extends AbstractHelper
{
    protected $config;

    public function __construct($config)
    {
        $this->setConfig($config);
        return $this;
    }

    /**
     * Generates a 'HTML' element.
     *
     * @param string $content Content
     */
    public function __invoke($content = "")
    {
        if($this->config['enable']){
            return $this->showScript();
        }
        
        return '';
    }


    public function showScript(){
        $content=<<<EOT
<!-- google analytics -->
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 ga('create', '{$this->config['key']}', 'auto');
 ga('send', 'pageview');
</script>
<!-- fin google analytics -->
 
 
EOT;

        return trim($content);
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }
}
