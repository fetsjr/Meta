<?php namespace Foxted\Meta;

/**
 * Class MetaTest
 * @package Foxted\Meta
 * @author  Valentin Prugnaud <valentin@sccnorthwest.com>
 */
class MetaTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $viewFactory;
    protected $view;
    protected $htmlBuilder;
    protected $bladeCompiler;

    /**
     * Constructor
     */
    protected function _before()
    {
        $this->mockViewFactory();
        $this->mockView();
        $this->viewFactory->expects($this->any())
            ->method("make")
            ->will($this->returnValue($this->view));
        $this->mockHtmlBuilder();
        $this->mockBladeCompiler();
    }

    /** @test */
    public function it_is_initializable()
    {
        $meta = new Meta( $this->viewFactory, $this->htmlBuilder, $this->bladeCompiler );
        $this->assertInstanceOf('Foxted\Meta\Meta', $meta);
    }

    /** @test */
    public function it_can_have_a_tag()
    {
        $breadcrumb = new Breadcrumb( $this->viewFactory );
        $this->assertAttributeCount(0, 'links', $breadcrumb);
        $this->assertAttributeInternalType('array', 'links', $breadcrumb);

        $breadcrumb->add('Home');
        $this->assertAttributeCount(1, 'links', $breadcrumb);
        $this->assertAttributeInternalType('array', 'links', $breadcrumb);

        $links = $breadcrumb->getLinks();
        $this->assertInstanceOf('Foxted\Breadcrumb\BreadcrumbNode', $links[0]);
    }
//
//    /** @test */
//    public function it_can_have_multiple_nodes()
//    {
//        $breadcrumb = new Breadcrumb( $this->viewFactory );
//        $this->assertAttributeCount(0, 'links', $breadcrumb);
//
//        $breadcrumb->add('Home');
//        $breadcrumb->add('Second link');
//        $breadcrumb->add('Third link');
//        $this->assertAttributeCount(3, 'links', $breadcrumb);
//    }
//
//    /** @test */
//    public function it_can_render_the_view()
//    {
//        $breadcrumb = new Breadcrumb( $this->viewFactory );
//        $breadcrumb->add('Home');
//        $view = $breadcrumb->render();
//        $this->assertInstanceOf('Illuminate\View\View', $view);
//    }

    /**
     * Mock Laravel view factory
     */
    private function mockViewFactory()
    {
        $this->viewFactory = $this->getMock('Illuminate\View\Factory', ['make'], [
            $this->getMock('Illuminate\View\Engines\EngineResolver'),
            $this->getMock('Illuminate\View\ViewFinderInterface'),
            $this->getMock('Illuminate\Events\Dispatcher')
        ]);
    }

    /**
     * Mock Laravel view object
     */
    private function mockView()
    {
        $this->view = $this->getMock('Illuminate\View\View', [], [
            $this->viewFactory,
            $this->getMock('Illuminate\View\Engines\EngineInterface'),
            'view',
            'path'
        ]);
    }

    /**
     * Mock Laravel Html Builder
     */
    private function mockHtmlBuilder()
    {
        $this->htmlBuilder = $this->htmlBuilder = $this->getMock('Illuminate\Html\HtmlBuilder', ['attributes'], [
            $this->getMock('Illuminate\Routing\UrlGenerator')
        ]);
    }

    /**
     * Mock Blade compiler
     */
    private function mockBladeCompiler()
    {
        $this->bladeCompiler = $this->getMock('Illuminate\View\Compilers\BladeCompiler', NULL, [
            $this->getMock('Illuminate\Filesystem\Filesystem'),
            ''
        ]);
    }

}