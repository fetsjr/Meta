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
    protected $configRepository;

    /**
     * Constructor
     */
    protected function _before()
    {
        $this->mockViewFactory();
        $this->mockView();
        $this->mockHtmlBuilder();
        $this->mockBladeCompiler();
        $this->mockConfigCompiler();
    }

    /** @test */
    public function it_is_initializable()
    {
        $meta = $this->createInstance();
        $this->assertInstanceOf('Foxted\Meta\Meta', $meta);
    }

    /** @test */
    public function it_can_have_a_title_tag()
    {
        $metas = $this->createInstance();
        $this->assertAttributeCount(0, 'tags', $metas);
        $this->assertAttributeInternalType('array', 'tags', $metas);

        $metas->title('My amazing website');
        $this->assertAttributeCount(1, 'tags', $metas);
        $this->assertAttributeInternalType('array', 'tags', $metas);
        $this->assertEquals($metas->getTags()[0]['type'], 'paired');
        $this->assertEquals($metas->getTags()[0]['tag'], 'title');
        $this->assertEquals($metas->getTags()[0]['content'], 'My amazing website');
    }

    /** @test */
    public function it_can_have_a_meta_name_tag()
    {
        $metas = $this->createInstance();
        $this->assertAttributeCount(0, 'tags', $metas);
        $this->assertAttributeInternalType('array', 'tags', $metas);

        $this->htmlBuilder->expects($this->any())
                          ->method("attributes")
                          ->will($this->returnValue('name="keywords" content="amazing, awesome"'));

        $metas->name('keywords', 'amazing, awesome');
        $this->assertAttributeCount(1, 'tags', $metas);
        $this->assertAttributeInternalType('array', 'tags', $metas);
        $this->assertEquals($metas->getTags()[0]['type'], 'unpaired');
        $this->assertEquals($metas->getTags()[0]['tag'], 'meta');
        $this->assertEquals($metas->getTags()[0]['attributes'], 'name="keywords" content="amazing, awesome"');
    }

    /** @test */
    public function it_can_have_a_meta_http_equiv_tag()
    {
        $metas = $this->createInstance();
        $this->assertAttributeCount(0, 'tags', $metas);
        $this->assertAttributeInternalType('array', 'tags', $metas);

        $this->htmlBuilder->expects($this->any())
                          ->method("attributes")
                          ->will($this->returnValue('http-equiv="refresh" content="30"'));

        $metas->equiv('refresh', 30);
        $this->assertAttributeCount(1, 'tags', $metas);
        $this->assertAttributeInternalType('array', 'tags', $metas);
        $this->assertEquals($metas->getTags()[0]['type'], 'unpaired');
        $this->assertEquals($metas->getTags()[0]['tag'], 'equiv');
        $this->assertEquals($metas->getTags()[0]['attributes'], 'http-equiv="refresh" content="30"');
    }

    /** @test */
    public function it_can_have_multiple_tags()
    {
        $metas = $this->createInstance();
        $this->assertAttributeCount(0, 'tags', $metas);

        $metas->title('My amazing website');
        $metas->name('keywords', 'amazing, awesome');
        $metas->equiv('refresh', 30);
        $this->assertAttributeCount(3, 'tags', $metas);
    }

    /** @test */
    public function it_can_render_the_view()
    {
        $metas = $this->createInstance();
        $metas->title('My amazing website');
        $view = $metas->render();
        $this->assertInstanceOf('Illuminate\View\View', $view);
    }

    /**
     * Create an instance of the Meta class
     * @return Meta
     */
    private function createInstance()
    {
        return new Meta( $this->viewFactory, $this->htmlBuilder, $this->bladeCompiler, $this->configRepository );
    }

    /**
     * Mock Laravel view factory
     */
    private function mockViewFactory()
    {
        $this->viewFactory = $this->getMock('Illuminate\View\Factory', ['make'], [
            $this->getMock('Illuminate\View\Engines\EngineResolver'),
            $this->getMock('Illuminate\View\ViewFinderInterface'),
            $this->getMock('Illuminate\Contracts\Events\Dispatcher')
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
        $this->viewFactory->expects($this->any())
                          ->method("make")
                          ->will($this->returnValue($this->view));
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

    /**
     * Mock Config repository
     */
    private function mockConfigCompiler()
    {
        $this->configRepository = $this->getMock('Illuminate\Config\Repository');
        $this->configRepository->expects($this->any())
                               ->method('get')
                               ->will($this->returnValue('Default value'));
    }


}