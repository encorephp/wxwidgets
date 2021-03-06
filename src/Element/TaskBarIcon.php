<?php

namespace Encore\Wx\Element;

use wxIcon;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Raw\TaskBarIcon as RawTaskBarIcon;
use Encore\Giml\ElementInterface;

class TaskBarIcon implements ElementInterface
{
    use ElementTrait;
    use Wx;

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new RawTaskBarIcon;

        $resourcesPath = $this->collection->getContainer()->resourcesPath();

        $icon = new wxIcon($resourcesPath.'/'.$this->icon, wxBITMAP_TYPE_ANY);

        $this->element->SetIcon($icon, $this->tip);
    }

    /**
     * Add a child element
     * 
     * @param ElementInterface $child
     */
    public function addChild(ElementInterface $child)
    {
        if ($child instanceof Menu) {
            $this->element->setMenu($child);
        }

        $this->children[] = $child;
    }
}