<?php

namespace App\Helper;

use App\Entity\Script;

class ScriptHelper
{

    /** @var Script[] $scripts  */
    private static array $scripts = array();

    private static $bootstrap = false;
    private static $jQuery = false;

    /**
     * @return Script[]
     */
    public static function getScripts(): array
    {
        return self::$scripts;
    }

    /**
     * @param Script[] $scripts
     */
    public static function setScripts(array $scripts): void
    {
        self::$scripts = $scripts;
    }

    /**
     * @param string|null $source
     * @param string|null $type
     * @param string|null $content
     * @return void
     */
    public static function add(?string $source, ?string $type = null, ?string $content = null): void
    {
        self::$scripts[] = new Script($source, $type, $content, null, null);
    }

    /**
     * @param Script ...$script
     * @return void
     */
    public static function addScript(Script ...$script): void
    {
        foreach ($script as $s) {
            self::$scripts[] = $s;
        }
    }

    /**
     * @return void
     */
    public static function addBootstrap(): void
    {
        ScriptHelper::$bootstrap = true;
    }

    /**
     * @return void
     */
    public static function addJQuery(): void
    {
        ScriptHelper::$jQuery = true;
    }

    public static function toHTML(): string
    {
        $res = '';
        if (ScriptHelper::$bootstrap) {
            $res .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>';
        }

        if (ScriptHelper::$jQuery) {
            $res .= '<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>';
        }

        return $res . implode('', array_map(function($script) {
            $type = $script->getType();
            $integrity = $script->getIntegrity();
            $crossorigin = $script->getCrossorigin();
            return '<script '.(empty($type) ? '': 'type="'.$type.'"').' 
                            src="'.$script->getSource().'"
                            '.(empty($integrity) ? '': 'integrity="'.$integrity.'"').'
                            '.(empty($crossorigin) ? '': 'crossorigin="'.$crossorigin.'"').'>
                            '.($script->getContent() ?? '').'
                        </script>';
        }, ScriptHelper::$scripts));
    }
}