<?php

namespace Dimitrovv\Module\Test\Unit\Helper;

/**
 * Class DataTest
 * @package Dimitrovv\Module\Test\Unit\Helper
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Dimitrovv\Module\Helper\Data
     */
    protected $moduleHelper;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $scopeConfigMock;

    /**
     * @var \Magento\Framework\App\Helper\Context|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $contextMock;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $storeManagerMock;

    /**
     * @var \Magento\Store\Model\Store|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $storeMock;

    /**
     * @var \Magento\Framework\UrlInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $urlBuilderMock;

    /**
     * @var \Magento\Framework\Locale\Resolver|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $localeResolverMock;

    /**
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $objectManagerHelper = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->scopeConfigMock = $this->getMockBuilder(\Magento\Framework\App\Config\ScopeConfigInterface::class)
            ->getMock();

        $this->contextMock = $this->getMockBuilder(\Magento\Framework\App\Helper\Context::class)
            ->disableOriginalConstructor()
            ->setMethods(['getScopeConfig', 'getUrlBuilder'])
            ->getMock();

        $this->storeManagerMock = $this->getMockBuilder(\Magento\Store\Model\StoreManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStore'])
            ->getMock();

        $this->storeMock = $this->getMockBuilder(\Magento\Store\Model\Store::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeManagerMock->expects(static::any())
            ->method('getStore')
            ->willReturn(
                $this->storeMock
            );

        $this->urlBuilderMock = $this->getMockBuilder(\Magento\Framework\Url::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUrl'])
            ->getMock();

        $this->storeManagerMock->expects(static::any())
            ->method('getUrlBuilder')
            ->willReturn(
                $this->urlBuilderMock
            );

        $this->contextMock->expects(static::any())
            ->method('getScopeConfig')
            ->willReturn(
                $this->scopeConfigMock
            );

        $this->contextMock->expects(static::any())
            ->method('getUrlBuilder')
            ->willReturn(
                $this->urlBuilderMock
            );

        $this->localeResolverMock = $this->getMockBuilder(\Magento\Framework\Locale\Resolver::class)
            ->disableOriginalConstructor()
            ->setMethods(['getLocale'])
            ->getMock();

        $this->moduleHelper = $objectManagerHelper->getObject(
            \Dimitrovv\Module\Helper\Data::class,
            [
                'context'        => $this->contextMock,
                'storeManager'   => $this->storeManagerMock,
                'localeResolver' => $this->localeResolverMock
            ]
        );
    }

    public function testModuleHelperInstance()
    {
        $this->assertInstanceOf(
            \Dimitrovv\Module\Helper\Data::class,
            $this->moduleHelper
        );
    }
}
