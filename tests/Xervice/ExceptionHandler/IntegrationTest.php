<?php
namespace XerviceTest\ExceptionHandler;

use Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface;
use Xervice\ExceptionHandler\Business\Handler\HandlerCollection;
use Xervice\ExceptionHandler\ExceptionHandlerConfig;
use Xervice\Config\XerviceConfig;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\ExceptionHandler\ExceptionHandlerDependencyProvider;

/**
 * @method \Xervice\ExceptionHandler\ExceptionHandlerFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group ExceptionHandler
     * @group Integration
     */
    public function testEmptyHandleException()
    {
        $this->getFacade()->handleException(new \Exception('Test'));
    }

    /**
     * @group DockerCi
     * @group ExceptionHandler
     * @group Integration
     */
    public function testHandleException()
    {
        $excetion = new \Exception('Testing');

        $exHandler = $this
            ->getMockBuilder(ExceptionHandlerInterface::class)
            ->setMethods(['handleException'])
            ->getMock();

        $exHandler
            ->expects($this->once())
            ->method('handleException')
            ->with(
                $this->equalTo($excetion),
                $this->equalTo(false)
            );

        $this->getContainer()->set(
            ExceptionHandlerDependencyProvider::EXCEPTION_HANDLER,
            function () use ($exHandler) {
                return new HandlerCollection(
                    [
                        $exHandler
                    ]
                );
            }
        );

        $this->getFacade()->handleException($excetion);
    }

    /**
     * @group DockerCi
     * @group ExceptionHandler
     * @group Integration
     */
    public function testHandleExceptionWithDebug()
    {
        $excetion = new \Exception('Testing');

        $exHandler = $this
            ->getMockBuilder(ExceptionHandlerInterface::class)
            ->setMethods(['handleException'])
            ->getMock();

        $exHandler
            ->expects($this->once())
            ->method('handleException')
            ->with(
                $this->equalTo($excetion),
                $this->equalTo(true)
            );

        $this->getContainer()->set(
            ExceptionHandlerDependencyProvider::EXCEPTION_HANDLER,
            function () use ($exHandler) {
                return new HandlerCollection(
                    [
                        $exHandler
                    ]
                );
            }
        );

        XerviceConfig::getInstance()->getConfig()->set(ExceptionHandlerConfig::IS_DEBUG, true);

        $this->getFacade()->handleException($excetion);
    }
}