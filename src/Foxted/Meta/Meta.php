<?php namespace Foxted\Meta;

use Foxted\Meta\Facades\MetaFacade;
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
    protected $tags = [];

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
     * Generate a HTML unpaired tag
     * @param $tagName
     * @param $tagAttributes
     * @return array
     */
    private function unpairedTag($tagName, $tagAttributes)
    {
        return [
            'type' => MetaFacade::UNPAIRED_TAG,
            'tag' => $tagName,
            'attributes' => $this->htmlBuilder->attributes($tagAttributes)
        ];
    }

    /**
     * Generate a self-closing tag
     * @param       $tagName
     * @param       $tagContent
     * @param array $tagAttributes
     * @return array
     */
    public function pairedTag($tagName, $tagContent, $tagAttributes = [])
    {
        return [
            'type' => MetaFacade::PAIRED_TAG,
            'tag' => $tagName,
            'content' => $tagContent,
            'attributes' => $this->htmlBuilder->attributes($tagAttributes)
        ];
    }

    /**
     * Build a name meta tag
     * @param $name
     * @param $content
     */
    public function name( $name, $content )
    {
        $attributes = compact('name', 'content');
        array_push($this->tags, $this->unpairedTag('meta', $attributes));
    }

    /**
     * Build a http-equiv meta tag
     * @param $http_equiv
     * @param $content
     */
    public function equiv( $http_equiv, $content )
    {
        $attributes = [
            'http-equiv' => $http_equiv,
            'content' => $content
        ];
        array_push($this->tags, $this->unpairedTag('equiv', $attributes));
    }

    /**
     * Build a title tag
     * @param $title
     */
    public function title( $title )
    {
        array_push($this->tags, $this->pairedTag('title', $title));
    }

    /**
     * Render the full meta block
     *
     * @return \Illuminate\View\Factory
     */
    public function render()
    {
        return $this->viewFactory->make('meta::meta', [
            'metas' => $this->getTags()
        ]);
    }

    /**
     * Get metas array
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

}