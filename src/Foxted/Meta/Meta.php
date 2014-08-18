<?php namespace Foxted\Meta;

use Illuminate\Html\HtmlBuilder;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory;

/**
 * Class Meta
 *
 * @package Foxted\Meta
 * @author  Valentin PRUGNAUD <valentin@whatdafox.com>
 * @url http://www.foxted.com
 */
class Meta
{

    /**
     * @var \Illuminate\View\Factory
     */
    protected $viewFactory;

    /**
     * @var \Illuminate\Html\HtmlBuilder
     */
    protected $htmlBuilder;

    /**
     * @var \Illuminate\View\Compilers\BladeCompiler
     */
    protected $bladeCompiler;
    /**
     * Array that contains all the meta
     * @var array
     */
    protected $metas = [];

    /**
     * Constructor
     * @param Factory                      $viewFactory
     * @param HtmlBuilder $htmlBuilder
     * @param BladeCompiler                $bladeCompiler
     */
    public function __construct( Factory $viewFactory, HtmlBuilder $htmlBuilder, BladeCompiler $bladeCompiler )
    {
        $this->viewFactory = $viewFactory;
        $this->htmlBuilder = $htmlBuilder;
        $this->bladeCompiler = $bladeCompiler;
    }

    /**
     * Generate a tag
     * @param $tagName
     * @param $tagAttributes
     * @return array
     */
    private function tag($tagName, $tagAttributes)
    {
        return [
            'tag' => $tagName,
            'attributes' => $this->htmlBuilder->attributes($tagAttributes)
        ];
    }

    /**
     * Build a name meta tag
     * @param $name
     * @param $content
     */
    public function meta( $name, $content )
    {
        $attributes = compact('name', 'content');
        array_push($this->metas, $this->tag('meta', $attributes));
    }

    /**
     * Render the full meta block
     *
     * @return \Illuminate\View\Factory
     */
    public function render()
    {
        return $this->viewFactory->make('meta::meta', [
            'metas' => $this->getMetas()
        ]);
    }

    /**
     * Get metas array
     * @return mixed
     */
    public function getMetas()
    {
        return $this->metas;
    }

}