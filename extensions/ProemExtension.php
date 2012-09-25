<?php

namespace Gen;

class ProemExtension extends TwigExtension
{
    public function getFunctions()
    {
        return array(
            'docContext'    => new \Twig_Function_Method($this, 'docContext'),
            'hubLink'       => new \Twig_Function_Method($this, 'hubLink', ['is_safe' => ['html']]),
            'docLink'       => new \Twig_Function_Method($this, 'docLink', ['is_safe' => ['html']]),
            'issueLink'     => new \Twig_Function_Method($this, 'issueLink', ['is_safe' => ['html']]),
            'apiLink'       => new \Twig_Function_Method($this, 'apiLink', ['is_safe' => ['html']]),
        );
    }

    public function getName()
    {
        return 'proem_extension';
    }

    public function docContext()
    {
        if (strpos($this->currentDirectory, 'dev') !== false) {
            return 'dev';
        }
        return 'current';
    }

    public function hubLink($file = null, $title = null, $branch = null)
    {
        if ($branch === null) {
            if ($this->docContext() == 'current') {
                $branch = 'master';
            } else {
                $branch = 'develop';
            }
        }

        if ($title === null) {
            if ($file !== null) {
                $title = str_replace('.', '\\', $file);
            } else {
                $title = 'Github';
            }
        }

        if ($file !== null) {
            $file = '/' . str_replace('.', '/', $file) . '.php';
        } else {
            $file = '';
        }

        return "<a href=\"https://github.com/proem/proem/tree/{$branch}{$file}\">{$title}</a>";
    }

    public function docLink($page = null, $title = null, $anchor = null, $context = null)
    {
        if ($page !== null) {
            switch ($page) {
                case 'installation':
                    $t = 'Installation';
                    break;
                case 'quickstart':
                    $t = 'Quick Start Guide';
                    break;
                case 'bootstrap':
                    $t = 'The Bootstrap Process';
                    break;
                case 'autoloader':
                    $t = 'Autoloader';
                    break;
                case 'route':
                    $t = 'Routing Component';
                    $page = 'route-component';
                    break;
                case 'signal':
                    $t = 'Signal Component';
                    $page = 'signal-component';
                    break;
                case 'service':
                    $t = 'Service Component';
                    $page = 'services-component';
                    break;
                case 'dispatch':
                    $t = 'Dispatch Component';
                    break;
                case 'filter':
                    $t = 'The Filter Component';
                    break;
                case 'io':
                    $t = 'IO';
                    break;
                case 'controllers':
                    $t = 'Controllers';
                    break;
                case 'modules':
                    $t = 'Modules';
                    break;
                case 'plugins':
                    $t = 'Plugins';
                    break;
            }
            $page = "/{$page}.html";
        } else {
            $page = '';
        }

        if ($context === null) {
            $context = $this->docContext();
        }

        if ($title === null) {
            $title = $t;
        }

        if ($anchor === null) {
            $anchor = '';
        } else {
            $anchor = '#' . $anchor;
        }

        return "<a href=\"/docs/{$context}{$page}{$anchor}\">{$title}</a>";
    }

    public function issueLink($issue = null)
    {
        if ($issue === null) {
            return "<a href=\"https://github.com/proem/proem/issues\">Issue Tracker</a>";
        } else {
            return "<a href=\"https://github.com/proem/proem/issues/{$issue}\">#{$issue}</a>";
        }
    }

    public function apiLink($class, $title = null, $content = null)
    {
        if ($title === null) {
            $title = str_replace('.', '\\', $class);
        }

        if ($context === null) {
            $context = $this->docContext();
        }

        return "<a href=\"/api/{$context}/namespaces/{$class}.html\">{$title}</a>";
    }
}
