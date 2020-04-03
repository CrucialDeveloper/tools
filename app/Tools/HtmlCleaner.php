<?php

namespace App\Tools;

use Illuminate\Http\Request;

class HTMLCleaner
{
    /**
     * @var Request
     */

    public function parse($request)
    {
        $orig = $request['original'];
        $tags = $request['tags'];
        $attributes = $request['attributes'];
        return $this->stripper($orig, $tags, $attributes);
    }

    public function cleanUpload($orig)
    {
        $tags = '<p><sub><sup><b><strong><i><em><u><a><ul><ol><li><pre><hr><img><table><tr><td><th><h1><h2><h3><h4><h5><a><thead><br>';
        $attributes = 'href,src,target,rel,colspan,rowspan';

        return $this->stripper($orig, $tags, $attributes);
    }

    public function stripper($orig, $tags, $attributes)
    {
        $update = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i", '<$1$2>', $orig);
        $update = strip_tags($orig, $tags);

        $attrib1 = explode(',', $attributes);

        preg_match_all('/[a-z]+=".+"/iU', $update, $attributes);

        foreach ($attributes[0] as $attribute) {
            $attributeName = stristr($attribute, '=', true);
            if (!in_array($attributeName, $attrib1)) {
                $update = str_replace(' ' . $attribute, '', $update);
            }
        }
        $update = preg_replace("/<td>\s*<p.*?>\s*/m", "<td>", $update);
        $update = preg_replace("/<\/p>\s*<\/td>/m", "</td>", $update);

        return $update;
    }
}
