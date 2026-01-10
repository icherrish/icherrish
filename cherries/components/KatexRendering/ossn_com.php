<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   KaTeX Rendering
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__KATEX_RENDERING__', ossn_route()->com . 'KatexRendering/');

function com_katex_rendering_init()
{
	ossn_new_external_css('katex.css', '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css', false);
	ossn_load_external_css('katex.css');
	ossn_load_external_css('katex.css', 'admin');
	ossn_new_external_js('katex.js', '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js', false);
	ossn_load_external_js('katex.js');
	ossn_load_external_js('katex.js', 'admin');
	ossn_new_external_js('katex-chem.js', '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/contrib/mhchem.min.js', false);
	ossn_load_external_js('katex-chem.js');
	ossn_load_external_js('katex-chem.js', 'admin');
	ossn_new_external_js('katex-auto-render.js', '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/contrib/auto-render.min.js', false);
	ossn_load_external_js('katex-auto-render.js');
	ossn_load_external_js('katex-auto-render.js', 'admin');
	ossn_new_js('katexrendering', 'js/katexrendering');
	ossn_load_js('katexrendering');
	ossn_load_js('katexrendering', 'admin');
	ossn_add_hook('required', 'components', 'com_katex_rendering_asure_requirements');
}

function com_katex_rendering_asure_requirements($hook, $type, $return, $params)
{
	$return[] = 'TextareaSupport';
	return $return;
}

ossn_register_callback('ossn', 'init', 'com_katex_rendering_init');
