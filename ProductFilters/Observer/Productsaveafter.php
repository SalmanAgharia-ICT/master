<?php

namespace Hbs\ProductFilters\Observer;

use Magento\Framework\Event\ObserverInterface;

class Productsaveafter implements ObserverInterface
{

	public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Serialize\SerializerInterface $serializer
	)
    {
    	$this->_request = $request;
        $this->_serializer = $serializer;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_product = $observer->getProduct();
        if ($this->_request->getPostValue('top_color')) {
            $additionalOptions = [];
            $additionalOptions[] = [
                'label' => 'Top',
                'value' => $this->_request->getPostValue('top_color')
            ];
            $additionalOptions[] = [
                'label' => 'Edge',
                'value' => $this->_request->getPostValue('edge_color')
            ];
            $additionalOptions[] = [
                'label' => 'Frame',
                'value' => $this->_request->getPostValue('frame_color')
            ];

            $serializedData = $this->_serializer->serialize($additionalOptions);

            $_product->addCustomOption('additional_options', $serializedData);
        }
    }
}
