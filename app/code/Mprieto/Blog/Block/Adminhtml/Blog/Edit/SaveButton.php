<?php declare(strict_types=1);

namespace Mprieto\Blog\Block\Adminhtml\Blog\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'mprieto_blog_form.mprieto_blog_form',
                                'actionName' => 'save',
                                //'params' => [
                                //    true,
                                //    [
                                //        'back' => 'continue'
                                //    ]
                                //]
                            ]
                        ]
                    ]
                ]
            ],
            //'class_name' => Container::SPLIT_BUTTON,
            //'options' => $this->getOptions(),
            //'dropdown_button_aria_label' => __('Save options'),
        ];
    }

}
