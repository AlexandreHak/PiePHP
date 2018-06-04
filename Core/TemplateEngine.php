<?php
namespace Core;

class TemplateEngine
{
    /**
     * @return string filepath to the template file
     */
    public static function parseView($file)
    {
        // . DIRECTORY_SEPARATOR . basename($file)
        $templateFilePath = str_replace('src' . DIRECTORY_SEPARATOR . 'View', 'storage' , $file);
        /**
         * @var array search pattern as index and value as replace pattern 
         */
        $patterns = [
            '/{{(.+)}}/',
            '/@if\s*\((.+)\)/',
            '/@elseif\s*\((.+)\)/',
            '/@else\b/',
            '/@endif\b/',
            '/@foreach\s*\((.+)\)/',
            '/@endforeach\b/',
            '/@isset\s*\((.+)\)/',
            '/@endisset\b/',
            '/@empty\s*\((.+)\)/',
            '/@endempty\b/'
        ];
        $replacements = [
            '<?= htmlspecialchars (${1}) ?>',
            '<?php if (${1}): ?>',
            '<?php elseif (${1}): ?>',
            '<?php else: ?>',
            '<?php endif; ?>',
            '<?php foreach ($users as $user): ?>',
            '<?php endforeach; ?>',
            '<?php if (${1}): ?>',
            '<?php endif; ?>',
            '<?php if (${1}): ?>',
            '<?php endif; ?>'
        ];
        $content = preg_replace($patterns, $replacements, file_get_contents($file));
        file_put_contents($templateFilePath, $content);
        return $templateFilePath;
    }
}