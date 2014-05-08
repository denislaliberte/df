<?php

namespace tp1;

class GenerateThemeHook
{
    private $themeFolder;
    private $themeHooks;
    public function __construct($themeFolder,$themeHooks = array())
    {
        $this->themeFolder = $themeFolder;
        $this->themeHooks = $themeHooks;
    }

    public static function factory($themFolder)
    {
        return new GenerateThemeHook($themFolder);
    }

    public function addTheme($themeName)
    {
        $templateString = $this->themeFolder . '/' . $themeName;
        $this->themeHooks[$themeName] = array (
            'template' => $templateString,
        );
        return $this;
    }

    public function getHooks()
    {
        return $this->themeHooks;
    }
}
