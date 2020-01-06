<?php

namespace Hbs\ProductFilters\Plugin;

class AddFiltersFrontend
{
    public function afterGetItemOptions(
        \Magento\Sales\Block\Order\Item\Renderer\DefaultRenderer $subject,
        $result
    ) {
        $infoBuyRequest =  $subject->getItem()->getProductOptionByCode('info_buyRequest');
        if (array_key_exists('top_color', $infoBuyRequest)) {
            $filters = [];
            $filters[] = [
                'label' => 'top',
                'value' => $infoBuyRequest['top_color']
            ];
            $filters[] = [
                'label' => 'edge',
                'value' => $infoBuyRequest['edge_color']
            ];
            $filters[] = [
                'label' => 'frame',
                'value' => $infoBuyRequest['frame_color']
            ];
            $options = $subject->getOrderItem()->getProductOptions();
            if ($options) {
    		    if (isset($options['info_buyRequest'])) {
    		        $result = array_merge($result, $filters);
    		    }
    		}
        }
        return $result;
	}
}